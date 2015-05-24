<?php
/**
 * Rsimple Field Switch
 */

class rsimple_switch{

	public $fieldArgs;

	public function __construct( $args = array(), $value =''){
		$this->fieldArgs = $args;
		$this->value = $value;
	}

	public function display(){
		?>
		<div class="rsimple-switch">
			<span class="switch_enable">ON</span>
			<span class="switch_disable">OFF</span>
			<input type="hidden" class="switch_val" value="<?php echo $this->value; ?>" name="<?php echo $this->fieldArgs['name']; ?>">
			<small class="desc"><?php echo $this->fieldArgs['desc']; ?></small>
		</div>
		<?php
	}

	public function enqueue(){
		wp_enqueue_style('rsimple-switch', rsimple_framework::$__url.'inc/fields/switch/rsimple_switch.css');
		wp_enqueue_script('rsimple-switch', rsimple_framework::$__url.'inc/fields/switch/rsimple_switch.js');
	}

}