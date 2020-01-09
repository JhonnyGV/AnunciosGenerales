<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<!-- <?php require_once("includes/include_phpuploader.php") ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> -->
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
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>

<div id="navigation"> <a href="index.php">Return to Public Site</a> <a href="staff.php">Return to Staff Menu</a> </div>
<br/>
<br/>
<div id="propertyform">
<form method="post" enctype="multipart/form-data">
<h3>Post all your project details:</h3>
<hr size="5">
<u>
<h4>Project Overview:</h4>
</u>
<table cellpadding="5">
  <tr>
    <td><label>Project Name:</label></td>
    <td><input type="text" name="project_name"></td>
  </tr>
  <tr>
    <td><label>Owner Name:</label></td>
    <td><input type="text" name="project_owner"></td>
  </tr>
  <tr>
    <td><label>Address: </label></td>
    <td><textarea name="project_address"></textarea></td>
  </tr>
  <tr>
    <td><label>Project Location:</label></td>
    <td><input type="text" name="project_location"></td>
  </tr>
  <tr>
    <td><label>Project City:</label></td>
    <td><select name="project_locality">
        <option>Navi-Mumbai</option>
        <option>Central Mumbai subrubs</option>
        <option>Mumbai Andheri-Dahisar</option>
        <option>Mumbai Beyond Thane</option>
        <option>Mumbai Harbour</option>
        <option>Mumbai South</option>
        <option>Mumbai South West</option>
        <option>Mumbai Thane</option>
      </select></td>
  </tr>
  <tr>
    <td><label>Project price range:</label></td>
    <td><select name="min_price" place holder="Min Price">
        <option>Min Price</option>
        <option>Below 5 Lacs</option>
        <option>5 Lacs</option>
        <option>10 Lacs</option>
        <option>15 Lacs</option>
        <option>20 Lacs</option>
        <option>25 Lacs</option>
        <option>30 Lacs</option>
        <option>40 Lacs</option>
        <option>50 Lacs</option>
        <option>60 Lacs</option>
        <option>75 Lacs</option>
        <option>90 Lacs</option>
        <option>1 crore</option>
        <option>1.5 crores</option>
        <option>2 crores</option>
        <option>3 crores</option>
        <option>5 crores</option>
        <option>10 crores</option>
        <option>20 crores</option>
        <option>30 crores</option>
        <option>40 crores</option>
        <option>50 crores</option>
        <option>60 crores</option>
        <option>70 crores</option>
        <option>80 crores</option>
        <option>90 crores</option>
        <option>100 crores</option>
        <option>100+ crores</option>
        <option>On Request</option>
      </select>
      &nbsp;to&nbsp;
      <select name="max_price">
        <option>Max Price</option>
        <option>Below 5 Lacs</option>
        <option>5 Lacs</option>
        <option>10 Lacs</option>
        <option>15 Lacs</option>
        <option>20 Lacs</option>
        <option>25 Lacs</option>
        <option>30 Lacs</option>
        <option>40 Lacs</option>
        <option>50 Lacs</option>
        <option>60 Lacs</option>
        <option>75 Lacs</option>
        <option>90 Lacs</option>
        <option>1 crore</option>
        <option>1.5 crores</option>
        <option>2 crores</option>
        <option>3 crores</option>
        <option>5 crores</option>
        <option>10 crores</option>
        <option>20 crores</option>
        <option>30 crores</option>
        <option>40 crores</option>
        <option>50 crores</option>
        <option>60 crores</option>
        <option>70 crores</option>
        <option>80 crores</option>
        <option>90 crores</option>
        <option>100 crores</option>
        <option>100+ crores</option>
        <option>On Request</option>
      </select></td>
  </tr>
  <tr>
    <td><label>Area Range: </label></td>
    <td><input type="number" name="min_area" placeholder="Min. Area">
      &nbsp;-&nbsp;
      <input type="number" name="max_area" placeholder="Max. area">
      Sq. ft.</td>
  </tr>
  <tr>
    <td><label>Plans: </label></td>
    <td><select name="min_plan">
        <option>1 BHK</option>
        <option>2 BHK</option>
        <option>3 BHK</option>
        <option>4 BHK</option>
        <option>5 BHK</option>
        <option>6 BHK</option>
        <option>7 BHK</option>
        <option>8 BHK</option>
        <option>9 BHK</option>
        <option>10 BHK</option>
      </select>
      &nbsp;to&nbsp;
      <select name="max_plan">
        <option>1 BHK</option>
        <option>2 BHK</option>
        <option>3 BHK</option>
        <option>4 BHK</option>
        <option>5 BHK</option>
        <option>6 BHK</option>
        <option>7 BHK</option>
        <option>8 BHK</option>
        <option>9 BHK</option>
        <option>10 BHK</option>
        <option>10+ BHK</option>
      </select></td>
  </tr>
  <tr>
    <td><label>Possession:</label></td>
    <td><select name="possession_month">
        <option>Jan</option>
        <option>Feb</option>
        <option>Mar</option>
        <option>Apr</option>
        <option>May</option>
        <option>Jun</option>
        <option>Jul</option>
        <option>Aug</option>
        <option>Sep</option>
        <option>Oct</option>
        <option>Nov</option>
      </select>
      <select name="possession_year">
        <option>2013</option>
        <option>2014</option>
        <option>2015</option>
        <option>2016</option>
        <option>2017</option>
        <option>2018</option>
        <option>2019</option>
        <option>2020</option>
        <option>2021</option>
        <option>2022</option>
        <option>2023</option>
        <option>2024</option>
        <option>2025</option>
        <option>2026</option>
        <option>2027</option>
        <option>2028</option>
        <option>2029</option>
        <option>2030</option>
        <option>2031</option>
        <option>2032</option>
        <option>2033</option>
        <option>2034</option>
        <option>2035</option>
        <option>2036</option>
        <option>2037</option>
        <option>2038</option>
        <option>2039</option>
        <option>2040</option>
      </select></td>
  </tr>
  <tr>
    <td><label>Amenities :</label></td>
    <td><textarea name="amenities"></textarea></td>
  </tr>
  <tr>
    <td><label>Project description :</label></td>
    <td><textarea name="project_description"></textarea></td>
  </tr>
</table>
<hr size="5">
<!--	<u><h4>Amenities:</h4></u>
<table cellpadding="5">
		<tr>
			<td><input type="checkbox" name="amenities">Clubhouse</td>
			<td><input type="checkbox" name="amenities" value="Sports Facility">Sports Facility</td>
			<td><input type="checkbox" name="amenities" value="Swimming Pool">Swimming Pool</td></tr><tr>
			<td><input type="checkbox" name="amenities" value="Gym">Gym</td>
			<td><input type="checkbox" name="amenities" value="Landscape Garden/Park">Landscape Garden/Park</td>
			<td><input type="checkbox" name="amenities" value="Security">Security</td></tr><tr>
			<td><input type="checkbox" name="amenities" value="Power Backup">Power Backup</td>
			<td><input type="checkbox" name="amenities" value="Rain Water Harvesting">Rain Water Harvesting</td>
			<td><input type="checkbox" name="amenities" value="Sewage treatment plant">Sewage Treatment Plant</td>
		</tr>
	</table>-->
<p>
  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>">
</p>
<p>
  <label for="file">Upload Property Picture:</label>
  <input id="file" type="file" name="file">
</p>
<!--	<p>
		<?php
			$uploader=new PhpUploader();

			$uploader->MultipleFilesUpload=true;
			$uploader->InsertText="Select multiple files (Max 10M)";

			$uploader->MaxSizeKB=10240;
			$uploader->AllowedFileExtensions="*.jpg,*.png,*.gif,*.bmp";

			$uploader->UploadUrl="demo2_upload.php";

			$uploader->Render();
		?>

		<script type='text/javascript'>
		function CuteWebUI_AjaxUploader_OnTaskComplete(task)
		{
			var div=document.createElement("DIV");
			var link=document.createElement("A");
			link.setAttribute("href","savefiles/myprefix_"+task.FileName);
			link.innerHTML="You have uploaded file";
			link.target="_blank";
			div.appendChild(link);
			document.body.appendChild(div);
		}
		</script>
		</p>-->
<hr size="5">
<center>
  <input type="submit" name="submit" value="Submit Property" id="submit">
</center>
</div>
<!--<div id="ads">
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
</div>-->