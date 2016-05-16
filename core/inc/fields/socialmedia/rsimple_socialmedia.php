<?php
/**
 * Rsimple Field Social Media
 */

class rsimple_socialmedia{
	public $fieldArgs;

	public function __construct( $args = array(), $value =''){
		$this->fieldArgs = $args;
		$this->value = $value;
	}

	public function display(){
		$default = array(
			'facebook' => '',
			'twitter' => '',
			'linkedin' => '',
			'tumblr' => '',
			'googleplus' => '',
			'pinterest' => '',
			'youtube' => '',
			'flickr' => '',
			'instagram' => '',
			);

		$values = wp_parse_args( $this->value, $default);
		?>
		<div class="rsimple-socialmedia">
			<div class="rsimple-target">
				<div class="facebook">
					<div class="form">
						<label>Facebook</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[facebook]" value="<?php echo $values['facebook']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>
					<div class="form">
						<label>Twitter</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[twitter]" value="<?php echo $values['twitter']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>
					<div class="form">
						<label>Linkedin</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[linkedin]" value="<?php echo $values['linkedin']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>
					<div class="form">
						<label>Tumblr</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[tumblr]" value="<?php echo $values['tumblr']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>
					<div class="form">
						<label>Google Plus</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[googleplus]" value="<?php echo $values['googleplus']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>
					<div class="form">
						<label>Pinterest</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[pinterest]" value="<?php echo $values['pinterest']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>
					<div class="form">
						<label>Youtube</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[youtube]" value="<?php echo $values['youtube']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>
					<div class="form">
						<label>Flickr</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[flickr]" value="<?php echo $values['flickr']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>					
					<div class="form">
						<label>Instagram</label>
						<input type="text" name="<?php echo $this->fieldArgs['name']; ?>[instagram]" value="<?php echo $values['instagram']; ?>">
						<small class="desc">Please enter full link including http:// or https:// to your account</small>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public function enqueue(){
		wp_enqueue_style('rsimple-socialmedia', rsimple_framework::$__url.'inc/fields/socialmedia/rsimple_socialmedia.css');
		wp_enqueue_script('rsimple-socialmedia', rsimple_framework::$__url.'inc/fields/socialmedia/rsimple_socialmedia.js');
	}
}
