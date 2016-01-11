<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>鼠來寶-鼠喉大作戰 之 明星選拔賽</title>
    <meta property="og:locale" content="zh_TW" />
    <meta property="og:site_name" content="數來寶：鼠喉大作讚 - 我要當明星" />
    <meta property="og:type" content="website"/>
	<meta property="fb:add_id" content="574874969335972"/>
    <?php if(isset($_GET['vid'])):?>


	<?php

			$post_id = $_GET['vid'];
		    $obj = array();
		    $args = array(
		      'post_type' => 'post',
		      'ID' => $post_id
		    );
		    $wp_query = new WP_Query( $args ); 
		    if (have_posts()):
		      the_post();
		      $obj['post_id'] = get_the_id();
		      $obj['vid'] = get_post_meta ($post_id, 'vid', true);
		      $obj['message'] = get_post_meta ($post_id, 'message', true);
		      $obj['chipmunk'] = get_post_meta ($post_id, 'chipmunk', true);
		      $obj['fbid'] = get_post_meta ($post_id, 'fbid', true);
		      $obj['name'] = get_post_meta ($post_id, 'name', true);
		      $obj['content'] = get_the_content();
		    else:
		      $obj['invalid'] = true;
		    endif;

    	?>
	<link rel="canonical" href="http://event.ck101.com/thechipmunks/?pagename=watch&amp;vid=<?php echo $post_id?>">
    <link rel="video_src" href="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/lib/videos/<?php echo $obj['vid']?>.mp4">
    <meta property="og:video" content="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/lib/videos/<?php echo $obj['vid']?>.mp4"/>
    <meta property="og:video:secure_url" content="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/lib/videos/<?php echo $obj['vid']?>.mp4"/>
    <meta property="og:video:type" content="video/mp4"/>
    <meta property="og:video:width" content="480"/>
    <meta property="og:video:height" content="320"/>
	<meta property="og:title" content="鼠來寶：鼠喉大作讚 - 明日之星選拔賽" />
	<meta property="og:image" content="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/lib/videos/<?php echo $obj['vid']?>.jpg" />
    <meta property="og:description" content="快看我表演 [鼠來寶:鼠喉大作讚] 誰都擋不了我當明星！" />
	<?php else :?>
	<meta property="og:title" content="鼠來寶：鼠喉大作讚 - 我要當明星" />
	<meta property="og:image" content="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/dist/images/share.jpg" />
	<meta property="og:description" content="《鼠來寶：鼠喉大作讚》最可愛、最搞怪的花栗鼠用歌聲強是回歸再推續集，鼠一鼠二的合聲唱腔，詮釋當下最HOT流行樂曲，台灣於2016年1月22日上映。" />

	<?php endif?>
	<?php wp_head(); ?>
</head>
