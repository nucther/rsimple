<?php
/**
 * Class Fields
 */

if( ! defined('ABSPATH') )
	exit;

if( !class_exists('rsimple_fields')){

	class rsimple_fields extends rsimple_framework{		
		private $fields;
		public $args;

		public function __construct( $fields = array(), $args=array() ){
			$this->fields = $fields;
			$this->args = $args;
			//load component
			//$this->load_fields();

			//Display field
			$this->display();
		}

		/**
		 * Display content
		 * @return html 
		 */
		public function display(){			

			foreach($this->fields as $field){
				$field = wp_parse_args($field, self::__default_field());
				
				$field['name'] = $this->get_args_val('option_name').'['. $field['id'] .']';				
				$className = 'rsimple_'. $field['type'];

				$value = $this->get_value($field['id'], $field['default']);

				//echo $value;
				?>
				<div class="rsimple_fields" data-type="<?php echo $field['type']; ?>">
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

		private function load_fields(){		
			foreach(scandir(self::$__path .'inc/fields') as $field){
				if( !in_array($field, array('.','..'))){
					$file = self::$__path .'inc/fields/'. $field .'/rsimple_'. $field .'.php';
					if(is_file($file))
						require_once( $file );
				}
			}
		}

	}

}