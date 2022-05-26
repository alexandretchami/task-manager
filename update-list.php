<?php

include 'config/constants.php';

//Get the current values of Selected List
if (isset($_GET['list_id'])) {
    //Get the List ID value
    $list_id = $_GET['list_id'];

    //Connect to Databse
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

    //Select DATABASE
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

    //Query to Get the Values From Database
    $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check wheither the Query executed successfully
    if ($res == true) {
        //Get the Value from Database
        $row = mysqli_fetch_assoc($res); // Value is in array

        //printing $row array

        //print_r($row);

        //Create Individual Variable to save the data
        $list_name = $row['list_name'];
        $list_description = $row['description'];

    } else {
        //Go Back to Manage List Page
        header("Location:" . SITEURL . "manage-list.php");
    }
}
?>


<html lang="en">

<head>
  <title>Task Manager With PHP and MYSQL</title>
</head>

<body>

  <h1>ALEXANDRE TASK MANAGER</h1>

  <div class="menu">
    <a href="<?php echo SITEURL; ?>">Home</a>
    <a href="<?php echo SITEURL; ?>manage-list.php">Manage List</a>
  </div>

  <h3>Update List Page</h3>

  <p>
    <?php
//Check Wheither the session is set or not
if (isset($_SESSION['update_fail'])) {
    echo $_SESSION['update_fail'];
    unset($_SESSION['update_fail']);
}
?>
  </p>

  <form action="" method="POST">

    <table>
      <tr>
        <td>List Name: </td>
        <td>
          <input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required">
        </td>
      </tr>

      <tr>
        <td>List Description: </td>
        <td>
          <textarea name="list_description">
            <?php echo $list_description; ?>
          </textarea>
        </td>
      </tr>
      <td>
        <input type="submit" name="submit" value="UPDATE">
      </td>
      <tr>

      </tr>
    </table>

  </form>

</body>

</html>


<?php
//Check wheither the Update button is clicked or not
if (isset($_POST['submit'])) {
    //echo "Button Clicked";

    //Get the Updated values From our form
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    //Connect Database
    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

    //Select the database
    $db_select2 = mysqli_select_db($conn2, DB_NAME);

    //QUERY to Update List
    $sql2 = "UPDATE tbl_lists SET
    list_name = '$list_name',
    list_description = '$list_description'
    WHERE list_id=$list_id
    ";

    //Execute the Query
    $res2 = mysqli_query($conn2, $sql2);

    //Check Wheither the Query executed Successfully
    if ($res2 = true) {
        //Update Successful
        //Set the Message
        $_SESSION['update'] = "List Updated Successfully";

        //Redirect to Manage List Page
        header('Location:' . SITEURL . 'manage-list.php');

    } else {
        //Failed to Updated
        //Set Session Message
        $_SESSION['update_fail'] = "Failed to Update List";
        //Redirect to the Update List page
        header('Location:' . SITEURL . 'update-list.php?list_id=' . $list_id);
    }
}

?>