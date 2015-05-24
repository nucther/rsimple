<?php
/**
 * Rsimple Metabox 
 */

class rsimple_metabox{
	public $args; 
	public $metaargs;

	public function set( $args ){		
		$this->metaargs = wp_parse_args($args, $this->__args() );
		//print_r($this->metaargs);
		$this->meta_action();
	}

	/**
	 * Default Args
	 * @return array 
	 */
	private function __args(){
		$args = array(
			'title' => 'Metabox',
			'id' => 'metabox-'. uniqid(),
			'target' => array('post','page'),
			'context' => 'normal',
			'priority' => 'default',
			'build' => false,
			);

		return $args;
	}	

	/**
	 * Add to WP action	 
	 */
	private function meta_action(){
		add_action('admin_init',array($this,'meta_execute'));
		add_action('admin_init',array($this,'__enqueue'));
		add_action('save_post', array($this,'save'));
	}

	/**
	 * Execute what we can execute	 
	 */
	public function meta_execute(){		
		foreach((array)$this->metaargs['target'] as $context){
			add_meta_box( $this->metaargs['id'], $this->metaargs['title'], array($this, 'meta_display'), $context, $this->metaargs['context'], $this->metaargs['priority'], $this->metaargs );
		}
	}

	/**
	 * Display content 
	 * @param  array $post 
	 * @param  array $args 
	 * @return html       
	 */
	public function meta_display( $post, $args){
		//echo get_post_type( $post->ID );
		//print_r( get_post_custom($post->ID) );
		?>
		<div class="rsimple metabox">
			<div class="content">
		<?php		
		new rsimple_metafields($args['args']);
		?>
			</div>
		</div>
		<?php
	}

	/**
	 * Save metabox fields
	 * @param  string $post_id 
	 * @return [type]          [description]
	 */
	public function save( $post_id ){
		global $post;

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;

		if( isset($post->ID) ){
			foreach($this->metaargs['fields'] as $field){				
				if(isset( $_POST[ $this->metaargs['id'] ][ $field['id'] ] ) ) {				
					update_post_meta($post_id, $field['id'], ( $_POST[ $this->metaargs['id'] ][ $field['id'] ] ) );
				}
			}
		}
	}

	
	public  function get_args_val($name){
		return $this->args['option_name'];
	}

	/**
	 * Load style or script needed
	 */
	public function __enqueue(){
		wp_enqueue_style('metabox-style', rsimple_framework::$__url .'assets/css/metabox-style.css');
		wp_enqueue_script('metabox-style', rsimple_framework::$__url .'assets/js/rsimple-metabox.js');

		foreach((array)$this->metaargs['fields'] as $field){	
			$field = wp_parse_args($field, $this->__default_field());
			$class = 'rsimple_'. $field['type'];

			if(class_exists($class)){
				$field = new $class($field);
				$field->enqueue();
			}
		}		
	}


	public function __default_field(){
		$default = array(
			'target' => '',
			);

		return wp_parse_args(rsimple_framework::__default_field(), $default);
	}
	
}


class rsimple_metafields extends rsimple_metabox{
	protected $fields;

	public function __construct($fields){
		$this->fields = $fields;

		$this->display();
	}

	public function display(){
		global $post;

		foreach( (array)$this->fields['fields'] as $field){
			$field = wp_parse_args($field, $this->__default_field());
			
			$class = '';

			$field['name'] = $this->fields['id'].'['. $field['id'] .']';				
			$className = 'rsimple_'. $field['type'];

			if($this->fields['build']){
				$value = get_post_field( $field['id'], $post->ID, 'raw');
			} else {
				$value = get_metadata('post', $post->ID, $field['id'], true);
			}

			if( $field['target'] !=='' ){				
				$class = 'rsimple-condition-page rsimple-'. $field['target'];
			}
			
			//echo $class;
			?>
			<div class="rsimple_fields <?php echo $class; ?>" data-type="<?php echo $field['type']; ?>">
				<div class="fields_left">
					<span class="title"><?php echo $field['title']; ?></span>
					<small><?php echo $field['subtitle']; ?></small>
				</div>
				<div class="fields_right">
				<?php
				if(class_exists($className)){
					$field = new $className($field, $value, $this);
					$field->display();
				}
				?>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php
		}
	}
}