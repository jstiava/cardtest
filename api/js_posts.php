<?php

require 'process_hours.php';

function washu_dining_get_locations($data) {
     $cat = get_term_by('slug', 'locations', 'category');
     $cat_id = $cat->term_id;
     $args = [
          'post_type'   => 'post',
          'category' => $cat_id,
          'numberposts' => -1,
     ];
     $posts = get_posts( $args );

     $data = [];
     $i = 0;

     foreach($posts as $post) {
          $id = $post->ID;

          $data[$i]['id'] = $id;
          $data[$i]['title'] = get_the_title($id);
          $data[$i]['description'] = get_field('description', $id);
          $data[$i]['type'] = get_field('location_type', $id);
          $data[$i]['link'] = get_the_permalink($id);
          $data[$i]['latitude'] = floatval(get_field('latitude', $id));
          $data[$i]['longitude'] = floatval(get_field('longitude', $id));

          $normal_hours = get_field('hours_of_operation', $id);
          $data[$i]['schedule']['normal']['hours'] = process_hours($normal_hours);
          $data[$i]['schedule']['normal']['string'] = $normal_hours;

          $special_hours = get_field('special_hours_of_operation', $id);
          $data[$i]['schedule']['special']['active'] = get_field('ready_special_hours', $id);
          $data[$i]['schedule']['special']['hours'] = process_hours($special_hours);
          $data[$i]['schedule']['special']['string'] = $special_hours;

          $tertiary_hours = get_field('tertiary_hours_of_operation', $id);
          $data[$i]['schedule']['tertiary']['active'] = get_field('ready_tertiary_hours', $id);
          $data[$i]['schedule']['tertiary']['hours'] = process_hours($tertiary_hours);
          $data[$i]['schedule']['tertiary']['string'] = $tertiary_hours;

          $data[$i]['esthetics']['icon_type'] = get_field('icon_type', $id);
          $data[$i]['esthetics']['icon'] = wp_get_attachment_image_url(get_field('icon', $id), 'full');
          $data[$i]['esthetics']['primary_color'] = get_field('primary_color', $id);

          $data[$i]['navigate'] = get_field('navigation', $id);
          $data[$i]['grubhub'] = get_field('grubhub', $id);

          // EVENTS
          $data[$i]['events'] = false;

          // CHILDREN
          $data[$i]['child_elements'] = false;

          $children = get_field('child_elements', $id);
          if ($children == false) {
               $data[$i]['child_elements'] = false;
               $i++;
               continue;
          }

          $data_children = array();
          $j = 0;
          foreach ($children as $child) {
               $id = $child;

               $data_children[$j]['id'] = $id;
               $data_children[$j]['title'] = get_the_title($id);
               $data_children[$j]['description'] = get_field('description', $id);
               $data_children[$j]['type'] = get_field('location_type', $id);
               $data_children[$j]['link'] = get_the_permalink($id);

               $normal_hours = get_field('hours_of_operation', $id);
               $data_children[$j]['schedule']['normal']['hours'] = process_hours($normal_hours);
               $data_children[$j]['schedule']['normal']['string'] = $normal_hours;

               $special_hours = get_field('special_hours_of_operation', $id);
               $data_children[$j]['schedule']['special']['active'] = get_field('ready_special_hours', $id);
               $data_children[$j]['schedule']['special']['hours'] = process_hours($special_hours);
               $data_children[$j]['schedule']['special']['string'] = $special_hours;

               $tertiary_hours = get_field('tertiary_hours_of_operation', $id);
               $data_children[$j]['schedule']['tertiary']['active'] = get_field('ready_tertiary_hours', $id);
               $data_children[$j]['schedule']['tertiary']['hours'] = process_hours($tertiary_hours);
               $data_children[$j]['schedule']['tertiary']['string'] = $tertiary_hours;

               $data_children[$j]['esthetics']['icon_type'] = get_field('icon_type', $id);
               $data_children[$j]['esthetics']['icon'] = wp_get_attachment_image_url(get_field('icon', $id), 'full');
               $data_children[$j]['esthetics']['primary_color'] = get_field('primary_color', $id);

               $data_children[$j]['navigate'] = get_field('navigation', $id);
               $data_children[$j]['grubhub'] = get_field('grubhub', $id);

               $j++;

          }
          $data[$i]['child_elements'] = $data_children;
          $i++;
     }

     return $data;
}


function washu_dining_get_events_for_location($request) {



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

     $posts = get_posts( $args );

     $data = [];
     $i = 0;
     $today = serialize_date(date("d/m/Y"));
     $min = null;

     foreach($posts as $post) {
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
          }
          else if ($distance_to_event == 0) {
               array_unshift($data, $file);
               $min = 0;
          }
          else if ($distance_to_event < 0) {
               array_push($data, $file);
          }
          else if ($distance_to_event < $min) {
               array_unshift($data, $file);
               $min = $date_serialized - $today;
          }
          else {
               array_push($data, $file);
          }

          $i++;
     }

     return $data;
}

function washu_dining_get_events($data) {
     $cat = get_term_by('slug', 'events', 'category');
     $cat_id = $cat->term_id;

     $args = [
          'post_type'   => 'post',
          'category' => $cat_id,
          'numberposts' => -1
     ];

     $posts = get_posts( $args );

     $data = [];
     $i = 0;

     foreach($posts as $post) {
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