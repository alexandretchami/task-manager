<?php
include 'config/constants.php';
?>

<html>

<head>
  <title>Task Manager With PHP and MYSQL</title>
</head>

<body>

  <h1>ALEXANDRE TASK MANAGER</h1>

  <!-- Menu Starts Here -->

  <div class="menu">

    <a href="<?php echo SITEURL; ?>">Home</a>

    <a href="#">To Do</a>
    <a href="#">Doing</a>
    <a href="#">Done</a>

    <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
  </div>

  <!-- Menu Ends Here -->

  <!-- Tasks starts Here--->

  <p>
    <?php

    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    ?>
  </p>

  <div class="all-tasks">

    <a href="<?php echo SITEURL; ?>add-task.php">Add Task</a>

    <table>
      <tr>
        <th>S.N.</th>
        <th>Task Name</th>
        <th>Priority</th>
        <th>Deadline</th>
        <th>Actions</th>
      </tr>

      <tr>
        <td>1. </td>
        <td>Build a Application</td>
        <td>Medium</td>
        <td>24/05/2022</td>
        <td>
          <a href="#">Update</a>

          <a href="#"> Delete</a>

        </td>
      </tr>
    </table>

  </div>

  <!-- Tasks Ends Here--->


</body>

</html>