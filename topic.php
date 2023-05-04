<?php
include("includes/header.php"); //Header 
?>
<h1 class = "Tethyr_me">Discussions</h1>
<?php

//first select the topic based on $_GET['topic_id']
$sql = "SELECT topic_id, topic_subject FROM topics WHERE topics.topic_id = " . mysqli_real_escape_string($con, $_GET['id']);

$result = mysqli_query($con, $sql);

if(!$result)
{
    echo 'The discussion could not be displayed, please try again later.' . mysqli_error($con);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This discussion does not exist.';
    }
    else
    {
        //display category data
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<h2>Posts in ' . $row['topic_subject'] . ' topic</h2>';
        }

        //do a query for the posts
        $sql = "SELECT
                discussion_posts.post_id,
                discussion_posts.post_topic,
                discussion_posts.post_content,
                discussion_posts.post_date,
                discussion_posts.post_by,
                users.id,
                users.username
                FROM
                discussion_posts
                LEFT JOIN
                users
                ON
                discussion_posts.post_by = users.id
                WHERE
                discussion_posts.post_topic = " . mysqli_real_escape_string($con, $_GET['id']);

        $result = mysqli_query($con, $sql);

        if(!$result)
        {
            echo 'The discussion could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'This discussion is empty.';
            }
            else
            {
                //prepare the table
                echo '<table border="1">
                      <tr>
                        <th>Post</th>
                        <th>Date and user name</th>
                      </tr>';

                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo $row['post_content'];
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['post_date']));
                            echo "\n";
                            echo $_SESSION['user_name'];
                        echo '</td>';
                    echo '</tr>';
                }

                echo '<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
                    <textarea name="reply-content"></textarea>
                    <input type="submit" value="Submit reply" />
                </form>';
                
            }
        }
    }
}
?>
