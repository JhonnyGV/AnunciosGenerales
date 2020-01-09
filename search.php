<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	// make sure the subject id sent is an integer

	include_once("includes/form_functions.php");

	// START FORM PROCESSING
	// only execute the form processing if the form has been submitted
	if (isset($_POST['submit'])) {
		// initialize an array to hold our errors
		$errors = array();
		
		// clean up the form data before putting it in the database
		$user_type = mysql_prep($_POST['user_type']);
		$property_for = mysql_prep($_POST['property_for']);
		$property_type = mysql_prep($_POST['property_type']);
		$furnishing = mysql_prep($_POST['furnishing']);
		$price = mysql_prep($_POST['price']);
		$deposit = mysql_prep($_POST['deposit']);
		$deposit_negotiable = mysql_prep($_POST['deposit_negotiable']);
		$brokerage = mysql_prep($_POST['brokerage']);
		$built_area = mysql_prep($_POST['built_area']);
		$price_sqft = mysql_prep($_POST['price_sqft']);
		$property_address = mysql_prep($_POST['property_address']);
		$property_name = mysql_prep($_POST['property_name']);
		$property_on_floor = mysql_prep($_POST['property_on_floor']);
		$total_floor = mysql_prep($_POST['total_floor']);
		$property_description = mysql_prep($_POST['property_description']);
		$user_name = mysql_prep($_POST['user_name']);
		$user_email = mysql_prep($_POST['user_email']);
		$user_contact = mysql_prep($_POST['user_contact']);
		
		// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {
			$query = "SELECT * From Property";
					//	var_dump($_POST);
					//	echo $property_for;
						echo $query;
			if ($result = mysql_query($query, $connection)) {
				// as is, $message will still be discarded on the redirect
				$message = "The page was successfully created.";
				// get the last id inserted over the current db connection
				$new_page_id = mysql_insert_id();
				redirect_to("index.php");
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
<div id="navigation"> <a href="index.php">View All Properties</a> <a href="form_main.php">Sell/Rent Property</a> <a href="contact_us.php">Contact us</a> </div>
