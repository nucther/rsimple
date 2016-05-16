<?php
/**
 * Rsimple Framework
 */

if( !defined('ABSPATH'))
	exit;


if( !class_exists('rsimple_framework') ){

	class rsimple_framework{
		public $args = array();
		public static $__url;
		public static $__path;

		public function __construct( $args=array()){
			$this->__cleaning();

			$this->args = wp_parse_args( $args, $this->__default_args() );

			$this->generateUrl();

			//Load component we needed
			$this->load_component();

			//Set action to wp
			$this->action();

			//temporary plugins
			$this->plugins();

			// Send result to global
			$this->send_result();
		}


		/**
		 * Default args
		 * @return array
		 */
		public function __default_args(){
			$args = array(
				//Option Name
				'option_name' => '',
				//Header display Name
				'display_name' => 'Simple Panel',
				'display_version' => '1.0',

				//page
				'page_slug' => 'theme-options',
				'menu_type' => 'menu',
				'allow_sub_menu' => true,
				'menu_title' => 'Theme Options',
				'menu_icon' => '',
				'page_permission' => 'manage_options',
				'page_parent' => 'themes.php',


				//devoper options
				'dev_mode' => true,


			);

			return $args;
		}

		/**
		 * Default Sections
		 * @return array
		 */
		public function __default_section(){
			$args = array(
					'title' => 'Section',
					'icon' => 'fa-cog',
					'heading' => 'Section Heading',
					'fields' => array()
				);
				return $args;
		}

		/**
		 * Default Fields
		 * @return array
		 */
		public static function __default_field(){
			$args = array(
					'title' => '',
					'subtitle' => '',
					'desc' => '',
					'placeholder' => '',
					'id' => '',
					'type' => '',
					'default' => ''
				);
				return $args;
		}

		/**
		 * Default Custom Post args
		 * @return array
		 */
		private function __defaultCustomPost(){
			$args = array(
				'name' => null,
				'title' => null,
				'capability' => false,
				'override' => array()
			);
			return $args;
		}

		private function __defaultCustomTax(){
			$args = array(
				'name' => null,
				'title' => null,
				'posttype' => 'post',
				'override' => array()
			);
			return $args;
		}
		/**
		 * Clear args
		 * @return array
		 */
		private function __cleaning(){
			$this->args=array();
		}

		/**
		 * Loading all component needed
		 */
		private function load_component(){

			include_once(dirname(__FILE__) .'/inc/class-fields.php');
			include_once(dirname(__FILE__) .'/inc/class-display.php');
			include_once(dirname(__FILE__) .'/inc/class-wp.php');
			include_once(dirname(__FILE__) .'/inc/class-metabox.php');
			//include_once(dirname(__FILE__) .'/inc/class-themecheck.php');
			include_once(dirname(__FILE__) .'/inc/class-post-type.php');
			include_once(dirname(__FILE__) .'/inc/class-taxonomy.php');
			//
			$this->load_fields();
		}

		/**
		 * add to wp action fo menu style etc
		 */
		private function action(){
			add_action('admin_menu', array($this,'add_menu'));
			//add_action('admin_init', array($this,'display_component'));
			add_action('admin_enqueue_scripts', array($this,'__enqueue'));
			add_action('wp_ajax_'. $this->args['option_name'] .'_save_update', array( $this, 'save_update') );
		}

		/**
		 * Add Menu for theme options
		 */
		public function add_menu(){
			if(empty( $this->args['page_parent'] ) ){
				add_menu_page( $this->args['menu_title'],  $this->args['menu_title'],  $this->args['page_permission'],  $this->args['page_slug'], array($this,'display') ,  $this->args['menu_icon']);
			} else {
				add_submenu_page(  $this->args['page_parent'],  $this->args['menu_title'],  $this->args['menu_title'],  $this->args['page_permission'],  $this->args['page_slug'], array($this,'display'));
			}
		}

		/**
		 * Display content
		 * @return html
		 */
		public function display(){
			new rsimple_display($this->args);
		}

		public function generateUrl(){

			self::$__url = get_template_directory_uri(). $this->clearPath( dirname(__FILE__));
			self::$__path = get_template_directory(). $this->clearPath( dirname(__FILE__));
		}

		/**
		 * Crear path
		 * @param  string $path
		 * @return string
		 */
		public function clearPath($path){
			$wpdir = str_replace('\\', '/', get_template_directory() );
			return trailingslashit( str_replace( $wpdir, '', str_replace('\\', '/', $path) ) );
		}

		/**
		 * Load style or script
		 */
		public function __enqueue(){
			//load wp media and font-awsome
			wp_enqueue_media();
			wp_enqueue_style('font-awsome', self::$__url .'assets/fonts/font-awesome.min.css');

			//Load default panel style and script
			wp_enqueue_style('panel-style', self::$__url .'assets/css/style.css');
			wp_enqueue_script('panel-script', self::$__url .'assets/js/rsimple.js');

			//Load panel enqueue
			//if(isset($_REQUEST['page']) && $_REQUEST['page'] == $this->args['option_name']){
				if(isset($this->args['sections'])):

					foreach((array)$this->args['sections'] as $section){

						foreach((array)$section['fields'] as $field){
							$field = wp_parse_args($field, $this->__default_field());

							$class = 'rsimple_'. $field['type'];

							if(class_exists($class)){
								//echo $class;
								$field = new $class($field);
								$field->enqueue();
							}

						}
						$section;
					}
				endif;
			//}
		}

		/**
		 * Get Option Name
		 * @param  string $name
		 * @return string
		 */
		public  function get_args_val($name){
			return $this->args['option_name'];
		}

		private function load_fields(){
			//$this->generateUrl();
			$fields_dir = self::$__path .'inc/fields';

			if(is_dir($fields_dir)):
				$files = scandir( $fields_dir );

				foreach((array)$files as $file){
					if( !in_array($file, array('.','..'))){
						$file = self::$__path .'inc/fields/'. $file .'/rsimple_'. $file .'.php';

						//echo $file ."\n";
						if(is_file($file))
							require_once( $file );
					}
				}
			endif;
		}

		/**
		 * Get panel value from wp option
		 * @param  string $field
		 * @param  string $default
		 * @return string
		 */
		public function get_value($field, $default=''){
			//print_r($this->args);
			$values = get_option( $this->args['option_name'] );

			if(isset($values[$field]))
				return $values[$field];
			else
				return $default;

		}

		/**
		 * Set global value with name option name
		 */
		public function send_result(){
			$result = get_option( $this->args['option_name']);
			$GLOBALS[$this->args['option_name']] = $result;
		}

		/**
		 * Save Update
		 * @return json
		 */
		public function save_update(){
			if(!wp_verify_nonce( $_POST['nonce-security'],'security')){
				$result = array('status' => false);
			} else{
				$rsimple_value = array();
				foreach($this->args['sections'] as $section){
					foreach($section['fields'] as $field){
						if(  isset($_POST[ $this->args['option_name'] ][ $field['id'] ])  ){
							$rsimple_value[ $field['id'] ] =  (!is_array( $_POST[ $this->args['option_name'] ] [ $field['id'] ] ) ) ? stripslashes( $_POST[ $this->args['option_name'] ] [ $field['id'] ] ) : $_POST[ $this->args['option_name'] ] [ $field['id'] ];
						}
					}
				}

				update_option( $this->args['option_name'], $rsimple_value);
				$result = array('status' => true);
			}
			//print_r($this->args);
			echo json_encode($result);
			exit;
		}

		/**
		 * Load new classes
		 * @param  string $class
		 * @return any
		 */
		public function object( $class ){
			$classes = 'rsimple_'. $class;
			//echo $classes;
			if( class_exists($classes) )
				return new $classes;
		}

		/**
		* Action
		**/
		public function plugins(){
			foreach($this->args as $key => $args){
				if($key =='wp_config'){
					$wp = $this->object('wp');
					$wp->run($args);
				}

				if($key == 'custompost'){
					foreach($args as $cp){
						$cp = wp_parse_args($cp, $this->__defaultCustomPost);
						$pt = $this->object('posttype');
						$pt->publish($cp['name'], $cp['title'],$cp['capability'], $cp['override']);
					}
				}

				if($key == 'taxonomy'){
					foreach($args as $ct){
						$ct = wp_parse_args($ct, $this->__defaultCustomTax());
						$tax = $this->object('taxonomy');
						$tax->publish($ct['posttype'], $ct['name'], $ct['title'], $ct['override']);
					}
				}

			}
		}

	}
}
