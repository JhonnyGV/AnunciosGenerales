<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<div id="navigation">
	<a href="index.php">Return to Public Site</a>
	<a href="staff.php">Return to Staff Menu</a>
</div>
<div id="staff_work">
	<h3>Advertisement Id:</h3>
	<form method="post" action="delete_ad.php" name="search_by_id_result" id="search_by_id">
			<input type="text" name="id" placeholder="Advertisent Id" size="15">
			<input type="submit" value="Delete Property" name="delete" id="submit" onclick="return confirm('Are you sure you want to delete this property');">
	</form>
</div>
<br /><br /><br />
<?php
	$query = "DELETE FROM advertisements WHERE ID = {$_POST['id']} LIMIT 1";
	$result = mysql_query ($query);
	if (mysql_affected_rows() == 1) {
		// Successfully deleted
		//redirect_to("staff.php");
	}
?>
<div id="navigation">
	<?php
		$query = "SELECT * FROM advertisements";
		$advertisements = mysql_query($query, $connection);
		confirm_query($advertisements);
		$output="";
		while ($advertisements_set = mysql_fetch_array($advertisements)) {
	
			echo "<table cellpadding=\"5\">";
			echo "<tr><td>Advertisement id:</td><td>" . $advertisements_set['id']."</td>";			
			echo "<td colspan=\"2\">Contact: " . $advertisements_set['contact_name'] ." - " . $advertisements_set['contact_number']. "</td></tr></table>";
		}
	?>
</div>		
<?php include("includes/footer.php"); ?>