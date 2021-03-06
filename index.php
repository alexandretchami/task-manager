<?php
include 'config/constants.php';
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

    <!-- Tasks starts Here--->

    <p>
      <?php

      if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }

      if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
      }

      if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
      }


      if (isset($_SESSION['delete_fail'])) {
        echo $_SESSION['delete_fail'];
        unset($_SESSION['delete_fail']);
      }

      ?>
    </p>

    <div class="all-tasks">

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

        //Connect Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

        //Select Database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

        //Create SQL Query to Get Data From Database
        $sql = "SELECT * FROM tbl_tasks";

        //Execute Query
        $res = mysqli_query($conn, $sql);

        //Check wheither the Query executed or not
        if ($res == true) {

          //Display the Tasks from Database
          //Count the Tasks on Database First
          $count_rows = mysqli_num_rows($res);

          //Create Serial Variable
          $sn = 1;

          //Check Wheither there is tasks on database or not
          if ($count_rows > 0) {

            //Data is in Database
            while ($row = mysqli_fetch_assoc($res)) {
              $task_id = $row['task_id'];
              $task_name = $row['task_name'];
              $priority = $row['priority'];
              $deadline = $row['deadline'];

        ?>

              <tr>
                <td><?php echo $sn++; ?>. </td>
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
            //No Data in Database
            ?>

            <tr>
              <td colspan=" 5">No Task Added Yet.
              </td>
            </tr>

        <?php

          }
        }

        ?>

      </table>

    </div>

    <!-- Tasks Ends Here--->

  </div>
</body>

</html>