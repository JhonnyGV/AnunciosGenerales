<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
  <table id="structure">
    <tr>
      <td id="navigation"><?php echo public_navigation($sel_subject, $sel_page); ?></td>
      <td id="page"><?php if ($sel_page) { ?>
        <h2><?php echo $sel_page['menu_name']; ?></h2>
        <div class="page-content"> <?php echo $sel_page['content']; ?> </div>
        <?php } else { ?>
        <?php echo $sel_subject['id']; ?><br/>
        <h2><?php echo $sel_subject['menu_name']; ?></h2>
        <div class="page-content"> 
          <!-- 	<?php echo $sel_subject['content']; ?> --> 
        </div>
        <?php } ?></td>
    </tr>
  </table>
  <?php include("includes/footer.php"); ?>