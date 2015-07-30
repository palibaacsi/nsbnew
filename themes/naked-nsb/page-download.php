<?
/*
 *
 * Template Name: Download Page
 *
 */
get_header();

?>
<div id="primary">
  <div id="content">

<h3>If you know a URL of an image that you'd like to download, you can use this page.</h3>

<form action="index.php" method="POST">
Name : <input type="text" name="name" /> <br>
URL: <input type="text" name="url" size="50"> <br>
<select name="ext">
    <option>.jpg</option>
    <option>.png</option>
</select><br>
<input type="submit" name="submit" value="Save Image">
</form>
</div>
</div>
<?php

// make a folder called images and CHMD it 777

if(isset ($_POST['name'])  &&  !empty($_POST['url']))
{

      $postImageName = ($_POST['name']) ;
      $postImageUrl = ($_POST['url']) ;
      $postImageExt = ($_POST['ext']) ;

      $postImageName = str_replace (" ","",$postImageName) ;
      @$rawImage = file_get_contents ($postImageUrl) ;
      if($rawImage)
      {
              file_put_contents("images/".$postImageName.$postImageExt,$rawImage) ;
              echo "Image Saved!";
	}
		else
	{
echo "error  getting image from url";
	}
}

get_footer();