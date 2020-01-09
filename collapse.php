<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
    <?php include("includes/footer.php"); ?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="stylesheets/style.css">
</head>
  <div id="navigation"><a href="index.php">View All Properties</a>&nbsp;&nbsp;<a href="form_main.php">Post Property</a>&nbsp;&nbsp;<a href="our_projects.php">Our project's</a>&nbsp;&nbsp;<a href="contactform.php">Contact us</a></div>
  <div id="search">
  <form method="post" action="search_result.php" name="search_result">
      <label>Looking to:</label>
      <input type="radio" value="Sell" name="property_for" checked="checked">
      Buy &nbsp;
      <input type="radio" value="Rent/Lease Out" name="property_for">
      Rent &nbsp;&nbsp;
      <!--	<label>Looking For: </label> -->
      <select name="property_type">
      <option value="Not described">Select property type</option>
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
    </select>
      &nbsp;&nbsp;
      <select name="property_locality">
      <option value="null">Select City</option>
      <option value="Navi-Mumbai">Navi-Mumbai</option>
      <option>Central Mumbai subrubs</option>
      <option>Mumbai Andheri-Dahisar</option>
      <option>Mumbai Beyond Thane</option>
      <option>Mumbai Harbour</option>
      <option>Mumbai South</option>
      <option>Mumbai South West</option>
      <option>Mumbai Thane</option>
    </select>
      &nbsp;&nbsp;
      <select name="property_size">
      <option>Select Apartment size</option>
      <option value="1 RK">1 RK</option>
      <option value="1 BHK">1 BHK</option>
      <option value="1.5 BHK">1.5 BHK</option>
      <option value="2 BHK">2 BHK</option>
      <option value="2.5 BHK">2.5 BHK</option>
      <option value="3 BHK">3 BHK</option>
      <option value="4 BHK">4 BHK</option>
    </select>
      &nbsp;&nbsp;
      </td>
      <td>&nbsp;&nbsp;&nbsp;
      <input type="submit" value="Search" name="Search" id="submit">
  </form>
  <form method="post" action="search_by_id_result.php" name="search_by_id_result" id="search_by_id">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="id" placeholder="Unique Property Id" size="15">
      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" value="Search by id" name="search" id="submit">
    </form>
</div>
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
<div id="expand"><a href="index.php">Expand all ads</a></div>
  <td id="page"><h4 div="left">For detailed information about  property just type the Property ID and "Search by ID"!</h4>
    <?php
						$query = "SELECT * FROM property";
						$property = mysql_query($query, $connection);
						confirm_query($property);
					
						$output = "";
						while ($property_set = mysql_fetch_array($property)) {
							echo "<div id=\"submitted_property_collapse\">";
							echo "<div id=\"header_submitted_property\">";
							echo "<b>";
							if($property_set['property_size'] != "null"){
								echo$property_set['property_size'] ."&nbsp";} 
							if($property_set['property_type'] != "null"){
								echo$property_set['property_type'] ."&nbsp";}
							echo " For ".$property_set['property_for']." &nbsp;   &nbsp; ".$property_set['property_name']."</b>"."<div id=\"right\">"."Price: &#8377; ".$property_set['price']."/- "."Property ID: ".$property_set['id']."</div>"."<br />";
							echo "</div>";
							echo "</div>";
						}
						return $output;
						?>
    </div>
    </div>
