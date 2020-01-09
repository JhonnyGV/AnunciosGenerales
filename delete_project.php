<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
  <div id="navigation"> <a href="index.php">Return to Public Site</a> <a href="staff.php">Return to Staff Menu</a> </div>
  <div id="staff_work">
    <h3>Project id:</h3>
    <form method="post" action="delete_project.php" name="search_by_id_result" id="search_by_id">
      <input type="text" name="id" placeholder="Unique Property Id" size="15">
      <input type="submit" value="Delete Project" name="delete" id="submit" onclick="return confirm('Are you sure you want to delete this project');">
    </form>
  </div>
  <?php
					$query = "DELETE FROM project WHERE id = {$_POST['id']} LIMIT 1";
					$result = mysql_query ($query);
					if (mysql_affected_rows() == 1) {
						// Successfully deleted
						redirect_to("staff.php");
					}
				?>
  <?php include("includes/footer.php"); ?>