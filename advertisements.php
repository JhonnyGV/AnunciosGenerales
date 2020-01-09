<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
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
		    if (file_exists("uploaded_ads/" . $_FILES["file"]["name"]))
		      {
		     // echo $_FILES["file"]["name"] . " already exists. ";
			
		      }
		    else
		      {
		      move_uploaded_file($_FILES["file"]["tmp_name"],
		      "uploaded_ads/" . $_FILES["file"]["name"]);
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
		$ad_image = mysql_prep($_FILES["file"]["name"]);
		$contact_name = mysql_prep($_POST['contact_name']);
		$contact_number = mysql_prep($_POST['contact_number']);
		
			if (empty($errors)) {
				$query = "INSERT INTO advertisements (ad_image, contact_name, contact_number) VALUES ('{$_FILES['file']['name']}', '{$contact_name}', '{$contact_number}')";
			
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
	<div id="navigation">
		<a href="index.php">Return to Public Site</a>
		<a href="staff.php">Return to Staff Menu</a>
	</div><br/><br/>
	<div id="add_ad">
		<center><h3>Upload A Advertisement</h3></center>
		<hr size=1>
		<table>
			<tr>
			<form method="post" enctype="multipart/form-data"> 
	        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>"> 
			<tr>
				<td>
	            <label>Upload Advertisement:</label> </td>
				<td>
	            <input id="file" type="file" name="file"> 
	        </td>
			<tr>
				<td>
					<label>Contact Name: </label>
				</td>
				<td>
					<input type="text" name="contact_name"><br/>
				</td>
			</tr>
			<tr>
				<td>
					<label>Contact Number: </label>
				</td>
				<td>
					<input type="text" name="contact_number"><br/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Upload Ad" id="submit">
					</td>
				</tr>
		</form>
	</div>