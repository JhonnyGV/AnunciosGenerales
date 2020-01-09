<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

//if we clicked on Upload button
$now = strtotime(date("Y-m-d H:i:s"));

if($_POST['Upload'] == 'Upload')

  {

  //make the allowed extensions

  $goodExtensions = array(

  '.doc',

  '.docx',
	
 '.pdf'	,

  ); 

  $error='';

  //set the current directory where you wanna upload the doc/docx files

  $uploaddir = 'uploaded_doc/';

  $name = $now."-".$_FILES['filename']['name'];//get the name of the file that will be uploaded

  $min_filesize=10;//set up a minimum file size(a doc/docx can't be lower then 10 bytes)

  $stem=substr($name,0,strpos($name,'.'));

  //take the file extension

  $extension = substr($name, strpos($name,'.'), strlen($name)-1);

  //verify if the file extension is doc or docx

   if(!in_array($extension,$goodExtensions))

     $error.='Extension not allowed<br>';

echo "<span> </span>"; //verify if the file size of the file being uploaded is greater then 1

   if(filesize($_FILES['filename']['tmp_name']) < $min_filesize)

     $error.='File size too small<br>'."\n";

  $uploadfile = $uploaddir . $stem.$extension;

$filename=$stem.$extension;

if ($error=='')

{

//upload the file to
if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile)) {

echo 'File Uploaded. Thank You.<br/>';
echo "<a href=\'staff.php\' id=\'submit\'>Staff Section</a>";

}

}

else echo $error;

}
$errors = array();
$_FILES['filename']['name'] = $now."-".$_FILES['filename']['name'];
$File = mysql_prep($_FILES['filename']['name']);
$File_title = mysql_prep($_POST['file_title']);
$File_name = mysql_prep($_POST['file_name']);
$File_desc = mysql_prep($_POST['file_desc']);

	if (empty($errors)) {
		$query = "INSERT INTO file_upload (File,File_title,File_name,File_desc) VALUES ('{$_FILES['filename']['name']}','$File_title','$File_name','$File_desc')";
	
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


?>
