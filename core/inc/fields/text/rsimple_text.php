<?php
/**
 * RSimple Field Text
 */

class rsimple_text{
	public $fieldArgs;

	public function __construct($args=array(), $value =''){
		$this->fieldArgs = $args;	
		$this->value = $value;
	}

	public function display(){
		?>
		<div class="rsimple-text">			
			<input type="text" id="<?php echo $this->fieldArgs['id']; ?>" name="<?php echo $this->fieldArgs['name']; ?>" value="<?php echo $this->value; ?>" placeholder="<?php echo $this->fieldArgs['placeholder']; ?>">
			<small><?php echo $this->fieldArgs['desc']; ?></small>			
		</div>
		<?php
	}

	public function enqueue(){		
		wp_enqueue_style('rsimple_text', rsimple_framework::$__url.'inc/fields/text/rsimple_text.css');		
	}
}