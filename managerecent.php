<?php

require("connect-db.php");
require("messages.php");

if(isset($_GET["mode"]))
{
$art_id=$_GET["art_id"];
$query="DELETE FROM recent WHERE id='".$art_id."'";
$res=mysql_query($query);
if($res)
{
	header("location: managerecent.php?mc=");

}

}



require("header.php");

?>
<h2>Manage recent items</h2>
<table class="table table-bordered">
 <thead>
      <tr>
        <th class="col-md-1">#</th>
        <th class="col-md-9">Content</th>
        <th class="col-md-2"></th>
      </tr>
    </thead>
	<tbody>
<?php
	$sql = "SELECT  COUNT(*) FROM recent";
	$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
	$r = mysql_fetch_row($result);
	$numrows = $r[0];
	$rowsperpage = 10;
	$totalpages = ceil($numrows / $rowsperpage);
	if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
		$currentpage = (int) $_GET['currentpage'];
	} else {	  $currentpage = 1; } 
	
	if ($currentpage > $totalpages) {
		$currentpage = $totalpages;
		}
	if ($currentpage < 1) {
	   $currentpage = 1;
		} 
	$offset = ($currentpage - 1) * $rowsperpage;
	$sql = "SELECT id, content FROM recent LIMIT $offset, $rowsperpage";
	$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
	
	while ($list = mysql_fetch_assoc($result)) {
		echo "<tr>"; 
		echo "<td>".$list['id']."</td>";
		echo "<td>".$list['content']."</td>";
		echo '<td>
				
				<a href="home.php?mode=edit&art_id='.$list["id"].'" class="btn btn-primary">edit</a>
				<a href="managerecent.php?mode=del&art_id='.$list["id"].'" class="btn btn-danger" onclick="confirm("Are You sure");">delete</a>
				
			
		</td>';
		echo "</tr>";
	}
	
	echo "</tbody></table><ul class='pagination'>";
	if ($currentpage > 1) {
    echo "<li><a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> </li> ";
	$prevpage = $currentpage - 1;
    echo "<li> <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> </li>";
	}
	
	$range = 3;


for ($x = ($currentpage - $range); $x < (($currentpage + $range)  + 1); $x++) {
     if (($x > 0) && ($x <= $totalpages)) {
        if ($x == $currentpage) {
            echo " <li> <a href='#'><strong>$x</strong></a> </li> ";
      } else {
            echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li> ";
      } 
   } 
}
   
if ($currentpage != $totalpages) {
    $nextpage = $currentpage + 1;
    echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a></li> ";
    echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> </li>";
}   

echo "</ul>";

echo (isset($_GET['mc'])?$msgcodes[$_GET['mc']]:""); 
require("footer.php");
?>