<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<table id="left">
	<tr>
		<td id="navigation"><br/>
			<a href="index.php">Return to public site</a>
		</td></tr>
		<tr>
		<td id="page">
			<center>
			<p><h3>Welcome to the staff area, <?php echo $_SESSION['username']; ?>.</h3></p>
			<table cellpadding="2" border="2">
			<th colspan="2"><h2>Staff Menu</h2></th>
			<ul><tr>
				
				<td><li><a href="advertisements.php">Add Advertisements</a></li><br/></td>
				<td><li><a href="delete_ad.php">Delete Advertisements</a></li><br/></td>
				</tr>
				<tr>
				<td><li><a href="project_main.php">Add project</a></li><br/></td>
				<td><li><a href="delete_project.php">Delete Project</a></li><br/></td>
				</tr>
				<tr>
				<td><li><a href="form_main.php">Add Property</a></li><br/>
				<td><li><a href="delete_property.php">Delete Property</a></li><br/></td></tr>
				<tr><td><li><a href="http://www.gmail.com">Check Email</a></li><br/></td>
				<td><li><a href="new_user.php">Add Staff User</a></li><br /></td></tr>
				<th colspan="2"><br /><center><a href="logout.php"><h3>Logout</h3></a></th></center>
			</ul>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
