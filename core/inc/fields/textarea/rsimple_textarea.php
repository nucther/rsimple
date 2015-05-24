<?php
/**
 * RSimple Field Textarea
 */

class rsimple_textarea{
	public $fieldArgs;

	public function __construct( $args=array(), $value = ''){
		$this->fieldArgs = $args;
		$this->value = $value;
	}

	public function display(){
		?>
		<div class='rsimple-textarea'>
			<textarea name="<?php echo $this->fieldArgs['name']; ?>" id="<?php echo $this->fieldArgs['id'];?>"><?php echo $this->value; ?></textarea>
			<small class="desc"><?php echo $this->fieldArgs['desc']; ?></small>
		</div>
		<?php
	}

	public function enqueue(){
		wp_enqueue_style('rsimple-textarea', rsimple_framework::$__url.'inc/fields/textarea/rsimple_textarea.css');
	}
}