<?php
/**
 * Data stuff
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


//activity custom post type

// Register Custom Post Type activity
// Post Type Key: activity

function create_activity_cpt() {

  $labels = array(
    'name' => __( 'Activities', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Activity', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Activity', 'textdomain' ),
    'name_admin_bar' => __( 'Activity', 'textdomain' ),
    'archives' => __( 'Activity Archives', 'textdomain' ),
    'attributes' => __( 'Activity Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Activity:', 'textdomain' ),
    'all_items' => __( 'All Activities', 'textdomain' ),
    'add_new_item' => __( 'Add New Activity', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Activity', 'textdomain' ),
    'edit_item' => __( 'Edit Activity', 'textdomain' ),
    'update_item' => __( 'Update Activity', 'textdomain' ),
    'view_item' => __( 'View Activity', 'textdomain' ),
    'view_items' => __( 'View Activities', 'textdomain' ),
    'search_items' => __( 'Search Activities', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into activity', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this activity', 'textdomain' ),
    'items_list' => __( 'Activity list', 'textdomain' ),
    'items_list_navigation' => __( 'Activity list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Activity list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'activity', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'activity', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_activity_cpt', 0 );


add_action( 'init', 'create_year_taxonomies', 0 );
function create_year_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Years', 'taxonomy general name' ),
    'singular_name' => _x( 'year', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Years' ),
    'popular_items' => __( 'Popular Years' ),
    'all_items' => __( 'All Years' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Years' ),
    'update_item' => __( 'Update year' ),
    'add_new_item' => __( 'Add New year' ),
    'new_item_name' => __( 'New year' ),
    'add_or_remove_items' => __( 'Add or remove Years' ),
    'choose_from_most_used' => __( 'Choose from the most used Years' ),
    'menu_name' => __( 'Year' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('years',array('activity'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'year' ),
    'show_in_rest'          => true,
    'rest_base'             => 'year',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}

add_action( 'init', 'create_month_taxonomies', 0 );
function create_month_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Months', 'taxonomy general name' ),
    'singular_name' => _x( 'month', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Months' ),
    'popular_items' => __( 'Popular Months' ),
    'all_items' => __( 'All Months' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Months' ),
    'update_item' => __( 'Update month' ),
    'add_new_item' => __( 'Add New month' ),
    'new_item_name' => __( 'New month' ),
    'add_or_remove_items' => __( 'Add or remove Months' ),
    'choose_from_most_used' => __( 'Choose from the most used Months' ),
    'menu_name' => __( 'Month' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('months',array('activity'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'month' ),
    'show_in_rest'          => true,
    'rest_base'             => 'month',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}

add_action( 'init', 'create_conference_taxonomies', 0 );
function create_conference_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Conferences', 'taxonomy general name' ),
    'singular_name' => _x( 'conference', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Conferences' ),
    'popular_items' => __( 'Popular Conferences' ),
    'all_items' => __( 'All Conferences' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Conferences' ),
    'update_item' => __( 'Update conference' ),
    'add_new_item' => __( 'Add New conference' ),
    'new_item_name' => __( 'New conference' ),
    'add_or_remove_items' => __( 'Add or remove Conferences' ),
    'choose_from_most_used' => __( 'Choose from the most used Conferences' ),
    'menu_name' => __( 'Conference' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('conferences',array('activity'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'conference' ),
    'show_in_rest'          => true,
    'rest_base'             => 'conference',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}


add_action( 'init', 'create_type_taxonomies', 0 );
function create_type_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'popular_items' => __( 'Popular Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Types' ),
    'update_item' => __( 'Update type' ),
    'add_new_item' => __( 'Add New type' ),
    'new_item_name' => __( 'New type' ),
    'add_or_remove_items' => __( 'Add or remove Types' ),
    'choose_from_most_used' => __( 'Choose from the most used Types' ),
    'menu_name' => __( 'Type' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('types',array('activity'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
    'show_in_rest'          => true,
    'rest_base'             => 'type',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}


//THESE WERE TO AUTOMATE IPMORT FROM CSV AND THE FUNCTION IS NOW OFF
function tww_csv_make_activities($title, $description, $year, $month, $type, $conference, $link){
    $args = array(
      'post_title'    => wp_strip_all_tags($title),
      'post_type'     => 'activity',
      'post_status'  => 'publish', 
      'post_content' => $description,
      'tax_input'    => array(
            'years' => $year,
            'months' => $month,
            'types' => $type,
            'conferences' => $conference,
        ),
    );
    $post_id = wp_insert_post($args);
    add_post_meta($post_id, 'activity_link', $link, true);
    add_post_meta($post_id, 'activity_conference', $conference, true);
}

function tww_parse_csv(){
    $file_path = get_stylesheet_directory() . '/data/activities.csv';
     if(isset($file_path)){
    
        $filename = $file_path;    
    
        $file = fopen($filename, "r");
        fgetcsv($file);
          while (($getData = fgetcsv($file, 1000, ",")) !== FALSE) {
            $title = $getData[0];
            $year = array(tww_term_checker($getData[1],'years'));
            $month = array(tww_term_checker($getData[2], 'months'));
            $type = array(tww_term_checker($getData[3], 'types'));
            $link = $getData[4];
            $conference = array(tww_term_checker($getData[5],'conferences'));
            $description = $getData[6];            
            
            if($title != ''){
                tww_csv_make_activities($title, $description, $year, $month, $type, $conference, $link);
            }
           }
      
           fclose($file);  
     }   
}

function tww_term_checker($term, $tax){
    if($term){
         if(!term_exists($term, $tax)){
           $new = wp_insert_term($term,$tax);
           return $new;
        } else {
            $term = term_exists($term, $tax);
            return $term["term_id"];
        }

    } else {
        return '';
    }

}



/** add additional classes / id to the facetwp-template div generated by a facetwp 
 ** layout template
 **/
add_filter( 'facetwp_shortcode_html', function( $output, $atts) {
    if ( $atts['template'] = 'example' ) { // replace 'example' with name of your template
    /** modify replacement as needed, make sure you keep the facetwp-template class **/
        $output = str_replace( 'class="facetwp-template"', 'class="facetwp-template row"', $output );
    }
    return $output; 
}, 10, 2 );