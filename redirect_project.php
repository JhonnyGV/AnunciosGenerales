<? ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("includes/include_phpuploader.php") ?>
<?php
	// make sure the subject id sent is an integer

	include("includes/form_functions.php");

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
		    if (file_exists("uploaded_project/" . $_FILES["file"]["name"]))
		      {
		     // echo $_FILES["file"]["name"] . " already exists. ";
			
		      }
		    else
		      {
		      move_uploaded_file($_FILES["file"]["tmp_name"],
		      "uploaded_project/" . $_FILES["file"]["name"]);
		     // echo "Stored in: " . "uploaded_project/" . $_FILES["file"]["name"];
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
		$project_name = mysql_prep($_POST['project_name']);
		$project_owner = mysql_prep($_POST['project_owner']);
		$project_location = mysql_prep($_POST['project_location']);
		$project_address = mysql_prep($_POST['project_address']);
		$project_locality = mysql_prep($_POST['project_locality']);
		$min_price = mysql_prep($_POST['min_price']);
		$max_price = mysql_prep($_POST['max_price']);
		$min_area = mysql_prep($_POST['min_area']);
		$max_area = mysql_prep($_POST['max_area']);
		$min_plan = mysql_prep($_POST['min_plan']);
		$max_plan = mysql_prep($_POST['max_plan']);
		$possession_month = mysql_prep($_POST['possession_month']);
		$possession_year = mysql_prep($_POST['possession_year']);
		$project_description = mysql_prep($_POST['project_description']);
		$amenities = mysql_prep($_POST['amenities']);
		$project_logo = mysql_prep($_POST['$_FILES["file"]["name"];']); 
		// Database submission only proceeds if there were NO errors.
		if (empty($errors)) {
			$query = "INSERT INTO project ( project_name, project_owner, project_location, project_locality, project_address, min_price, max_price, min_area, max_area, min_plan, max_plan, possession_month, possession_year, project_description, amenities, project_logo) VALUES ('{$project_name}',  '{$project_owner}','{$project_location}','{$project_locality}', '{$project_address}','{$min_price}', '{$max_price}', '{$min_area}', '{$max_area}','{$min_plan}', '{$max_plan}', '{$possession_month}', '{$possession_year}', '{$project_description}','{$amenities}', '{$_FILES['file']['name']}')";
			if ($result = mysql_query($query, $connection)) {
				// as is, $message will still be discarded on the redirect
				$message = "The page was successfully created.";
				// get the last id inserted over the current db connection
				$new_page_id = mysql_insert_id();
				
				header("location: project_main_step1.php?id=$new_page_id");
			
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
