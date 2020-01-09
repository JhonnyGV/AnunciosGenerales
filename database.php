<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header_db.php");?>
<div id="main">
	<div id="search">
			<form method="post" action="client_result_db.php" name="client_result_db">
			<select name="property_type" id="menulist">
				<option value="null">Select property type</option>
				<option value="Residential Apartment">Residential Apartment</option>
				<option value="Residential Land">Residential Land</option>
				<option value="Independent House/Villa">Independent House/Villa</option>
				<option value="Independent Builder/Floor">Independent Builder/Floor</option>
				<option value="Farm House">Farm House</option>
				<option value="Studio Apartment">Studio Apartment</option>
				<option value="Serviced Apartments">Serviced Apartments</option>
				<option value="Commercial Office/Space">Commercial Office/Space</option>
				<option value="Commercial Shop">Commercial Shop</option>
				<option value="Commercial Land/Inst. Land">Commercial Land/Inst. Land</option>
				<option value="Commercial Showroom">Commercial Showroom</option>
				<option value="Agricultural Land/Farm Land">Agricultural Land/Farm Land</option>
				<option value="Industrial Land/Plots">Industrial Lands/ Plots</option>
				<option value="Factory">Factory</option>
				<strong name="Warehouse">Warehouse</strong>
				<option value="Office space in IT park">Office space in IT Park</option>
				<option value="Office space in Business Park">Office space in Business Park</option>
				<option value="Hotel/Resort">Hotel/Resort</option>
				<option value="Guest-House/Banquet-Hall">Guest-House/Banquet-Hall</option>
				<option value="Space in Retail Mall">Space in Retail Mall</option>
				<option value="Business Center">Business Center</option>
				<strong name="Manufacuting">Manufacturing</strong>
				<option value="Cold Storage">Cold Storage</option>
				<option value="Time Share">Time Share</option>
				<option value="Other">Other</option>
			</select>&nbsp;&nbsp;

			<select name="property_locality" id="menulist">
				<option value="null">Select City</option>
				<option>Central Mumbai subrubs</option>
							<option>Mumbai Andheri-Dahisar</option>
							<option>Mumbai Beyond Thane</option>
							<option>Mumbai Harbour</option>
							<option>Mumbai South</option>
							<option>Mumbai South West</option>
							<option>Mumbai Thane</option>
			</select>&nbsp;&nbsp;
			<input type="text" name="search_sub_locality" placeholder="Property Locality" id="menulist">&nbsp;&nbsp;
			<select name="property_size" id="menulist">
			<option value="null">Select Apartment size</option>	
			<option value="1 RK">1 RK</option>
			<option value="1 BHK">1 BHK</option>
			<option value="1.5 BHK">1.5 BHK</option>
			<option value="2 BHK">2 BHK</option>
			<option value="2.5 BHK">2.5 BHK</option>
			<option value="3 BHK">3 BHK</option>
			<option value="4 BHK">4 BHK</option>	
			</select>
				<input type="submit" value="Search" name="Search" id="search_button">
			</form>
			
	</div>
<div>
	<br/><br/>
	<?php 
	if($_SESSION['client_db']=='yes'){
	echo "<table><div id=\"display_count\"><tr>";
 
 $d_query = "SELECT count(*) FROM property";
 $property2 = mysql_query($d_query, $connection);
 confirm_query($property2);
 $output2 = "";
 while ($property_set2 = mysql_fetch_array($property2)) {
   echo "<td><center>Total Properties<br/>".$property_set2['count(*)']."</center></td>";
  }
  
 $d_query = "SELECT count(*) FROM property where property_locality='Navi-Mumbai'";
 $property2 = mysql_query($d_query, $connection);
 confirm_query($property2);
 $output2 = "";
 while ($property_set2 = mysql_fetch_array($property2)) {
   echo "<td><center>Properties in Navi-mumbai<br/>".$property_set2['count(*)']."</center></td>";
  }
  $d_query = "SELECT count(*) FROM property where property_sub_locality='kharghar'";
 $property2 = mysql_query($d_query, $connection);
 confirm_query($property2);
 $output2 = "";
 while ($property_set2 = mysql_fetch_array($property2)) {
   echo "<td><center>Properties in Kharghar<br/>".$property_set2['count(*)']."</center></td>";
  }

 $d_query = "SELECT count(*) FROM property where property_sub_locality='Nerul'";
 $property2 = mysql_query($d_query, $connection);
 confirm_query($property2);
 $output2 = "";
 while ($property_set2 = mysql_fetch_array($property2)) {
   echo "<td><center>Properties in nerul<br/>".$property_set2['count(*)']."</center></td>";
  }
  echo "</tr></table></div>";
	echo "<table border=\"1\" width=\"100%\" cellpadding=\"2\">";
		$query = "SELECT * FROM clients order by id asc";
		$property = mysql_query($query, $connection);
		confirm_query($property);
		$output = "";
		
		echo "<th>id</th><th>Client info</th><th>Client Interaction</th><th>Requirment Details</th><th></th><th></th>";
		while ($property_set = mysql_fetch_assoc($property)) {
		echo "<form name=\"update_client_db\" action=\"update_client_db.php\" method=\"post\">";
			echo "<tr>";
			echo "<td valign=\"top\"><center><br/>".$property_set['id']."</center></td>";
			echo "<td style=\"padding-left:10px; padding-right:10px;\" valign=\"top\"><br/>". $property_set['name']."<br />";			
			echo  $property_set['phone']. "<br />";
			echo $property_set['email'] ."<br />".$property_set['type']."</td>";
			echo "<td width=\"400\" valign=\"top\"><br/>";
			 if($property_set['fwd']=="0000-00-00 00:00:00" || $property_set['fwd']==NULL){
				echo "<input type=\"datetime-local\" name=\"u_fwddte\" value='".$property_set['fwd']."'><br/>";
				echo "No scheduled Appointment.<br/> ";
			}
			else{
				echo " <input type=\"datetime-local\" name=\"u_fwddte\">";
				echo date("d-M-Y h:i a",strtotime($property_set['fwd']));
				echo "<br/>";
			}
			
			echo"<br/><textarea name=\"s_log\" readonly>".$property_set['log']."</textarea><br/><input type=\"text\" name=\"edit_log\" size=\"62\" Placeholder=\"Enter Client interaction here.\"><p style=\"color:grey;\">Last updated by: ".$property_set['updated_by']." on ".$property_set['updated_on'].
			"</p></td>";
			echo "<td width=\"400\"><p style=\"color:red;\">".$property_set['r_size']." ".$property_set['r_type']." @ ".$property_set['r_sub_locality']." ".$property_set['r_locality']."</p><br/><br/><textarea name=\"s_comments\" readonly>".$property_set['comments']."</textarea><br/><input type=\"text\" name=\"edit_comment\" size=\"62\" Placeholder=\"Enter Client interaction here.\"><br/><p style=\"color:black;\">Suggested Property id:</p>";
			$query_new = "SELECT *";
				$query_new .= " FROM property";
				$query_new .= " WHERE property_type='".$property_set['r_type']. "'";
				
				
				$query_new .= " AND property_locality='".$property_set['r_locality']."'";
					
				
				$query_new .= " AND property_size='".$property_set['r_size']."'";
					
				
				$query_new .= " AND property_sub_locality LIKE  '%". $property_set['r_sub_locality']. "%'";
				$property_new = mysql_query($query_new, $connection);
				$output1 = "";
				while ($property_set_new = mysql_fetch_assoc($property_new)) {
				echo $property_set_new['id'].", "; }
				echo "</td>";
			echo "<input type=\"hidden\" name=\"s_id\" value='".$property_set['id']."'>";
			echo "<td valign=\"top\"><br/><input type=\"submit\" value=\"Update\" name=\"submit\" id=\"button\"></td>";
			
			echo "</tr>";
			echo "</form>";
		}
		echo "</table>";
		}
		else {
		echo "<center><h1>Unauthorized Access!</h1><br/>
		Contact the web administrator for more details : +919860-498043</center>";
		}
		
	?>
	
</div>	