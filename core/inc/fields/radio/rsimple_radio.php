<?php
/**
 * Rsimple Radio field
 */

class rsimple_radio{
	public $fieldArgs;

	public function __construct( $args = array(), $value ='' ){		
		$this->fieldArgs = $args;
		$this->value = $value;
	}

	public function display(){
		?>
		<div class="rsimple-radio">
			<ul>
			<?php
				foreach((array)$this->fieldArgs['options'] as $key_radio => $radio){
					$checked = ($this->value == $key_radio)? 'checked="checked"' : '';
					?>
					<li>
						<input type="radio" name="<?php echo $this->fieldArgs['name']; ?>" value="<?php echo $key_radio; ?>" <?php echo $checked; ?>>
						<?php echo $radio; ?>
					</li>
					<?php
				}
			?>
			</ul>
			<small class="desc"><?php echo $this->fieldArgs['desc']; ?></small>
		</div>
		<?php
	}

	public function enqueue(){

	}
}