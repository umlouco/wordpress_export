<?php

/*
  Plugin Name: Export Posts
  Description: Export posts with taxonomies
  Version: Version 1
  Author: Mario Flores
  Author URI: http://mario-flores.com
  License: Comercial
 */

/*
require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
*/

wp_enqueue_style('datatables', plugins_url('css/bootstrap.min.css', __FILE__),null, false, "all");
wp_enqueue_style('datatables', plugins_url('css/datatables.min.css', __FILE__),array('bootstap'), false, "all");

wp_enqueue_script('datatables', plugins_url('js/datatables.min.js', __FILE__), array('jquery'), false, true);
add_action('admin_menu', 'mf_export_menu'); 

function mf_export_menu(){
    add_menu_page("Export Posts", "Export Posts", "manage_options", "mf-export-posts", "mf_export_posts"); 
}

function mf_export_posts(){

    $posts = get_posts(array('post_type' => 'post', 'numberposts' => -1)); 
    $taxonomies = get_object_taxonomies("protocol", 'objects'); 
    $colums = 0; 
    if(!empty($posts)){
        foreach($posts as $key => $p){
         $out = array(); 
          foreach($taxonomies as $slug => $t){
              $terms = get_the_terms($p->ID, $slug); 
              if(!empty($terms)){
                  
                  foreach($terms as $term){
                      $out[] = $term->name; 
                  }
                  $posts[$key]->terms = $out;
                  if(sizeof($out) > $colums){
                      $colums = sizeof($out); 
                  }
              }
              
          }
        }
    }
    
    include(plugin_dir_path(__FILE__) . 'views/table.php');
}
