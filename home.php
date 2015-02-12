<?php
require("connect-db.php");
require("messages.php");
/*****NEW POST*****/
if(isset($_POST['btn-save']))
{
$query="";
$content=mysql_real_escape_string($_POST["recent"]);
	if(isset($_FILES['file'])){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
    $extension = end(explode(".", $_FILES['file']['name']));
	$filename=rand().".".$extension;
	move_uploaded_file($_FILES["file"]["tmp_name"],"../recent_images/".$filename);
	$query="INSERT INTO recent(content,image) VALUES('".$content."','".$filename."')";
	}
	else
	{
		$query="INSERT INTO recent(content) VALUES('".$content."')";
	}



$res=mysql_query($query);
if($res)
{
	header("location: home.php?mc=RECENT_SAVE_SUCC");
	/*$save_msg='<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Success!</strong> Your message has been sucessfully saved.
				</div>';*/
}

}

/*******EDIT POST ******/
if(isset($_POST["btn-edit"]))
{
$query="";
$art_id=$_POST['art-id'];
$content=mysql_real_escape_string($_POST["recent"]);
if(isset($_FILES['file']) && $_FILES['file']['name']!=""){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
    $extension = end(explode(".", $_FILES['file']['name']));
	$filename=rand().".".$extension;
	move_uploaded_file($_FILES["file"]["tmp_name"],"../recent_images/".$filename);
	$query="UPDATE recent SET content='".$content."',image='".$filename."' WHERE id='".$art_id."'";
}
	else
	{
		$query="UPDATE recent SET content='".$content."' WHERE id='".$art_id."'";
	}

	$res=mysql_query($query);
	if($res)
	{
			
				header("location: home.php?mc=RECENT_EDIT_SUCC");
			/*$save_msg='<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Success!</strong> Your message has been sucessfully saved.
				</div>';*/
	
	}

}


?>
<?php require("header.php"); ?>
<h2>Recent Item</h2>
 <form role="form" method="post" action="" enctype="multipart/form-data">
    
	<div class="form-group">
      <label for="recent">Image:</label>
	  <input type="file" class="form-control" name="file"/>
	  </div>
	<div class="form-group">
      <label for="recent">Content:</label>
	  
	  <?php
	  
	  if(isset($_GET["mode"]))
	  {
		$art_id=$_GET['art_id'];
		$query="SELECT * FROM recent WHERE id='".$art_id."'";
		$res=mysql_query($query);
		$row=mysql_fetch_array($res);
		$content=$row["content"];
       
		}
	  ?>
	  
      <textarea class="form-control" rows="5" id="recent" name="recent"><?php echo(isset($content))?$content:""; ?></textarea><br/>
	  <?php
	  if(isset($_GET["mode"]))
	  {
	  echo 'Image :<img src="../recent_images/'.$row["image"].'" class="img-thumbnail" alt="ERR" height="150" width="150"/>';	
	  echo '<input type="hidden" name="art-id" value="'.$_GET['art_id'].'">';
	  echo ' <button type="submit" name="btn-edit" class="btn btn-danger pull-right">Edit</button>';
	  
	  }
	  else { ?>
	 <button type="submit" name="btn-save" class="btn btn-success pull-right">Save</button>
	 <?php } ?>
    </div>
	</form>
	<?php //echo (isset($save_msg)?$save_msg:""); ?>
	<?php echo (isset($_GET['mc'])?$msgcodes[$_GET['mc']]:""); ?>
<?php 
require("footer.php");
?>