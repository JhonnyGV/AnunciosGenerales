<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
  <?php include("includes/footer.php"); ?>
<div id="main">
  <div id="navigation"><a href="index.php">Return to Public Site</a><a href="staff.php">Return to Staff Menu</a></div>
  <br/>
  <div id="search">
    <form method="post" action="client_result.php" name="client_result">
      <label>Search by:</label>
      <select name="command" id="menulist">
        <option value="user_name">Name</option>
        <option value="user_contact">Number</option>
        <option value="user_email">Email</option>
        <option value="id">Property id</option>
      </select>
      <input type="text" name="input_value" placeholder="Enter Value" id="menulist">
      &nbsp;&nbsp;
      <input type="submit" value="Search" name="Search" id="search_button">
    </form>
  </div>
  <br/>
  <br/>
  <div><br/>
    <br/>
    <br/>
    <br/>
    <h3>Property Details</h3>
    <?php
		$query = "SELECT * FROM property";
		if($_SESSION['region']!=NULL){
		$query .= " WHERE property_locality='".$_SESSION['region']."'";}
		if($_SESSION['sub_region']!=NULL){
		$query .= " AND property_sub_locality='".$_SESSION['sub_region']."'";}
		$query .= " order by id desc";
		$propertyarray = mysql_query($query, $connection);
		confirm_query($propertyarray);
		$output = "";
	//	echo "<center>";
		echo "<table border=\"1\">";
				echo "<th>Property Id</th><th>User Details</th><th>Property Size</th><th>Property Type</th><th>Property For</th><th>Floor</th><th>Total Floor</th><th>Property Name</th><th>Price</th><th>Area</th><th>Address</th>";
				while ($property_set_1 = mysql_fetch_array($propertyarray)) {
			echo "<tr>";
			echo "<td align=\"center\">" .$property_set_1['id']."</td>";
			echo "<td align=\"center\">" . $property_set_1['user_name']."<br/>";			
			echo $property_set_1['user_contact']. "<br/>";
			echo $property_set_1['user_email'] ."</td>";
			echo "<td align=\"center\">" .$property_set_1['property_size']."</td>";
			echo "<td align=\"center\">" .$property_set_1['property_type']."</td>";
			echo "<td align=\"center\">" .$property_set_1['property_for']."</td>";
			echo "<td align=\"center\">" .$property_set_1['property_on_floor']."</td>";
			echo "<td align=\"center\">" .$property_set_1['total_floor']."</td>";
			echo "<td align=\"center\">" .$property_set_1['property_name']."</td>";
			echo "<td align=\"center\">" .$property_set_1['price']."</td>";
			echo "<td align=\"center\">" .$property_set_1['built_area']." ".$property_set_1['built_area_type']."</td>";
			echo "<td width=\"5000\">" . $property_set_1['property_address'] ."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</span>";
	//	echo "</center>";
	?>
  </div>
</div>
