<?php

include('config/constants.php');

//Check task_id in URL
if (isset($_GET['task_id'])) {
  //Delete the Task from Database
  //Get the Task ID
  $task_id = $_GET['task_id'];

  //Connect Database
  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

  //Select Database
  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

  //SQL Query to Delete Task 
  $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id";

  //Execute Query
  $res = mysqli_query($conn, $sql);

  //Check if the Query Executed Successfully or not
  if ($res == true) {
    //Query Executed Successfully and task Deleted
    $_SESSION['delete'] = "Task Deleted Sucessfully.";

    //Redirect to Homepage
    header('Location: ' . SITEURL);
  } else {
    //Failed to Delete Task
    $_SESSION['delete_fail'] = "Failed to Delete Task";

    //Redirect Home Page
    header('Location: ' . SITEURL);
  }
} else {

  //Redirect to Home Page
  header('Location: ' . SITEURL);
}