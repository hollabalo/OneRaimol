<?php


	$db = mysql_connect('localhost', 'root', '')
	or die('Unable to connect');
	
	mysql_select_db('db_oneraimol');
        
        if(!empty($_FILES["file"])) {
            function findexts ($filename)  { 
                    $filename = strtolower($filename) ; 
                    $exts = explode("[/\\.]", $filename) ; 
                    $n = count($exts)-1; 
                    $exts = $exts[$n]; 
                    return $exts; 
            }
	
            $record = $_POST['record'];
            
            
            if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || 
                 ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/png") ||
                 ($_FILES["file"]["type"] == "image/x-png")) && ($_FILES["file"]["size"] < 1200000)) {

                  $width = 100;
                  $height = 150;

                  $filetype = '';
                  
                  switch($_FILES["file"]["type"]) {
                      case "image/gif": 
                          $filetype = '.gif';
                          break;
                      
                      case "image/pjpeg":
                      case "image/jpeg":
                          $filetype = '.jpg';
                          break;
                      
                      case "image/x-png":
                      case "image/png":
                          $filetype = '.png';
                  }
                  
                  $ext = substr(base64_encode(findexts($_FILES["file"]["name"])), 0, 10) ;

                  $ran = time(); 
                  $newfilename = $ran.".".$ext . $filetype;

                  move_uploaded_file($_FILES["file"]["tmp_name"],
                  "assets/photos/".$newfilename);

                  $type = $_FILES["file"]["type"];
                  if($type == "image/pjpeg" || $type == "image/jpeg") {
                    header('Content-type: image/jpeg');
                    $image = imagecreatefromjpeg('assets/photos/'.$newfilename);
                  }
                  elseif($type == "image/x-png" || $type == "image/png") {
                    header('Content-type: image/png');
                    $image = imagecreatefrompng('assets/photos/'.$newfilename);
                  }
                  elseif($type == "image/gif") {
                    header('Content-type: image/gif');
                    $image = imagecreatefromgif('assets/photos/'.$newfilename);
                  }

                  list($width_orig,$height_orig) = getimagesize('assets/photos/'.$newfilename);
                  $ratio_orig = $width_orig/$height_orig;

                  if($width_orig/$height_orig > $ratio_orig) $width = $height*$ratio_orig;
                  else $height = $width/$ratio_orig;

                  $image_p = imagecreatetruecolor($width, $height);
                  imagecopyresampled($image_p,$image,0,0,0,0,$width,$height,$width_orig,$height_orig);


                  imagejpeg($image_p, 'assets/thumbs/'.$newfilename, 100);
                  imageDestroy ($image_p);
                  imageDestroy ($image);
                  
                  if(isset($newfilename)) {
                    $sig = "UPDATE staff_tb SET 
                      signature = '$newfilename'
                             WHERE staff_id = '$record'";	
                  }

                  mysql_query($sig);

                  header('Location: ' . $_POST['url'] . '?upload=success');
                  
              }
              else {
                  header('Location: ' . $_POST['url'] . '?upload=fail');
              }
              
            }