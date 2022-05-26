<?php
include 'config/constants.php';
?>


<html>

<head>
  <title>Task Manager with PHP and MYSQL</title>
</head>

<body>

  <h1>ALEXANDRE TASK MANAGER</h1>

  <a href="<?php echo SITEURL; ?>">Home</a>

  <h3>Manage Lists Page</h3>

  <p>
    <?php

//Check if the SESSION is set
if (isset($_SESSION['add'])) {
    //display the message
    echo $_SESSION['add'];
    //Remove the message after displaying one time
    unset($_SESSION['add']);
}

//Check the SESSION for Delete

if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

//Check Session Message for Update
if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

//Check for Delete Fail
if (isset($_SESSION['delete_fail'])) {
    echo $_SESSION['delete_fail'];
    unset($_SESSION['delete_fail']);
}

?>
  </p>

  <!--Table to display lists starts here -->
  <div class="all-lists">

    <a href="<?php echo SITEURL; ?>add-list.php">Add List</a>

    <table>

      <tr>
        <th>S.N.</th>
        <th>List Name</th>
        <th>Actions</th>
      </tr>

      <!--ON AFFICHE LES Données Insérées dans la BDD sur la page Manage-list--->

      <?php
//Connect the database first
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

//Select Database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

//SQL Query to Display data from database
$sql = "SELECT * FROM tbl_lists";

//Execute the Query
$res = mysqli_query($conn, $sql);

//Check wheither the Query Executed or not

if ($res == true) {
    //Work on displaying data
    //echo "Executed";

    //Count the rows of data in Database
    $count_rows = mysqli_num_rows($res);

    //Create a Serial Numlber Variable
    $sn = 1;

    //Check wheither there is data in Database or not
    if ($count_rows > 0) {
        //There is data in database Display in table

        while ($row = mysqli_fetch_assoc($res)) {

            //Getting the Data From Database

            $list_id = $row['list_id'];
            $list_name = $row['list_name'];
            ?>

      <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $list_name; ?></td>
        <td>
          <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id; ?>">Update</a>
          <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>">Delete</a>
        </td>
      </tr>

      <?php

        }
    } else {
        //No Data in Database
        ?>

      <tr>
        <td colspan="3">No List Added Yet.</td>
      </tr>

      <?php

    }
}

?>

    </table>
  </div>

  <!--Table to display lists ends here -->

</body>

</html>