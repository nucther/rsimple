<?php
/**
 * Rsimple Field Checkbox
 */

class rsimple_checkbox{
	public $fieldArgs;

	public function __construct( $args=array(), $value='' ){		
		$this->fieldArgs = $args;
		$this->value = $value;
	}

	public function display(){
		?>
		<div class="rsimple-checkbox">
			<ul>
				<?php 
				foreach((array)$this->fieldArgs['options'] as $key_checkbox => $checkbox){					
					$checked = ( in_array($key_checkbox, $this->value) )? 'checked="checked"' : '';
				?>
				<li>
					<input type="checkbox" name="<?php echo $this->fieldArgs['name']; ?>[]" value="<?php echo $key_checkbox; ?>" <?php echo $checked; ?>> 
					<?php echo $checkbox; ?>
				</li>
				<?php } ?>
			</ul>
			<small class="desc"><?php echo $this->fieldArgs['desc']; ?></small>
		</div>
		<?php
	}

	public function enqueue(){

	}
}