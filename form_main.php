<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	// make sure the subject id sent is an integer

	include_once("includes/form_functions.php");

	// START FORM PROCESSING
	// only execute the form processing if the form has been submitted
	if (isset($_POST['submit'])) {
		
		$now = strtotime(date("Y-m-d H:i:s"));
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
	//	echo $_FILES["file"]["type"];
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 20000000)
		&& in_array($extension, $allowedExts))
		  {
		  if ($_FILES["file"]["error"] > 0)
		    {
		    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		    }
		  else
		    {
			$_FILES["file"]["name"] = $now."-".$_FILES["file"]["name"];
		   // echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		   //echo "Type: " . $_FILES["file"]["type"] . "<br>";
		    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
		    if (file_exists("uploaded_files/" . $_FILES["file"]["name"]))
		      {
		     // echo $_FILES["file"]["name"] . " already exists. ";
			
		      }
		    else
		      {
		      move_uploaded_file($_FILES["file"]["tmp_name"],
		      "uploaded_files/" . $_FILES["file"]["name"]);
		     // echo "Stored in: " . "uploaded_files/" . $_FILES["file"]["name"];
		      }
		    }
		  }
		else
		  {
		  echo "Invalid file";
		  }
		
		
		
		// initialize an array to hold our errors
		$errors = array();
		
		// clean up the form data before putting it in the database
		$user_type = mysql_prep($_POST['user_type']);
		$property_for = mysql_prep($_POST['property_for']);
		$property_type = mysql_prep($_POST['property_type']);
		$furnishing = mysql_prep($_POST['furnishing']);
		$property_size = mysql_prep($_POST['property_size']);
		$price = mysql_prep($_POST['price']);
		$deposit = mysql_prep($_POST['deposit']);
		$deposit_negotiable = mysql_prep($_POST['deposit_negotiable']);
		$brokerage = mysql_prep($_POST['brokerage']);
		$built_area = mysql_prep($_POST['built_area']);
		$built_area_type = mysql_prep($_POST['built_area_type']);
		$price_sqft = mysql_prep($_POST['price_sqft']);
		$property_address = mysql_prep($_POST['property_address']);
		$property_locality = mysql_prep($_POST['property_locality']);
		$property_name = mysql_prep($_POST['property_name']);
		$property_on_floor = mysql_prep($_POST['property_on_floor']);
		$total_floor = mysql_prep($_POST['total_floor']);
		$property_description = mysql_prep($_POST['property_description']);
		$user_name = mysql_prep($_POST['user_name']);
		$user_email = mysql_prep($_POST['user_email']);
		$user_contact = mysql_prep($_POST['user_contact']);
		$property_image = mysql_prep($_POST['$_FILES["file"]["name"];']);
		// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {
			$query = "INSERT INTO property ( user_type, property_for, property_type, property_size,furnishing, price, deposit, deposit_negotiable, brokerage, built_area, built_area_type, price_sqft, property_address, property_locality, property_name, property_on_floor, total_floor, property_description, user_name, user_email, user_contact, property_image) VALUES ('{$user_type}', '{$property_for}', '{$property_type}', '{$property_size}','{$furnishing}', '{$price}', '{$deposit}','{$deposit_negotiable}', '{$brokerage}', '{$built_area}', '{$built_area_type}', '{$price_sqft}','{$property_address}', '{$property_locality}','{$property_name}', '{$property_on_floor}', '{$total_floor}', '{$property_description}', '{$user_name}', '{$user_email}', '{$user_contact}', '{$_FILES['file']['name']}')";
			if ($result = mysql_query($query, $connection)) {
				// as is, $message will still be discarded on the redirect
				$message = "The page was successfully created.";
				// get the last id inserted over the current db connection
				$new_page_id = mysql_insert_id();
				//redirect_to("index.php");
			} else {
				$message = "The page could not be created.";
				$message .= "<br />" . mysql_error();
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		// END FORM PROCESSING
	}
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<div id="navigation"><a href="index.php">View All Properties</a>&nbsp;&nbsp;<a href="form_main.php">Post Property</a>&nbsp;&nbsp;<a href="our_projects.php">Our project's</a>&nbsp;&nbsp;<a href="contactform.php">Contact us</a></div>
<div id="propertyform">
    Basic Property Details : Start Posting Your Property and add Property Features
    <hr size=1>
    <form method="post" enctype="multipart/form-data">
        <table cellpadding="10" border='0'>
            <tr>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am:</td>
                <td><input type="radio" value="Owner" name="user_type" checked="checked">Owner &nbsp;
                    <input type="radio" value="Broker" name="user_type">Broker &nbsp;
                    <input type="radio" value="Builder" name="user_type">Builder &nbsp;
                    <input type="radio" value="Investor" name="user_type">Investor
                </td>
            </tr>
            <tr>
                <td id="tableright">
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I want to:
                    </label>
                </td>
                <td>
                    <input type="radio" value="Sell" name="property_for" checked="checked">Sell &nbsp;
                    <input type="radio" value="Rent/Lease Out" name="property_for">Rent/Lease Out &nbsp;
                    <input type="radio" value="Joint Venture" name="property_for">Joint venture
                </td>
            </tr>
            <tr>
                <td>
                    <label id="tableright">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type of property:</label></td>
                <td><select name="property_type">
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
                    </select><br /></td>
            </tr>
            <tr>
                <td id="tableright"><label>Furnishing:</label></td>
                <td>
                    <input type="radio" value="Fully-Furnished" name="furnishing" checked="checked">Furnished &nbsp;
                    <input type="radio" value="Semifurnished" name="furnishing">Semifurnished &nbsp;
                    <input type="radio" value="Unfurnished" name="furnishing">Unfurnished &nbsp;
                    <input type="radio" value="Not applicable" name="furnishing">Not Applicable
                </td>
            </tr>
            <tr>
                <td id="tableright"><label>Apartment Size:</label></td>
                <td>
                    <select name="property_size">
                        <option sleceted="selected" value="null">Select Apartment size</option>
                        <option value="1 RK">1 RK</option>
                        <option value="1 BHK">1 BHK</option>
                        <option value="1.5 BHK">1.5 BHK</option>
                        <option value="2 BHK">2 BHK</option>
                        <option value="2.5 BHK">2.5 BHK</option>
                        <option value="3 BHK">3 BHK</option>
                        <option value="4 BHK">4 BHK</option>
                        <option value="Shop">Shop</option>
                        <option value="null">Not Applicable</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="tableright"><label>Expected Rate/Rent:</lables>
                </td>
                <td>
                    <input type="number" name="price" placeholder="Enter price">
                </td>
            </tr>
            <tr>
                <td id="tableright"><label>Deposit:</lables>
                </td>
                <td>
                    <input type="number" name="deposit" placeholder="Deposit">&nbsp;&nbsp;
                    <input type="radio" value="Yes" name="deposit_negotiable" checked="checked"> Negotiable
                    <input type="radio" value="No" name="deposit_negotiable"> Non-negotiable
                </td>
            </tr>
            <tr>
                <td id="tableright"><label>Brokerage:</lable>
                </td>
                <td>
                    <input type="number" name="brokerage" placeholder="brokerage">%&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td id="tableright">Built-Area:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <input type="number" name="built_area">
                    <select name="built_area_type">
                        <option sleceted="selected">Sq.ft</option>
                        <option>Sq.Yards</option>
                        <option>Sq.Meter</option>
                        <option>Sq.Acres</option>
                        <!--<option>Marla</option>
						<option>Cents</option>
						<option>Bigha</option>
						<option>Kottah</option>
						<option>Kanal</option>
						<option>Grounds</option>
						<option>Ares</option>
						<option>Biswa</option>
						<option>Guntha</option>
						<option>Aankadam</option>
						<option>Hectares</option>
						<option>Rood</option>
						<option>Chataks</option>
						<option>Perch</option>-->
                    </select>
                </td>
            </tr>
            <tr>
                <td id="tableright">Price :&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <input type="number" name="price_sqft">
                    per <select name="built_area_type">
                        <option>Sq.ft</option>
                        <option>Sq.Yards</option>
                        <option>Sq.Meter</option>
                        <option>Sq.Acres</option>
                        <!--<option>Marla</option>
								<option>Cents</option>
								<option>Bigha</option>
								<option>Kottah</option>
								<option>Kanal</option>
								<option>Grounds</option>
								<option>Ares</option>
								<option>Biswa</option>
								<option>Guntha</option>
								<option>Aankadam</option>
								<option>Hectares</option>
								<option>Rood</option>
								<option>Chataks</option>
								<option>Perch</option>-->
                    </select>
                </td>
            </tr>
            <tr>
                <td id="tableright">Property Head:&nbsp;&nbsp;&nbsp;</td>
                <td><input type="text" size="62" name="property_name"></td>
            </tr>
            <tr>
                <td id="tableright">Property Address:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><textarea name="property_address" rows="4" cols="60"></textarea></td>
            </tr>
            <tr>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; Property City:
                </td>
                <td>
                    <select name="property_locality">
                        <option value="null" sleceted="selected">Select City</option>
                        <option value="Navi-Mumbai">Navi-Mumbai</option>
                        <option value="Central Mumbai subrubs">Central Mumbai subrubs</option>
                        <option vlaue="Mumbai Andheri-Dahisar">Mumbai Andheri-Dahisar</option>
                        <option vlaue="Mumbai Beyond Thane">Mumbai Beyond Thane</option>
                        <option vlaue="Mumbai Harbour">Mumbai Harbour</option>
                        <option vlaue="Mumbai South">Mumbai South</option>
                        <option vlaue="Mumbai South West">Mumbai South West</option>
                        <option vlaue="Mumbai Thane">Mumbai Thane</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label id="tableright">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Property on Floor:</label></td>
                <td>
                    <select name="property_on_floor">
                        <option value="null" sleceted="selected">Select</option>
                        <option value="Basement" value="Basement">Basement</option>
                        <option value="Lower ground" Value="Lower Ground">Lower Ground</option>
                        <option value="Ground">Ground</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="40+">40+</option>
                        <option value="not applicable">Not Applicable</option>
                    </select><label id="tableright"> &nbsp;&nbsp;&nbsp;
                        Total floors in building: </label>
                    <select name="total_floor">
                        <option value="null" sleceted="selected">Select</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                        <option value="36">36</option>
                        <option value="37">37</option>
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="40+">40+</option>
                        <option value="not applicable">Not Applicable</option>
                </td>
                </select> <br /><br />

            <tr>
                <td id="tableright">Property Description:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><textarea placeholder="Write an interesting and detailed property description." name="property_description" rows="4" cols="60"></textarea></td>
            </tr>
        </table>
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>">
        </p>
        <p>
            <label for="file">Upload Property Picture:</label>
            &nbsp;&nbsp; <input id="file" type="file" name="file">
        </p>
        <hr size="1">
        Your Contact Details : This is where people interested in your property will contact you<br />
        <br />
        <table cellpadding="10">
            <tr>
                <td id="tableright"><sup>*</sup>Name:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><input type="text" name="user_name"></td>
            </tr>
            <tr>
                <td id="tableright"><label><sup>*</sup>Email:</label></td>
                <td><input type="Email" name="user_email"></td>
            </tr>
            <tr>
                <td id="tableright"><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>*</sup>Phone Number: </label></td>
                <td><input type="text" name="user_contact"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Submit Property" id="submit"></td>
            </tr>
        </table>
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
					echo "Contact: ". $advertisements_set['contact_name'] ." - " . $advertisements_set['contact_number'] ."<br /><br/>";
					echo "</div>";
					echo "<br>";
				}
			?>
    </center>
</div>
