<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<div id="navigation"> <a href="index.php">View All Properties &nbsp;</a> <a href="form_main.php">Post Property &nbsp;</a> <a href="our_projects.php">Our project's &nbsp;</a> <a href="builders_calculator.php">Builders Calculator &nbsp;</a> <a href="downloads.php">Downloads &nbsp;</a> <a href="enquiryform.php">Enquiry Form &nbsp;</a> <a href="contactform.php">Contact us &nbsp;</a> </div>
<div id="search">
  <form method="post" action="search_project.php" name="search_project">
    <select name="project_location" id="menulist">
      <option>Navi-Mumbai</option>
      <option>Central Mumbai subrubs</option>
      <option>Mumbai Andheri-Dahisar</option>
      <option>Mumbai Beyond Thane</option>
      <option>Mumbai Harbour</option>
      <option>Mumbai South</option>
      <option>Mumbai South West</option>
      <option>Mumbai Thane</option>
    </select>
    &nbsp;&nbsp;
    <input type="text" name="project_locality" placeholder="Property Locality" id="menulist">
    &nbsp;&nbsp;
    <input type="text" name="search_property_name" placeholder="Enter Property Name" id="menulist">
    <input type="submit" value="Search" name="Search" id="search_button">
  </form>
</div>
<div id="search_by_id"> <a href="search_by_id_result.php" id="button">Search by Id</a> </div>

<!--	</div>-->
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
				echo "<img src='uploaded_ads/'".$advertisements_set['ad_image']. "'". "height=\"160px\"" . "width=\"300px\">". "<br/>";
				echo "<div id=\"index_ads_contact\">";
				echo "Contact: " . $advertisements_set['contact_name'] ." - " . $advertisements_set['contact_number'] ."<br /><br/>";
				echo "</div>";
				echo "<br>";
			}
		?>
  </center>
</div>
<table id="structure">

  <td id="page"><?php	
				
				$query = "SELECT * FROM project WHERE project_locality='".$_POST['project_location']."'";
				if(!empty($_POST['project_locality'])){ 
				$query .= " AND project_location LIKE  '%". $_POST['project_locality']. "%'";}
				if(!empty($_POST['search_property_name'])){ 
				$query .= " AND project_name LIKE  '%". $_POST['search_property_name']. "%'";}
				$property = mysql_query($query, $connection);
				$output = "";
				while ($property_set = mysql_fetch_assoc($property)) {
					
						echo "<div id=\"submitted_project\">";
					echo"<table>";
						echo "<form action=\"contact_project_owner.php\" method=\"post\">";
						echo "<div id=\"header_submitted_project\">";
							echo "<b>". $property_set['project_name'] ."&nbsp;  &nbsp; &nbsp; &nbsp; "."&nbsp;  &nbsp; &nbsp; &nbsp; "."Situated at ".$property_set['project_location']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."</b>";
						echo "</div>";
						echo "<div id=\"right\">";
							echo "Project id: " . $property_set['id']."&nbsp;";
						echo"</div>";
					if(!empty($property_set['project_logo']))
						{
							echo "<br/>";
							echo "<img src='uploaded_project/".$property_set['project_logo']. "'". "height=\"200px\"" . "width=\"200px\">";
						}
						if(!empty($property_set['project_locality']))
						{
							echo "<tr><td width=\"160\">Project in: </td><td>"."$property_set[project_location], $property_set[project_locality]."."</td></tr>";
						}
						if(!empty($property_set['project_address']))
						{
						
						echo "<tr><td>Address: </td><td>"."$property_set[project_address]."."</td></tr>";
						}
						if(!empty($property_set['min_price']) && !empty($property_set['max_price']))
						{
							echo "<tr><td>Price Range: </td><td>"."&#8377; "."$property_set[min_price]"." - "."&#8377; "."$property_set[max_price]."."</td></tr>";
						}
						
						if(!empty($property_set['min_area']) && !empty($property_set['max_area']))
						{
						
					 	echo "<tr><td>Area Range: </td><td>"."$property_set[min_area]"." - "."$property_set[max_area]."."</td></tr>";
						}
						if(!empty($property_set['min_plan']) && !empty($property_set['max_plan']))
						{
						
					 	echo "<tr><td>Plan's Available: </td><td>"."$property_set[min_plan]"." - "."$property_set[max_plan]."."</td></tr>";
						}
						if(!empty($property_set['possession_month']) && !empty($property_set['possession_year']))
						{
						
					 	echo "<tr><td>Possession in: </td><td>"."$property_set[possession_month]"."  "."$property_set[possession_year]."."</td></tr>";
						}
						if(!empty($property_set['amenities']))
						{
							
							echo "<tr><td>Amenities: </td><td>"."$property_set[amenities]"."</td></tr>";
						}
						if(!empty($property_set['project_description']))
						{
							
							echo "<tr><td>Project Description: </td><td>"."$property_set[project_description]"."</td></tr>";
						}
				
					
					echo "<input type=\"hidden\" name=\"property_email\" value=\"feedback@samarpanmarketing.com\">";
					echo "<input type=\"hidden\" name=\"property_name\" value=".$property_set['project_name'].">";
					echo "<input type=\"hidden\" name=\"property_address\" value=".$property_set['project_address'].">";
					echo "<input type=\"hidden\" name=\"property_id_send\" value=".$property_set['id'].">";
					echo "<tr><td colspan=\"2\"><a href=\"project_plan.php?id={$property_set['id']}\" id=\"submit\">View Plan</a> <input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Contact\"></td></tr>";
					
					
				
					echo "</form>";
				echo "</table>";
			echo "</div>";
				}
				return $output;
				?>
</div>
  </div>
  <?php include("includes/footer.php"); ?>
<!--	-->