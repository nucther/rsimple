<?php
/**
 * RSimple Field Media
 */

class rsimple_media{
	public $fieldArgs;

	public function __construct( $args = array(), $value = ''){		
		$this->fieldArgs = $args;
		$this->value = $value;
	}

	public function display(){
		$imgID = $this->value;
				
		if(!empty($imgID['id'])){
			$img = wp_get_attachment_image_src( $imgID['id'], 'thumbnail', true);
			$imgfull = wp_get_attachment_image_src( $imgID['id'], 'full', true);
		}

		?>
		<div class="rsimple-media">
			<div class="rsimple-target">
				<?php 
				if(isset($imgID['id']) && isset($img[0])){
					?>
					<img src="<?php echo $img[0]; ?>">
					<input type="hidden" name="<?php echo $this->fieldArgs['name']; ?>[id]" value="<?php echo $imgID['id']; ?>">
					<input type="hidden" name="<?php echo $this->fieldArgs['name']; ?>[url]" value="<?php echo $imgfull[0]; ?>">
					<?php
				} ?>
			</div>
			<a class="button button-primary media-upload-btn" data-name="<?php echo $this->fieldArgs['name']; ?>">Upload/Edit</a>&nbsp;
			<a class="button button-danger media-remove-btn">Remove</a> 
			<small class="desc"><?php echo $this->fieldArgs['desc']; ?></small>
		</div>
		<?php
	}

	public function enqueue(){
		wp_enqueue_script('media-upload', rsimple_framework::$__url.'inc/fields/media/js/media.min.js');
		wp_enqueue_style('media-upload');
		wp_enqueue_script('rsimple-media', rsimple_framework::$__url.'inc/fields/media/rsimple_media.js');
		wp_enqueue_style('rsimple-media', rsimple_framework::$__url.'inc/fields/media/rsimple_media.css');
	}
}