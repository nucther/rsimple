<?php
/**
 * Rsimple Gallery Fields
 */

class rsimple_gallery{
  public $fieldArgs;

  public function __construct($args, $value=''){
    $this->fieldArgs = $args;
    $this->value = $value;
  }

  public function display(){

    ?>
    <div class="rsimple-gallery">
      <div class="gallery-lists">
      <?php
      //print_r($this->value);
      $values = $this->value;
      if(!empty($values)){
      $x = 1;
      foreach((array)$values as $value){
        //print_r($value);
        $img = wp_get_attachment_image_src( $value['id'], 'thumbnail', true);
      ?>
        <div class="glist">
          <img src="<?php echo $img[0]; ?>">
          <input type="hidden" name="<?php echo $this->fieldArgs['name']; ?>[<?php echo $x; ?>][id]" value="<?php echo $value['id']; ?>">
          <input type="hidden" name="<?php echo $this->fieldArgs['name']; ?>[<?php echo $x; ?>][type]" value="<?php echo $value['type']; ?>">
          <?php if(isset($value['type'])){
            ?>
            <b>Video Link ( Youtube / Vimeo)</b><br>
            <?php
          } else {  ?>
            <b>Description</b><br>
          <?php } ?>
          <textarea name="<?php echo $this->fieldArgs['name']; ?>[<?php echo $x; ?>][desc]"><?php echo $value['desc']; ?></textarea>
          <div class="close"></div>
        </div>
      <?php $x++; } }
      ?>
        <div class="clearfix"></div>
      </div>
      <div class="gallery-button">
        <a class="button button-primary gallery-image-btn" data-name="<?php echo $this->fieldArgs['name']; ?>">Add Image</a>
        <?php if(!$this->fieldArgs['disablevideo']){ ?>
          <a class="button button-primary gallery-video-btn" data-name="<?php echo $this->fieldArgs['name']; ?>">Add Video</a>
        <?php }  ?>
      </div>
      <div class="video-add">
        <p>Video Link ( Youtube / Vimeo)</p>
        <p><textarea name="gal-video"></textarea></p>
        <p>Image Preview</p>
        <p>
          <div class="video-target"></div>
          <br>
          <a class="add-prev">Add Preview Images</a>
          <a class="remove hidden">Remove Preview Images</a>
        </p>
        <p><a class="button button-primary add-to-list" data-id="<?php echo $this->fieldArgs['name']; ?>">Add Video to List</a></p>
      </div>
    </div>
    <?php
  }

  public function enqueue(){
    wp_enqueue_style('media-upload');
    wp_enqueue_style('gallery', rsimple_framework::$__url .'/inc/fields/gallery/rsimple_gallery.css');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('gallery', rsimple_framework::$__url .'/inc/fields/gallery/rsimple_gallery.js');
  }
}

?>
