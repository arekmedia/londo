<?php
class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
 
}


// Define a destination
include('config.php');
$targetFolder = '/media/upload'; // Relative to the root
$time		  = chr(rand(65, 90)).chr(rand(65, 90)).chr(rand(65, 90))."(".$_FILES['Filedata']['size'].")".strtotime(date('y-m-d H:i:s'));
if (!empty($_FILES)) {
	$filename		= $_REQUEST['sesid']."_".$time."_".$_FILES['Filedata']['name'];
	$tempFile 		= $_FILES['Filedata']['tmp_name'];
	$targetPath 	= $_SERVER['DOCUMENT_ROOT'].$targetFolder;
	$targetPath 	= rtrim($targetPath,'/');
	
	// Validate the file type
	$fileTypesImg = array('jpg','jpeg','gif','png','doc','pdf'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypesImg) && $_FILES['Filedata']['size'] < 3000000) {
	
		$targetFile 	= $targetPath.'/photo/full/'.$filename;
		$targetFileThumb = $targetPath.'/photo/thumb/'.$filename;
		$targetFileIkon = $targetPath.'/photo/icon/'.$filename;
		move_uploaded_file($tempFile,$targetFile);
		
		$image = new SimpleImage();
		$image->load($targetFile);
		$image->resizeToWidth(200);
		$image->save($targetFileThumb);

		$image->load($targetFile);
		$image->resizeToWidth(36);
		$image->save($targetFileIkon);
  
		$sql_data = "select sk_photo from jbseek where sk_id='".$_REQUEST['sesid']."'";
		$query_data = mysql_query($sql_data);

		$row_data	= mysql_fetch_array($query_data);
		
		if(file_exists($targetPath.'/photo/full/'.$row_data['sk_photo']))
			unlink($targetPath.'/photo/full/'.$row_data['sk_photo']);
		if(file_exists($targetPath.'/photo/thumb/'.$row_data['sk_photo']))
			unlink($targetPath.'/photo/thumb/'.$row_data['sk_photo']);
			
  
		$sql	= "update jbseek set sk_photo='".$filename."' where sk_id='".$_REQUEST['sesid']."'";
		mysql_query($sql);
   
		echo "http://".$_SERVER['SERVER_NAME']."/media/upload/photo/thumb/".$filename;
	} else {
		echo 'Invalid file type.';
	}
}
?>