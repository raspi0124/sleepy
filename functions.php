<?php

//load css

wp_enqueue_style( '/inc/css/font-awesome.min.css', get_stylesheet_uri() );


///////////////////////////////////////
// Add Article Widget
///////////////////////////////////////
register_sidebars(1,
  array(
  'name'=>'In Article',
  'id' => 'widget-in-article',
  'description' => __('This widget appears in front of the first H2 tag in the post', 'sleepy'),
  'before_widget' => '<div id="%1$s" class="widget-in-article %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-in-article-title">',
  'after_title' => '</div>',
));

define('H2_REG', '/<h2.*?>/i');

function get_h2_included_in_body( $the_content ){
  if ( preg_match( H2_REG, $the_content, $h2results )) {
    return $h2results[0];
  }
}

function add_widget_before_1st_h2($the_content) {
  if ( is_single() &&
       is_active_sidebar( 'widget-in-article' )
  ) {
    ob_start();
    dynamic_sidebar( 'widget-in-article' );
    $ad_template = ob_get_clean();
    $h2result = get_h2_included_in_body( $the_content );
    if ( $h2result ) {
      $count = 1;
      $the_content = preg_replace(H2_REG, $ad_template.$h2result, $the_content, 1);
    }
  }
  return $the_content;
}
add_filter('the_content','add_widget_before_1st_h2');


//Setting for copyright

//Get first post year
function get_first_post_year(){
  $year = null;
  //get post time of oldest post
  query_posts('posts_per_page=1&order=ASC');
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    $year = intval(get_the_time('Y'));//最初の投稿の年を取得
  endwhile; endif;
  wp_reset_query();
  return $year;
}

//Display Copyright
function get_copylight_credit(){
  //Only site name
  $site_tag = get_bloginfo('name');
  //Site name and link
  //$site_tag = ' <a href="'.home_url().'">'.get_bloginfo('name').'</a>';
  return '&copy; '.get_first_post_year().' '.$site_tag;
}


//Made thumb (size=100x100)
add_image_size('thumb100', 100, 100, true);

//Get Site Domain
function get_this_site_domain(){

  preg_match( '/https?://(.+?)//i', admin_url(), $results );
  return $results[1];
}


//Add Only home sidebar

register_sidebar( array(
	'name' => __( 'Only Home Sidebar', 'sleep' ),
	'id' => 'home_sidebar',
	'description' => __( 'This sidebar will only show on frontage.', 'sleep' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );


//Add Avater for Comments
add_filter( 'avatar_defaults', 'newgravatar' );

function newgravatar ($avatar_defaults) {
$myavatar =
'https://lh4.googleusercontent.com/rDa29miI6l611YhBSRsSUxpCf0fDOjxbnaFkasUFdMoU3Ksap3_wSuOeMdzb7_ElewApYo2Hed2XqmM';
$avatar_defaults[$myavatar] = "cat";
return $avatar_defaults;
}

//customizer settings

add_action( 'customize_register', 'theme_customize_register' );
function theme_customize_register($wp_customize) {
    $wp_customize->add_section( 'sleepy_section', array(
        'title'          => __('Settings for sleepy theme', 'sleepy'),
        'priority'       => 100,
	'label'		 => 'test',
    ));

$wp_customize->add_setting('sleepy_options[text01]', array(
   'type'  => 'option',
));
$wp_customize->add_control( 'sleepy_textfield', array(
    'settings' => 'sleepy_options[text01]',
    'label' =>__('enter the sentence you want to display after copyright', 'sleepy'),
    'section' => 'sleepy_section',
    'type' => 'text',
));
$wp_customize->add_setting('sleepy_options[text02]', array(
   'type'  => 'option',
));
$wp_customize->add_control( 'sleepy_textfield2', array(
    'settings' => 'sleepy_options[text02]',
    'label' =>__('write the code you want to write in the header.', 'sleepy'),
    'section' => 'sleepy_section',
    'type' => 'text',
));
$wp_customize->add_setting( 'sleepy_options[footer-color]', array(
    'type' => 'option'
));
$wp_customize->add_control( new WP_Customize_Color_Control(
    $wp_customize, 'sleepy_options[footer-color]',
    array(
        'settings' => 'sleepy_options[footer-color]',
        'label' => __('Footer background color', 'sleepy'),
        'section' => 'sleepy_section',
)));
}
