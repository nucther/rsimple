<?php
/**
 * RSimple Field Image Select
 */

class rsimple_image_selects{
	public $fieldArgs;

	public function __construct( $args = array(), $value='' ){		
		$this->fieldArgs  = $args;
		$this->value = $value;
	}

	public function display(){
		?>
		<div class="rsimple-image_select">
			<ul>
				<?php
					$ix = 0;
					foreach( $this->fieldArgs['options'] as $key_image => $image){						
							$checked = ( $this->value == $key_image)? 'checked="checked"' : '';
							$class = ( $this->value == $key_image)? 'class="image_checked"' : '';
						?>
						<li>
							<label for="<?php echo $this->fieldArgs['id']; ?>-<?php echo $ix; ?>" <?php echo $class; ?>>
								<input type="radio" name="<?php echo $this->fieldArgs['name']; ?>" value="<?php echo $key_image; ?>" id="<?php echo $this->fieldArgs['id']; ?>-<?php echo $ix; ?>" <?php echo $checked; ?>>
								<img src="<?php echo rsimple_framework::$__url.$image['img']; ?>" alt="<?php echo $image['alt']; ?>">
							</label>
						</li>
						<?php
						$ix++;
					}
				?>
			</ul>
			<small class="desc"><?php echo $this->fieldArgs['desc']; ?></small>
		</div>
		<?php
	}

	public function enqueue(){
		wp_enqueue_style('rsimple-image_select', rsimple_framework::$__url.'inc/fields/image_select/rsimple_image_select.css');
		wp_enqueue_script('rsimple-image_select', rsimple_framework::$__url.'inc/fields/image_select/rsimple_image_select.js');
	}
}