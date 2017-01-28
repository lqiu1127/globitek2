<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$users_result = find_user_by_id($_GET['id']);
// No loop, only one result
$user = db_fetch_assoc($users_result);

if(is_post_request()) {

  // Confirm that values are present before accessing them.
  switch($_REQUEST['confirmation']) {

    case 'yes': //action for yes (delete)
        $result = delete_user($user);
        redirect_to('index.php');
        break;
    case 'no': //action for no (redirect back to show page without deleting)
        redirect_to('show.php?id=' . $user['id']);
        break;
}
    
}
?>
<?php $page_title = 'Staff: Edit User ' . $user['first_name'] . " " . $user['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Users List</a><br />

  <h1>Delete User: <?php echo $user['first_name'] . " " . $user['last_name']; ?></h1>

  <form action="delete.php?id=<?php echo $user['id']; ?>" method="post">
    Are you sure you want to delete?
    <br />
    <button name="confirmation" type="submit" value="yes">Yes</button>
    <button name="confirmation" type="submit" value="no">No</button>
   </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
