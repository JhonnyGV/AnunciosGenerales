<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<div id="navigation"> <a href="index.php">Return to Public Site</a> <a href="staff.php">Return to Staff Menu</a> </div>
<br/>
<br/>
<div id="add_ad">
  <center>
    <h3>Upload A Document</h3>
  </center>
  <hr size=1>
  <form enctype="multipart/form-data" method="POST" action="upload.php">
    <table>
      <tbody>
        <tr>
          <td align="left">File:</td>
          <td><input accept="doc/docx" name="filename" size="40" type="file" /></td>
        </tr>
        <tr>
          <td><label>File Title: </label>
          <td><input type="text" name="file_title" placeholder="Title that will appear for download link" size="40"></td>
        </tr>
        <tr>
          <td><label>Subject: </label>
          <td><input type="text" name="file_name" placeholder="Subject of the description" Size="40"></td>
        </tr>
        <tr>
          <td><label>File Description: </label>
          <td><textarea cols='41' name="file_desc" placeholder="Description of the document"></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td><input name="Upload" type="submit" value="Upload" id="Submit"/></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
