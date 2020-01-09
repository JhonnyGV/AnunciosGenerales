<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
    <?php include("includes/footer.php"); ?><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">

<!-- Link to the built CSS -->
<link rel="stylesheet" href="stylesheets/modal.css">
</head>
  
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
  <table id="structure">
    <td id="page"><?php
						$query = "SELECT * FROM project";
						$property = mysql_query($query, $connection);
						confirm_query($property);
						$output = "";
						while ($property_set = mysql_fetch_assoc($property)) {
							
	
							echo "<div id=\"submitted_property\">";
							//echo "<form action=\"contact_owner.php\" method=\"post\">";
							//	echo "<ul>";
								echo "<div id=\"header_submitted_property\">";
								echo "<center>";
								echo "<b>". $property_set['project_name'] ."&nbsp;  &nbsp; &nbsp; &nbsp; "."by ".$property_set['project_owner']."&nbsp;  &nbsp; &nbsp; &nbsp; "."Situated at ".$property_set['project_location']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."</b>"."<br />";
								echo "</center>";
								echo "</div>";
								echo "<div id=\"right\">";
									echo "Project id: " . $property_set['id'] ." " ."<br />";
								echo"</div>";
								if(!empty($property_set['project_locality']))
								{
								echo "<li>";
								echo "Project Locality: "."$property_set[project_locality]."."<br />";
								}
								if(!empty($property_set['project_address']))
								{
								echo "<li>";
								echo "Address: "."$property_set[project_address]."."<br />";
								}
								if(!empty($property_set['min_price']) && !empty($property_set['max_price']))
								{
								echo "<li>";
							 	echo "Price Range: "."&#8377; "."$property_set[min_price]"." - "."&#8377; "."$property_set[max_price]."."<br />";
								}
								if(!empty($property_set['project_logo']))
								{
						
									echo "<img src='uploaded_project/".$property_set['project_logo']. "'". "height=\"100px\"" . "width=\"100px\">";
								}
								if(!empty($property_set['min_area']) && !empty($property_set['max_area']))
								{
								echo "<li>";
							 	echo "Area Range: "."$property_set[min_area]"." - "."$property_set[max_area]."."<br />";
								}
								if(!empty($property_set['min_plan']) && !empty($property_set['max_plan']))
								{
								echo "<li>";
							 	echo "Plan's Available: "."$property_set[min_plan]"." - "."$property_set[max_plan]."."<br />";
								}
								if(!empty($property_set['possession_month']) && !empty($property_set['possession_year']))
								{
								echo "<li>";
							 	echo "Possession in: "."$property_set[possession_month]"."  "."$property_set[possession_year]."."<br />";
								}
								if(!empty($property_set['amenities']))
								{
									echo "<li>";
									echo "Amenities: "."$property_set[amenities]";
								}
								if(!empty($property_set['project_description']))
								{
									echo "<li>";
									echo "Project Description: "."$property_set[project_description]";
								}
								echo "<br>";
								 
							
							echo "<input type=\"hidden\" name=\"property_name\" value=".$property_set['project_name'].">";
							echo "<input type=\"hidden\" name=\"property_address\" value=".$property_set['project_address'].">";
							
							echo "</form>";
										echo "</ul>";
										echo "</div>";
							//echo "<hr size=\"1\">";
										// return $output;
										echo "<br><br><br><br>";
						}
						return $output;
						?>
      </div>
      </div>
  