<?php

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
      'post_content'   =>'<video poster="'.get_site_url().'/wp-content/themes/sage-theme/lib/videos/'.$form['vid'].'.jpg" src="'.get_site_url().'/wp-content/themes/sage-theme/lib/videos/'.$form['vid'].'.mp4" preload="metadata" controls="controls" width="480" height="320"><source src="'.get_site_url().'/wp-content/themes/sage-theme/lib/videos/'.$form['vid'].'.mp4" /></video>',
      'post_name'      =>$form['name'],
      'post_title'     =>$form['name'].' 的影片',
      'post_status'    =>'publish',
      'post_type'      => 'post'
    );
    $fin = wp_insert_post($post);
    $post_data = array( 'ID' => $fin ); // the ID is required

    
    CFS()->save( array(
      'chipmunk' => $form['chipmunk'],
      'name' => $form['name'],
      'vid' => $form['vid'],
      'fbid' => $form['fbid'],
      'video_src' => $form['video_src'],
      'email' => $form['email'],
      'message' => $form['message'],
    ), $post_data );
    $json = array();
    $json['success'] = 1;
    $json['post_id'] = $fin;
    $json['vid'] = $form['vid'];
    header('Content-Type: application/json');
    echo json_encode($json);
    exit;
  }

  if(isset($_GET['page'])){
    $page = $_GET['page'];
    $args = array(
      'post_type' => 'post',
      'orderby' => 'date',
      'order'   => 'DESC',
      'posts_per_page' => 20,
      'paged' => $page
    );
    $wp_query = new WP_Query( $args ); 
    $json = array();
    $list = array();
    if (have_posts()): 
      while (have_posts()) : the_post();
        $obj = array();
        $obj['post_id'] = get_the_id();
        $obj['vid'] = get_post_meta ($obj['post_id'], 'vid', true);
        array_push($list, $obj);
      endwhile;
    endif;

    $count_posts = wp_count_posts();
    $published_posts = $count_posts->publish;
    $json['list'] = $list;
    $json['count'] = $published_posts;

    if(sizeof($list) < 20){
      $json['end'] = true;
    }else{
      $json['end'] = false;
    }
    header('Content-Type: application/json');
    echo json_encode($json);
    exit;
  }
  if(isset($_GET['vpost'])){
    $post_id = $_GET['vpost'];
    $json = array();
    $args = array(
      'post_type' => 'post',
      'p' => $post_id
    );
    $wp_query = new WP_Query( $args ); 
    if (have_posts()):
      the_post();
      $json['post_id'] = get_the_id();
      $json['vid'] = get_post_meta ($post_id, 'vid', true);
      $json['message'] = get_post_meta ($post_id, 'message', true);
      $json['chipmunk'] = get_post_meta ($post_id, 'chipmunk', true);
      $json['fbid'] = get_post_meta ($post_id, 'fbid', true);
      $json['name'] = get_post_meta ($post_id, 'name', true);
      $json['content'] = get_the_content();
    else:
      $json['invalid'] = true;
    endif;
    header('Content-Type: application/json');
    echo json_encode($json);
    exit;
  }
  ?>
<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?><!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?> data-current-slick="<?php echo isset($_GET['pagename'])?$_GET['pagename']:''?>" data-vid="<?php echo isset($_GET['vid'])?$_GET['vid']:''?>">
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap fixed" role="document">
      <div class="content row">
        <main class="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-622529-30', 'auto');
  ga('send', 'pageview');

</script>
  </body>
</html>
