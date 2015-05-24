<?php
/**
 * Wordpress usefull functions
 */

class rsimple_wp extends rsimple_framework{

	private $queues;	

	public function __construct(){		
		$this->remove_unused_wp();		
	}
	
	/**
	 * Remove unused wp 	 
	 */
	public function remove_unused_wp(){
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}

	/**
	 * Execute wp action	 
	 */
	public function action(){		
		add_action('after_setup_theme', array($this,'action_after_setup_theme'));
		add_action('wp_head', array($this,'action_head'));
	}

	/**
	 * Execute action on wp_head	 
	 */
	public function action_head(){
		foreach($this->queues as $css){
			if(isset($css['loc']) && $css['loc'] == 'head'){
				if($css['type'] == 'style')
					wp_enqueue_style( $css['name'], $css['url']);
				
				if($css['type'] == 'script')
					wp_enqueue_script( $css['name'], $css['url']);
			}
		}
	}

	/** 
	 * Execution action on after setup theme
	 */
	public function action_after_setup_theme(){
		foreach($this->queues as $act){
			if($act['type']== 'themesupport'){
				add_theme_support($act['name']);
			}

			if($act['type'] =='menus'){
				register_nav_menu( $act['name'], $act['title']);
			}
		}
	}

	/**
	 * Add Query for style or script
	 * @param string $type     
	 * @param string $name     
	 * @param string $url      
	 * @param string $location
	 */
	public function add_queue($type, $name, $url, $location = 'head'){
		$this->queues[] = array(
				'type' => $type,
				'name' => $name,
				'url' => $url,
				'loc' => $location
			);		
	}

	/**
	 * Add Theme support
	 * @param string $type 
	 * @param array $value
	 */
	public function add_themesupport($type, $value = null){
		$this->queues[] = array(
			'type' => 'themesupport',
			'name' => $type
			);
	}

	/**
	 * Add menus
	 * @param array $menus
	 */
	public function add_menus($menus = array()){
		if( is_array($menus) ){
			foreach($menus as $kmenu => $menu){
				$this->queues[] = array(
					'type' => 'menus',
					'name' => $kmenu,
					'title' => $menu
					);
			}
		} 		
	}

}