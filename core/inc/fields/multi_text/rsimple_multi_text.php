<?php
/**
 * Rsimple Field Multi Text
 */

class rsimple_multi_text{
	public $fieldArgs;

	public function __construct( $args = array(), $value =''){		
		$this->fieldArgs = $args;
		$this->value = $value;
	}

	public function display(){
		?>
		<div class="rsimple-multi_text" data-id="<?php echo $this->fieldArgs['name']; ?>">
			<div class="rsimple-target">
				<?php 
					foreach((array) $this->value  as $text){
						?>
						<span class="text">
							<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[]" value="<?php echo $text; ?>">&nbsp;
							<a class="remove">Remove</a>
						</span>
						<?php
					}
				?>
			</div>
			<a class="button button-primary multi_text_btn">Add <?php echo $this->fieldArgs['title']; ?></a>
		</div>
		<?php
	}

	public function enqueue(){
		wp_enqueue_script('rsimple-multi_text', rsimple_framework::$__url.'inc/fields/multi_text/rsimple_multi_text.js');
		wp_enqueue_style('rsimple-multi_text', rsimple_framework::$__url.'inc/fields/multi_text/rsimple_multi_text.css');
	}
}