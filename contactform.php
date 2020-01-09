<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/footer.php"); ?>
<div id="navigation"><a href="index.php">View All Properties</a>&nbsp;&nbsp;<a href="form_main.php">Post Property</a>&nbsp;&nbsp;<a href="our_projects.php">Our project's</a>&nbsp;&nbsp;<a href="contactform.php">Contact us</a></div>
<div id="index_ads">
	<center>
		<h3>Advertisements</h3>
		<hr size="3">
	<?php
		$query = "SELECT * FROM advertisements";
		$advertisements = mysql_query($query, $connection);
		confirm_query($advertisements);
		$output="";
		while ($advertisements_set = mysql_fetch_array($advertisements)) {
			echo "<img src='uploaded_ads/".$advertisements_set['ad_image']. "'". "height=\"160px\"" . "width=\"300px\">". "<br/>";
			echo "<div id=\"index_ads_contact\">";
			echo "Contact: " . $advertisements_set['contact_name'] ." - " . $advertisements_set['contact_number'] ."<br /><br/>";
			echo "</div>";
			echo "<br>";
		}
	?>
	</center>
</div>
<center>
<div id="contact">
		<h3><u>TPCS Marketing</u></h3>
		<p>
			Contact number : +91-9503-885725 <br/><br/>
			Address : Office 3, DBATU Lonere, Raigad, Maharashtra 
		</p>
		<hr size="1">
<form name="contactform" method="post" action="send_form_email.php">
<table width="450px">
<tr>
 <td valign="top">
  <label for="first_name">Your Name </label></td>
 <td valign="top">
  <input  type="text" name="first_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top"">Organization Name :</td>
 <td valign="top">
  <input  type="text" name="last_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="email">Email Address :</label></td>
 <td valign="top">
  <input  type="text" name="email" maxlength="80" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="telephone">Contact Number :</label>
 </td>
 <td valign="top">
  <input  type="text" name="telephone" maxlength="30" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Message :</label>
 </td>
 <td valign="top">
  <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Submit" id="submit"></td>
</tr>
</table>
</form>