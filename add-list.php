<?php
include('config/constants.php');
?>

<html>

<head>
  <title>Task Manager with PHP and MYSQL</title>
  <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
</head>

<body>
  <div class="wrapper">

    <h1>ALEXNADRE TASK MANAGER</h1>

    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>

    <h3>Add List Page</h3>

    <p>
      <?php

      //Check if the SESSIOn is created or not
      if (isset($_SESSION['add_fail'])) {

        //Display session message
        echo $_SESSION['add_fail'];
        //Remove the message after displaying once
        unset($_SESSION['add_fail']);
      }

      ?>
    </p>

    <!-- Form to Add List Starts Here -->

    <form action="" method="POST">

      <table class="tbl-half">
        <tr>
          <td>List Name: </td>
          <td>
            <input type="text" name="list_name" placeholder="Type List name Here" required="required" />
          </td>
        </tr>

        <tr>
          <td>List Description: </td>
          <td>
            <textarea name=" list_description" placeholder="Type List Description Here"></textarea>
          </td>
        </tr>

        <tr>
          <td><input class="btn-primary btn-lg" type="submit" name="submit" value="SAVE" /></td>
        </tr>
      </table>
    </form>

    <!-- Form to Add List Ends Here -->
  </div>
</body>

</html>

<?php

// Check wheither the form is submitted or not .

if (isset($_POST['submit'])) {
  //echo "Form submitted";

  // Get the value from the form and save it in variables

  $list_name = $_POST['list_name'];
  $list_description = $_POST['list_description'];

  // Connect the Database  

  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

  //Check wheither the database connected or not 

  /* if($conn==true)
      {
        echo "Database Connected";
      }
    */

  //Select Database 

  $db_select = mysqli_select_db($conn, DB_NAME);

  //Check wheither database is connected or not

  /*if($db_select==true)
    {
      echo "Databse Selected";
    }
    */

  //SQL Query to Insert Data Into database

  $sql = "INSERT INTO tbl_lists SET
      list_name = '$list_name',
      list_description = '$list_description'
    ";

  //Execute Query into Database

  $res = mysqli_query($conn, $sql);

  // Check wheither the query executed successfully or not 
  if ($res == true) {
    //Data inserted successfully
    //echo "Data Inserted";

    //Create a SESSION Variable to Display message
    $_SESSION['add'] = "List Added Successfully";

    //Redirect to Manage List Page
    header('Location:' . SITEURL . 'manage-list.php');
  } else {
    //Failed to Insert data
    //echo "Failed to Insert Data";

    //Create SESSION to save message
    $_SESSION['add_fail'] = "Failed to Add List";

    //Redirect To Same Page
    header('Location:' . SITEURL . 'add-list.php');
  }
}

?>