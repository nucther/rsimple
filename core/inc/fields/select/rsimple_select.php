<?php
/**
 * Rsimple Field select
 */

class rsimple_select{
	public $fieldArgs;

	public function __construct( $args = array(), $value =''){
		$this->fieldArgs = $args;
		$this->value = $value;
	}

	public function display(){
		?>
		<div class="rsimple-select">
			<select id="<?php echo $this->fieldArgs['id']; ?>" name="<?php echo $this->fieldArgs['name']; ?>">
				<?php
					foreach($this->fieldArgs['options'] as $option_key => $option){
						$selected = ( $this->value == $option_key )? 'selected="selected"' : '';
				?>
					<option value="<?php echo $option_key; ?>" <?php echo $selected; ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			<small class="desc"><?php echo $this->fieldArgs['desc']; ?></small>
		</div>
		<?php 
	}

	public function enqueue(){
		wp_enqueue_script('rsimple-select', rsimple_framework::$__url.'inc/fields/select/rsimple_select.js');
		wp_enqueue_style('rsimple-select', rsimple_framework::$__url.'inc/fields/select/rsimple_select.css');
	}
}