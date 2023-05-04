<?php
include("includes/header.php"); //Header 
?>


	<h1 class = "Tethyr_me">Tethyr Me</h1>






<div class="friend_requests column" id="main_column">

	<h4>Friend Requests</h4>

	<?php  

	$query = mysqli_query($con, "SELECT * FROM friend_requests WHERE user_to='$userLoggedIn'");
	if(mysqli_num_rows($query) == 0)
		echo "You have no friend requests at this time!";
	else {

		while($row = mysqli_fetch_array($query)) {
			$user_from = $row['user_from'];
			$user_from_obj = new User($con, $user_from);

			echo $user_from_obj->getFirstAndLastName() . " sent you a friend request!";

			$user_from_friend_array = $user_from_obj->getFriendArray();

			if(isset($_POST['accept_request' . $user_from ])) {
				$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$user_from,') WHERE username='$userLoggedIn'");
				$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$userLoggedIn,') WHERE username='$user_from'");

				$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "You are now friends!";
				header("Location: requests.php");
			}

			if(isset($_POST['ignore_request' . $user_from ])) {
				$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "Request ignored!";
				header("Location: requests.php");
			}

			?>
			<form action="requests.php" method="POST">
				<input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept">
				<input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignore_button" value="Ignore">
			</form>
			<?php


		}

	}

	?>


</div>
	<h1 class = "Meet_Tag">Discussions</h1>
      <div class = "discussion_table">
      <a class="item" href="create_topic.php">Start a Discussion</a>  
      <br></br>
      <br></br>
      <a class="item" href="topic.php">Join a Discussion</a>  
  	  </div>
  	  <h1 class = "groups">Groups</h1>
      <div class = "group_table">
      <a class="item" href="create_cat.php">Form a Group</a>
      <br></br>
      <br></br>
      <a class="item" href="category.php">Join a Group</a>
    </div>
  	  <h1 class = "events">Events</h1>
      <div class = "event_table">
      <a class="item" href="create_event.php">Host an Event</a>
      <br></br>
      <br></br>
      <a class="item" href="event.php">Join an Event</a>
      </div>
  <?php
$sql = "SELECT  *
   FROM CATEGORIES
   INNER JOIN TOPICS
   ON CATEGORIES.CAT_ID = TOPICS.TOPIC_CAT;";


$result = mysqli_query($con, $sql);

if(!$result)
{
    echo 'The Groups could not be displayed, please try again later.';
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo '';
    }
    else
    {
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Group</th>
                <th>Discussion</th>
              </tr>';

        while($row = mysqli_fetch_assoc($result))
        {
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
                            echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';;
                echo '</td>';
            echo '</tr>';
        }
    }
}
?>
