 <?php include("includes/header.php");?>
  <h1 class = "Tethyr_me">Create Group</h1>

<?php

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //the form hasn't been posted yet, display it
    echo "
        <div class = 'centercat'>
        <br>
        <br>
        <br>
        <form method='post' action=''>
        Group name: <input type='text' name='cat_name' />
        <input class = 'formg' type='submit' value='Form Group' />
        <br>
        <br>
        Group description: <textarea name='cat_description' /></textarea>
     </form>
     </div>";
}
else
{
    //the form has been posted, so save it
    $sql = "INSERT INTO categories(cat_name, cat_description)
       VALUES('" . mysqli_real_escape_string($con, $_POST['cat_name']) . "',
             '" . mysqli_real_escape_string($con, $_POST['cat_description']). "');";
    $result = mysqli_query($con, $sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error' . mysqli_error();
    }
    else
    {
        echo 'New Group successfully added.';
    }
}


?>

