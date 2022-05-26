<?php
include('config/constants.php');
//Get the list ID from URL

$list_id_url = $_GET['list_id'];

?>

<html>

<head>
  <title>Task Manager With PHP and MYSQL</title>
  <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
</head>

<body>
  <div class="wrapper">

    <h1>ALEXANDRE TASK MANAGER</h1>

    <!-- Menu Starts Here -->

    <div class="menu">

      <a href="<?php echo SITEURL; ?>">Home</a>

      <?php

      //Comment Displaying Lists From Database in ourMenu

      $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

      //SELECT DATABASE
      $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_connect_error());

      //Query to Get the List From database
      $sql2 = "SELECT * FROM tbl_lists";

      //Execute Query
      $res2 = mysqli_query($conn2, $sql2);

      //Check Wheither the Query executed or not
      if ($res2  == true) {

        //Display the Lists in Menu
        while ($row2 = mysqli_fetch_assoc($res2)) {
          $list_id = $row2['list_id'];
          $list_name = $row2['list_name'];

      ?>

          <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>

      <?php

        }
      }


      ?>

      <a href=" <?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
    </div>

    <!-- Menu Ends Here -->

    <div class="all-task">

      <a class="btn-primary" href="<?php echo SITEURL; ?>add-task.php">Add Task</a>

      <table class="tbl-full">

        <tr>
          <th>S.N.</th>
          <th>Task Name</th>
          <th>Priority</th>
          <th>Deadline</th>
          <th>Actions</th>
        </tr>

        <?php

        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

        //Select Database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

        //SQL Query to display tasks by list selected
        $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";

        //Execute Query
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
          //Displqy the tasks based on list
          //count the rows
          $count_rows = mysqli_num_rows($res);

          if ($count_rows > 0) {

            //We have tasks on this list
            while ($row = mysqli_fetch_assoc($res)) {
              $task_id = $row['task_id'];
              $task_name = $row['task_name'];
              $priority = $row['priority'];
              $deadline = $row['deadline'];

        ?>

              <tr>
                <td>1. </td>
                <td><?php echo $task_name; ?></td>
                <td><?php echo $priority; ?></td>
                <td><?php echo $deadline; ?></td>
                <td>
                  <a href="<?php echo SITEURL;  ?>update-task.php?task_id=<?php echo $task_id;  ?>">Update</a>

                  <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>"> Delete</a>
                </td>
              </tr>

            <?php
            }
          } else {
            //No Tasks on this list
            ?>
            <tr>
              <td colspan="5">No Tasks added on this list.</td>
            </tr>
        <?php
          }
        }

        ?>

      </table>
    </div>

  </div>
</body>

</html>