<?php

require "messages.php";
/*Create a gallery*/
if(isset($_POST['btn-create-gallery']))
{

$galleryname=trim($_POST['galleryname']);
$res=mkdir("../gallery/".$galleryname);
if($galleryname!="") /*meh*/
if($res)
{
	
	header("location: uploadimage.php?mc=GALLERY_CREATE_SUCC");
	/*$save_msg='<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Success!</strong> Gallery created sucessfully.
				</div>';*/
}
else
{
	header("location: uploadimage.php?mc=GALLERY_CREATE_FAIL");
/*	$save_msg='<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Error!</strong> Gallery created failed.
				</div>';*/

}
}

/*Upload an image*/
if(isset($_POST['btn-upload-image']))
{
	if($_POST['galleryselect']!=""){
	$galleryname=$_POST['galleryselect'];
	$allowedExts = array("jpg", "jpeg", "gif", "png");
    $extension = end(explode(".", $_FILES['file']['name']));
	$filename=rand().".".$extension;
	$res=move_uploaded_file($_FILES["file"]["tmp_name"],"../Gallery/".$galleryname."/". $filename);
	if($res)
{
	
	header("location: uploadimage.php?mc=IMAGE_UPLOAD_SUCC");
	/*$upload_msg='<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Success!</strong> Image Sucessfully uploaded.
				</div>';*/
}
else	
	{
	header("location: uploadimage.php?mc=IMAGE_UPLOAD_FAIL");
	}
}
}

 require("header.php"); 
?>
<div class="panel panel-default">
   <div class="panel-body">
    <h3>Create a new Gallery</h3>
	<form class="form-inline" role="form" action="" method="post">
    <div class="form-group">
      <label for="galleryname"></label>
      <input type="text" class="form-control" id="galleryname" name="galleryname" placeholder="Enter gallery name">
    </div>
   <button type="submit" class="btn btn-primary" name="btn-create-gallery">Create</button>
  </form>
   </div>
   	</form>
	<?php //echo (isset($save_msg)?$save_msg:""); ?>
	
  </div>
 <div class="panel panel-default">
    <div class="panel-body">
    <h3>Upload an Image</h3>
	
	
	<form class="form-inline" role="form" enctype="multipart/form-data" method="post">
		 <div class="form-group">
			<label for="gallery">Gallery</label>
			<select class="form-control" name="galleryselect">
			<?php
				$dirs = array_filter(glob('../gallery/*'), 'is_dir');
				foreach($dirs as $key=>$value)
					{
						$dir=end(explode('/',$value));
						echo "<option value='".$dir."'>".$dir."</option>";
					}
			?>
			</select>
		</div>
	   <div class="form-group">
			<label for="file">file</label>
			<input type="file" class="form-control" id="file" name="file">
		</div>
		<button type="submit" class="btn btn-primary" name="btn-upload-image">Upload</button>
  </form>
 </div>
 <?php //echo (isset($upload_msg)?$upload_msg:""); ?>
</div>
	<?php echo (isset($_GET['mc'])?$msgcodes[$_GET['mc']]:""); ?>
<?php require("footer.php"); ?>

