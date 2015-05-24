<?php
/**
 * Display Rsimple
 */

if( ! defined('ABSPATH') )
	exit;

if( !class_exists('rsimple_display') ){

	class rsimple_display extends rsimple_framework{		
		private $displayArgs = array();		

		public function __construct( $args ){			
			$this->displayArgs = $args;			
			//Display content
			$this->display();			

		}

		public function display(){
			?>
			<div class="wrap rsimple">
				<div class="header">
					<h1><?php echo $this->displayArgs['display_name']; ?> <small><?php echo $this->displayArgs['display_version']; ?></small></h1>
				</div>
				<div class="control">				
					<button class="save button button-primary send-right">Save Changes</button>
				</div>
				<div class="message">
					Settings saved.
				</div>
				<div class="contents">
					<div class="menu">
						<ul>
							<?php 
								$mx = 1;
								foreach((array)$this->displayArgs['sections'] as $menu){
									$menu = wp_parse_args($menu, $this->__default_section());
							?>
							<li><a href="#content-<?php echo $mx; ?>"><i class="icon fa <?php echo $menu['icon']; ?>"></i>&nbsp;<span><?php echo $menu['title']; ?></span></a></li>
							<?php $mx++; } ?>						
						</ul>
					</div>
					<div class="content">
						<form id="rsimple">
							<input type="hidden" name="action" value="<?php echo $this->displayArgs['option_name']; ?>_save_update">
							<input type="hidden" name="nonce-security" value="<?php echo wp_create_nonce('security'); ?>">
							<input type="hidden" name="name" value="<?php echo $this->displayArgs['option_name']; ?>">
						<?php
							$cx=1;
							foreach((array)$this->displayArgs['sections'] as $content){
								?>

								<div id="content-<?php echo $cx; ?>" class="section" style="display:none;">
									<?php
										new rsimple_fields( $content['fields'], $this->displayArgs );
									?>
								</div>
								<?php
								$cx++;
							}					
						?>	
						</form>				
					</div>
				</div>
				<div class="control">
					<button class="save button button-primary send-right">Save Changes</button>
				</div>
			</div>
			<?php
		}

	}

}