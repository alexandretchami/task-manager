<?php

include('config/constants.php');

//Check the Task ID in URL
if (isset($_GET['task_id'])) {

  //Get the Value from Database
  $task_id = $_GET['task_id'];

  //Connect Database
  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

  //Select Database
  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

  //SQL Query to Get the Detail of Select Task
  $sql = "SELECT * FROM tbl_tasks WHERE task_id=$task_id";

  //Execute Query
  $res = mysqli_query($conn, $sql);

  //Check if the Query Executed successfully or not
  if ($res == true) {
    //Query Executed
    $row = mysqli_fetch_assoc($res);

    //Get the Indivisual Value
    $task_name = $row['task_name'];
    $task_description = $row['task_description'];
    $list_id = $row['list_id'];
    $priority = $row['priority'];
    $deadline = $row['deadline'];
  }
} else {
  //Redirect to Homepage
  header('Location: ' . SITEURL);
}

?>

<html>

<head>
  <title>Task Manager With PHP and MYSQL</title>
  <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
</head>

<body>
  <div class="wrapper">

    <h1>ALEXANDRE TASK MANAGER</h1>

    <p>
      <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    </p>

    <h3>Update Task Page</h3>

    <!--ON AFFICHE LE MESSAGE ET ON LE SUPPRIME Après-->
    <p>
      <?php

      if (isset($_SESSION['update_fail'])) {
        echo $_SESSION['update_fail'];
        unset($_SESSION['update_fail']);
      }

      ?>
    </p>

    <form action="" method="POST">

      <table class="tbl-half">

        <tr>
          <td>Task Name: </td>
          <td><input type="text" name="task_name" value="<?php echo $task_name;  ?>" required="required"></td>
        </tr>

        <tr>
          <td>Task Description: </td>
          <td>
            <textarea name="task_description">
              <?php echo $task_description;  ?>
          </textarea>
          </td>
        </tr>

        <tr>
          <td>Select List: </td>
          <td>
            <select name="list_id">

              <?php

              //Connect Database
              $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

              //Select Database
              $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_connect_error());

              //SQL Query to Get Lists
              $sql2 = "SELECT * FROM tbl_lists";

              //Execute Query
              $res2 = mysqli_query($conn2, $sql2);

              //Check if executed successfully or not
              if ($res2 == true) {
                //Display the Lists
                //Cont Rows
                $count_rows = mysqli_num_rows($res2);

                //Check Wheither List is added or not
                if ($count_rows > 0) {

                  //Lists are Added
                  while ($row2 = mysqli_fetch_assoc($res2)) {

                    //Get Individual Value
                    $list_id_db = $row2['list_id'];
                    $list_name = $row2['list_name'];
              ?>
                    <option <?php if ($list_id_db == $list_id) {
                              echo "selected='selected'";
                            } ?>value="<?php echo $list_id_db; ?>">
                      <?php echo $list_name; ?>
                    </option>
                  <?php

                  }
                } else {

                  //No List Added
                  //Display none as option
                  ?>
                  <option <?php if ($list_id = 0) {
                            echo "selected='selected'";
                          } ?> value="0">None</option>

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
              <option <?php if ($priority == "High") {
                        echo "selected='selected'";
                      } ?> value="High">High</option>

              <option <?php if ($priority == "Medium") {
                        echo "selected='selected'";
                      } ?> value="Medium">Medium</option>

              <option <?php if ($priority == "Low") {
                        echo "selected='selected'";
                      } ?> value="Low">Low</option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Deadline: </td>
          <td><input type="text" name="deadline" value="<?php echo $deadline; ?>"></td>
        </tr>

        <tr>
          <td><input class="btn-primary btn-lg" type="submit" name="submit" value="UPDATE"></td>
        </tr>

      </table>

    </form>

  </div>
</body>

</html>

<?php
//Check if the button is Clicked
if (isset($_POST['submit'])) {
  //echo "Clicked";

  //Get the Values From Form
  $task_name = $_POST['task_name'];
  $task_description = $_POST['task_description'];
  $list_id = $_POST['list_id'];
  $priority = $_POST['priority'];
  $deadline = $_POST['deadline'];

  //Connect Database
  $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

  //Select Database
  $db_select3  = mysqli_select_db($conn3, DB_NAME) or die(mysqli_connect_error());

  //Create SQL Query to Update Task
  $sql3 = "UPDATE tbl_tasks SET
  task_name = '$task_name',
  task_description = '$task_description',
  list_id = '$list_id',
  priority = '$priority',
  deadline = '$deadline'
  WHERE 
  task_id = $task_id
    
  ";

  //Execute Query
  $result = mysqli_query($conn3, $sql3);

  //Check Wheither the Query executed or not
  if ($res == true) {
    //Query Executed and Task Updated
    $_SESSION['update'] = "Task Updated Successfully.";

    //Redirect To Homepage
    header('Location:' . SITEURL);
  } else {

    //Failed to Update Task
    $_SESSION['update_fail'] = "Failed to Update task.";

    //Redirect to this Page
    header('location:' . SITEURL . 'update-task.php?task_id' . $task_id);
  }
}
?>