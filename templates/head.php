<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="數來寶：鼠喉大作讚 - 我要當明星" />
	<meta property="og:image" content="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/dist/images/share.jpg" />
    <meta property="og:description" content="《數來寶：鼠喉大作讚》最可愛、最搞怪的花栗鼠用歌聲強是回歸再推續集，鼠一鼠二的合聲唱腔，詮釋當下最HOT流行樂曲，台灣於2016年1月22日上映。" />
    <meta property="og:locale" content="zh_TW" />
    <meta property="og:site_name" content="數來寶：鼠喉大作讚 - 我要當明星" />
    <meta property="og:type" content="website"/>
	<meta property="fb:add_id" content="574874969335972"/>

    <?php if(isset($_GET['vid'])):?>
	    <link rel="video_src" href="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/lib/videos/<?php echo $_GET['vid']?>.mp4">
	    <meta property="og:video" content="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/lib/videos/<?php echo $_GET['vid']?>.mp4"/>
	    <meta property="og:video:secure_url" content="http://event.ck101.com/thechipmunks/wp-content/themes/sage-theme/lib/videos/<?php echo $_GET['vid']?>.mp4"/>
	    <meta property="og:video:type" content="video/mp4"/>
	    <meta property="og:video:width" content="480"/>
	    <meta property="og:video:height" content="320"/>
	<?php endif?>
	<?php 
		$title = get_the_title();

		// switch(get_query_var('pagename')){
		// 	case 'term':
		// 		$title = '活動辦法'
		// }
		// if(is_home()){

		// }
		?>
	<title><?php echo $title?></title>
<?php wp_head(); ?>
</head>
