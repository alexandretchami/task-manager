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

    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>

    <h3>Add Task Page</h3>

    <p>
      <?php

      if (isset($_SESSION['add_fail'])) {
        echo $_SESSION['add_fail'];
        unset($_SESSION['add_fail']);
      }

      ?>

    </p>

    <form action="" method="POST">

      <table class="tbl-half">
        <tr>
          <td>Task Name: </td>
          <!--HTML VALIDATION-->
          <td><input type="text" name="task_name" placeholder="Type your Task Name" required="required"></td>
        </tr>

        <tr>
          <td>Task Description: </td>
          <td><textarea name="task_description" placeholder="Type Task Description"></textarea></td>
        </tr>

        <tr>
          <td>Select List: </td>
          <td>
            <select name="list_id">

              <?php
              //Connect Database
              $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

              //Select Database
              $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

              //SQL Query to get the list from table
              $sql = "SELECT * FROM tbl_lists";

              //Execute Query
              $res = mysqli_query($conn, $sql);

              //Check wheither the SLQ query executed or not

              if ($res == true) {
                //Create variable to count rows
                $count_rows = mysqli_num_rows($res);

                //If there is data in database display all in dropdown else display none as option
                if ($count_rows > 0) {
                  //display All lists on dropdown from database
                  while ($row = mysqli_fetch_array($res)) {
                    $list_id = $row['list_id'];
                    $list_name = $row['list_name'];
              ?>
                    <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                  <?php

                  }
                } else {
                  //Display none as option
                  ?>
                  <option value="0">None</option>

              <?php
                }
              }

              ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>Priority: </td>
          <td>
            <select name="priority">
              <option value="High">High</option>
              <option value="Medium">Medium</option>
              <option value="Low">Low</option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Deadline: </td>
          <td><input type="date" name="deadline"></td>
        </tr>

        <tr>
          <td><input class="btn-primary btn-lg" type="submit" name="submit" value="SAVE"></td>
        </tr>

      </table>

    </form>
  </div>
</body>

</html>

<?php

//Check wheither the SAVE button is clicked or not
if (isset($_POST['submit'])) {
  //echo "Button Clicked";
  //Get all the values from FORM
  $task_name = $_POST['task_name'];
  $task_description = $_POST['task_description'];
  $list_id = $_POST['list_id'];
  $priority = $_POST['priority'];
  $deadline = $_POST['deadline'];

  //Connect Database
  $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

  //SELECT Database
  $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_connect_error());

  //Create SQL Query to INSERT Data into Database
  $sql2 = "INSERT INTO tbl_tasks SET
      task_name = '$task_name',
      task_description = '$task_description',
      list_id = $list_id,
      priority = '$priority',
      deadline = '$deadline'
      
  ";

  //Execute Query
  $res2 = mysqli_query($conn2, $sql2);

  //Check wheither the Query executed successfully or not
  if ($res2 == true) {

    //Query Executed Task Inserted Successfully
    $_SESSION['add'] = "Task Added successfully";

    //Redirect to HomePage
    header('Location:' . SITEURL);
  } else {

    //Failed to Add Task
    $_SESSION['add_fail'] = "Failed to Add Task";

    //Redirect to Add Task Page
    header('Location:' . SITEURL . 'add-task.php');
  }
}

?>