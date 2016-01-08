<?php

  error_reporting(E_ALL); // or E_STRICT
  ini_set("display_errors",1);
  ini_set("memory_limit","1024M");

  $message = '';

  //  Get the args from the command line to see what files to upload.
  $target_path = __DIR__."/uploads/";
  if(isset($_POST['fbid'])){
    $form = array(
      'chipmunk' => $_POST['chipmunk'],
      'name' => $_POST['me'],
      'vid' => $_POST['vid'],
      'fbid' => $_POST['fbid'],
      'video_src' => $_POST['video_src'],
      'email' => $_POST['email'],
      'message' => $_POST['message']
    );
    $post = array(
      'post_content'   =>'<video width="480" height="320" id="u_e_i" data-video-height="497" data-video-width="280" class="_ox1" preload="metadata" src="'.$form['video_src'].'"></video>',
      'post_name'      =>$form['name'],
      'post_title'     =>$form['name'].' 的影片',
      'post_status'    =>'publish',
      'post_type'      => 'post'
    );
    print_r($post);
    $fin = wp_insert_post($post);
    $fin = 79;
    print_r($fin);
    // $result = CFS()->save(
    //   array(
    //     'name' => $form['name'],
    //     'vid' => $form['vid'],
    //     'fbid' => $form['fbid'],
    //     'video_src' => $form['video_src'],
    //     'email' => $form['email'],
    //     'message' => $form['message']
    //   ),
    //   array( 'ID' => $fin )
    // );
    __update_post_meta($fin, 'chipmunk', $form['chipmunk']);
    __update_post_meta($fin, 'name', $form['name']);
    __update_post_meta($fin, 'vid', $form['vid']);
    __update_post_meta($fin, 'fbid', $form['fbid']);
    __update_post_meta($fin, 'video_src', $form['video_src']);
    __update_post_meta($fin, 'email', $form['email']);
    __update_post_meta($fin, 'message', $form['message']);
    exit;
  }
  /**
  * Updates post meta for a post. It also automatically deletes or adds the value to field_name if specified
  *
  * @access     protected
  * @param      integer     The post ID for the post we're updating
  * @param      string      The field we're updating/adding/deleting
  * @param      string      [Optional] The value to update/add for field_name. If left blank, data will be deleted.
  * @return     void
  */
function __update_post_meta( $post_id, $field_name, $value = '' )
{
    if ( empty( $value ) OR ! $value )
    {
        delete_post_meta( $post_id, $field_name );
    }
    elseif ( ! get_post_meta( $post_id, $field_name ) )
    {
        add_post_meta( $post_id, $field_name, $value );
    }
    else
    {
        update_post_meta( $post_id, $field_name, $value );
    }
}
?>