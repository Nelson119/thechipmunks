<?php

  error_reporting(E_ALL); // or E_STRICT
  ini_set("display_errors",1);
  ini_set("memory_limit","1024M");

  $message = '';

  use Facebook\Facebook;
  $loader = require __DIR__.'/vendor/autoload.php';
  require_once __DIR__.'/vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';

  // If you already have a valid access token:

  $token = 'CAAIK2IJWaKQBALBn5KRoZBRboyKMwQXfrcK4PKhIXFx6XYYSFzIehxjzssd7mY9soWwdExMN7kIQ3Svagyp3Q6W2KsqILf7EPgZB7NPLl08bteZCKziy9JDZBAZB357oflNuXUzrxPLnkB8h8naoJa45XpupHyjCSflaK7Ji6pczsZBlbDxkPMlXUP7Otpma4XY3GgSq8vNAZDZD';

function copyfile_chunked($infile, $outfile)
{
    $chunksize = 100 * (1024 * 1024); // 10 Megs

    /**
     * parse_url breaks a part a URL into it's parts, i.e. host, path,
     * query string, etc.
     */
    $parts    = parse_url($infile);
    $i_handle = fsockopen($parts['host'], 80, $errstr, $errcode, 5);
    $o_handle = fopen($outfile, 'wb');

    if ($i_handle == false || $o_handle == false) {
        return false;
    }

    if (!empty($parts['query'])) {
        $parts['path'] .= '?' . $parts['query'];
    }

    /**
     * Send the request to the server for the file
     */
    $request = "GET {$parts['path']} HTTP/1.1\r\n";
    $request .= "Host: {$parts['host']}\r\n";
    $request .= "User-Agent: Mozilla/5.0\r\n";
    $request .= "Keep-Alive: 115\r\n";
    $request .= "Connection: keep-alive\r\n\r\n";
    fwrite($i_handle, $request);

    /**
     * Now read the headers from the remote server. We'll need
     * to get the content length.
     */
    $headers = array();
    while (!feof($i_handle)) {
        $line = fgets($i_handle);
        if ($line == "\r\n")
            break;
        $headers[] = $line;
    }

    /**
     * Look for the Content-Length header, and get the size
     * of the remote file.
     */
    $length = 0;
    foreach ($headers as $header) {
        if (stripos($header, 'Content-Length:') === 0) {
            $length = (int) str_replace('Content-Length: ', '', $header);
            break;
        }
    }

    /**
     * Start reading in the remote file, and writing it to the
     * local file one chunk at a time.
     */
    $cnt = 0;
    while (!feof($i_handle)) {
        $buf   = '';
        $buf   = fread($i_handle, $chunksize);
        $bytes = fwrite($o_handle, $buf);
        if ($bytes == false) {
            return false;
        }
        $cnt += $bytes;

        /**
         * We're done reading when we've reached the conent length
         */
        if ($cnt >= $length)
            break;
    }

    fclose($i_handle);
    fclose($o_handle);
    return $cnt;
}


  //  Get the args from the command line to see what files to upload.
  $target_path = __DIR__."/uploads/";
  if(isset($_FILES['video'])){
    $target_path = $target_path . basename( $_FILES['video']['name']); 

    if(move_uploaded_file($_FILES['video']['tmp_name'], $target_path)) {
      $message = "The file ".  basename( $_FILES['video']['name']). 
      " has been uploaded";
    } else{
      $message = "There was an error uploading the file, please try again!";
    }
    $files = Array();
    array_push($files, $target_path);

    $fb = new \Facebook\Facebook([
      'app_id' => '574874969335972',
      'app_secret' => '54ca7b3e1b7c1bd171fb1c9988c1b4fe',
      'default_graph_version' => 'v2.2',
    ]);

    foreach ($files as $file_name) {

      $privacy = array(
        'value' => 'CUSTOM',
        'friends' => 'SELF'
      );
      $data = [
        'title' => '',
        'description' => '',
        'source' => $fb->videoToUpload($file_name),
        'privacy' => $privacy
      ];

      $json = array();

      try {
        $response = $fb->post('/roleplayergame2016/videos', $data, $token);
        header('Content-Type: application/json');
        $video_id = $response->getGraphObject()->getProperty('id');
        $json['id'] = $video_id;
        // echo json_encode($response);
      } catch(\Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        $message = 'Graph returned an error: ' . $e->getMessage();
        header('Content-Type: application/json');
        $json['message'] = json_encode($message);
      } catch(\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        $message = 'Facebook SDK returned an error: ' . $e->getMessage();
        header('Content-Type: application/json');
        $json['message'] = json_encode($message);
      }
    }

    $status = false;
    while(!$status){
      $response = $fb->get('/'.$video_id.'?fields=source,thumbnails,status', $token);

      if($response->getGraphObject()->getProperty('status')->getProperty('video_status') != 'ready'){
        continue;
      }else{
        $status = true;
      }


      $source = $response->getGraphObject()->getProperty('source');
      $destination = __DIR__."/videos/".$video_id.'.mp4';
      
      $json['video_src'] = $source;
      
      copyfile_chunked($source,$destination);

      $source = $response->getGraphObject()->asArray()['thumbnails'][0]['uri'];

      $destination = __DIR__."/videos/".$video_id.'.jpg';

      copyfile_chunked($source,$destination);

    }

    header('Content-Type: application/json');
    echo json_encode($json);


    // header('Content-Type: application/json');
    // echo json_encode($response);
    // print_r($source);
    exit;

  }
?>