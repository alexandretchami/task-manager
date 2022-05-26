<?php
//include constance.php
include 'config/constants.php';
//echo "Delete List Page";

//Check wheither the list_id is assigned or not

if (isset($_GET['list_id'])) {
    //Delete the List from database

    //Get the list_id value from URL or Get Method
    $list_id = $_GET['list_id'];

    //Connect the Database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error());

    //Select Database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

    //Write the Query to delete List from Database
    $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check wheither the Query Executed successfully or not
    if ($res == true) {
        //Query Executed Successfully which means list is dileted successfully
        $_SESSION['delete'] = "List Deleted Successfully";

        //Redirect to Manage List Page
        header("Location: " . SITEURL . "manage-list.php");
    } else {
        //Failed to Delete List
        $_SESSION['delete_fail'] = "Failed to Delete List";
        //Redirect to Manage List Page
        header("Location: " . SITEURL . "manage-list.php");
    }
} else {
    //Redirect to Manage Page
    header("Location: " . SITEURL . "manage-list.php");
}