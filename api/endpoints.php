<?php

require 'process_hours.php';


function washu_dining_get_merchants($request)
{

     $params = $request->get_query_params();

     $args = [
          'post_type'   => 'merchants',
          'numberposts' => -1,
     ];
     $posts = get_posts($args);

     $data = [];
     $save = NULL;
     $coords = [];

     $i = 0;

     foreach ($posts as $post) {
          $id = $post->ID;
          $coords = [floatval(get_field('latitude', $id)), floatval(get_field('longitude', $id))];

          try {
               $save = get_post_meta($id, 'js_test_value');
               if (isset($save)) {
                    $save = json_decode($save[0]);
               }
          } catch (Exception $e) {
               $save = "error";
          }

          $print_terms = [];
          $categories = get_the_terms($id, 'merchant_categories');
          if ($categories != false) {
               foreach($categories as $category) {
                    array_push($print_terms, $category->term_id);
               };
          }

          $data[$i]['id'] = $id;
          $data[$i]['title'] = get_the_title($id);
          $data[$i]['description'] = get_field('description', $id);
          $data[$i]['type'] = get_field('location_type', $id);
          $data[$i]['link'] = get_the_permalink($id);
          $data[$i]['categories'] = $print_terms;
          
          $data[$i]['location'] = $coords;
          
          $data[$i]['hours']['string'] = get_field('hours_of_operation', $id);
          
          if ($save != false) {
               $data[$i]['hours']['isOpen'] = isOpen($save[$params['day']], $params['hour']);
               $data[$i]['hours']['today'] = $save[$params['day']];
          }
          else {
               $data[$i]['hours']['isOpen'] = false;
               $data[$i]['hours']['today'] = null;
          }
          
          
          $data[$i]['esthetics']['image'] = get_the_post_thumbnail_url($id, 'large');
          $data[$i]['esthetics']['icon'] = wp_get_attachment_image_url(get_field('icon', $id), 'full');
          $data[$i]['esthetics']['icon_type'] = get_field('icon_type', $id);
          $data[$i]['esthetics']['primary_color'] = get_field('primary_color', $id);
          $data[$i]['esthetics']['secondary_color'] = get_contrast_color($data[$i]['esthetics']['primary_color']);

          $data[$i]['esthetics']['navigate'] = get_field('navigation', $id);
          $data[$i]['esthetics']['grubhub'] = get_field('grubhub', $id);

          $i++;
     }

     return $data;
}


function washu_dining_get_events_for_location($request)
{

     $location = intval($request['id']);

     $cat = get_term_by('slug', 'events', 'category');
     $cat_id = $cat->term_id;

     $args = [
          'post_type'   => 'post',
          'category' => $cat_id,
          'numberposts' => -1,
          'meta_key' => 'where',
          'meta_value' => $location
     ];

     $posts = get_posts($args);

     $data = [];
     $i = 0;
     $today = serialize_date(date("d/m/Y"));
     $min = null;

     foreach ($posts as $post) {
          $id = $post->ID;

          $file = [];
          $file['id'] = $id;
          $file['title'] = get_the_title($id);
          $file['description'] = get_field('description', $id);

          $date = get_field('date', $id);
          $date_serialized = serialize_date($date);
          $distance_to_event = $date_serialized - $today;

          $file['date'] = $date;
          $file['date_serialized'] = $date_serialized;
          $file['distance_to_date'] = $distance_to_event;
          $file['start_time'] = get_field('start_time', $id);
          $file['where'] = get_field('where', $id);

          if ($min == null) {
               array_unshift($data, $file);
               $min = $date_serialized - $today;
          } else if ($distance_to_event == 0) {
               array_unshift($data, $file);
               $min = 0;
          } else if ($distance_to_event < 0) {
               array_push($data, $file);
          } else if ($distance_to_event < $min) {
               array_unshift($data, $file);
               $min = $date_serialized - $today;
          } else {
               array_push($data, $file);
          }

          $i++;
     }

     return $data;
}

function washu_dining_get_events($data)
{
     $cat = get_term_by('slug', 'events', 'category');
     $cat_id = $cat->term_id;

     $args = [
          'post_type'   => 'post',
          'category' => $cat_id,
          'numberposts' => -1
     ];

     $posts = get_posts($args);

     $data = [];
     $i = 0;

     foreach ($posts as $post) {
          $id = $post->ID;

          $data[$i]['id'] = $id;
          $data[$i]['title'] = get_the_title($id);
          $data[$i]['description'] = get_field('description', $id);
          $data[$i]['date'] = get_field('date', $id);
          $data[$i]['start_time'] = get_field('start_time', $id);
          $data[$i]['where'] = get_field('where', $id);

          $i++;
     }

     return $data;
}


// Update custom meta field
function save_encoded_hours_metadata($id = false, $post = false)
{
    $data = [];

    $normal_hours = get_field('hours_of_operation', $id);
    $data = process_hours($normal_hours);

    $encoded_data = json_encode($data);

    if (!add_post_meta($id, 'js_test_value', $encoded_data, true)) {
        update_post_meta($id, 'js_test_value', $encoded_data);
    }
}

add_action('save_post', 'save_encoded_hours_metadata');