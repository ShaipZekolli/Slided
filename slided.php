<?php
/* 
Plugin Name: Slided Plugin 
Description: Simple implementation of a slideshow in WordPress 
Author: Zekolli
Version: 1.1 
*/
if( !defined('ABSPATH') )
{
      echo 'Sorry nothing here!';
      exit;
}

class Slided {
	
      public function __construct()
      {
            add_action('init', array($this, 'create_custom_post_type'));
			
			add_action('wp_enqueue_scripts', array($this, 'load_assets'));
			
			add_shortcode('slided', array($this, 'load_shortcode'));
	  }
	  
      public function create_custom_post_type()
	  {
		     #$i =  plugin_dir_url( __DIR__ ).'images/placeholder.png'; $i =  plugin_dir_url( __FILE__ ).'css/slidedcss.css';echo "<script>alert('$i')</script>";#http://localhost/wordpress/wp-content/plugins/slided/css/slidedcss.css
            $args = array(
			'public' => true,
			'label' => 'Slided Images',
			'supports' => array(
							'title',
							'thumbnail'
							),
							'menu_icon' => 'dashicons-embed-photo',
						);
			register_post_type('np_images', $args);
	  }
	  
	  public function load_assets()
	  {
      wp_enqueue_style( 'slided-style', plugin_dir_url( __FILE__ ).'css/slidedcss.css', array(), null );
	  wp_enqueue_script( 'slided-js', plugin_dir_url( __FILE__ ).'js/slided.js', array(), null, true );
	  }
	
	public function load_shortcode(){
		$args = array(
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'posts_per_page' => -1,
            );

            $lastBlog = new WP_Query($args);
            foreach ($lastBlog->posts as $postimet) :
                $array[] = $postimet->ID;
            endforeach;
?>
				 <h1 id="h1slide">Some of the last posts</h1>
					<div class="slideshow-container">
					
						<div class="mySlides fade">
						  <div class="numbertext">1 / 3</div>
						  <img src="<?php echo wp_get_attachment_url($array[0]); ?>" style="width:100%">
						  <div class="text"><?php echo get_the_title($array[0]); ?></div>
						</div>

						<div class="mySlides fade">
						  <div class="numbertext">2 / 3</div>
						  <img src="<?php echo wp_get_attachment_url($array[1]); ?>" style="width:100%">
						  <div class="text"><?php echo get_the_title($array[1]); ?></div>
						</div>

						<div class="mySlides fade">
						  <div class="numbertext">3 / 3</div>
						  <img src="<?php echo wp_get_attachment_url($array[2]); ?>" style="width:100%">
						  <div class="text"><?php echo get_the_title($array[2]); ?></div>
						</div>

						<a class="prev" onclick="plusSlides(-1)">❮</a>
						<a class="next" onclick="plusSlides(1)">❯</a>

					</div>
					<br>
					<div style="text-align:center">
					  <span class="dot" onclick="currentSlide(1)"></span> 
					  <span class="dot" onclick="currentSlide(2)"></span> 
					  <span class="dot" onclick="currentSlide(3)"></span> 
					</div>
<?php }

}
new Slided;
?>