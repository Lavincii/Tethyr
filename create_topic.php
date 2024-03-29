 <?php include("includes/header.php");?>
<?php


if(isset($_SESSION['username']) == false)
{
    //the user is not signed in
    echo 'Sorry, you have to be <a href="signin.php">signed in</a> to create a topic.';
}
else
{
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT cat_id, cat_name, cat_description FROM categories";

        $result = mysqli_query($con, $sql);

        if(!$result)
        {
            //the query failed, uh-oh :-(
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created Group yet.';
                }
                else
                {
                    echo 'Before you can post a Discussion, you must wait for an admin to create some Groups.';
                }
            }
            else
            {

                echo '<form method="post" action="">
                    Subject: <input type="text" name="topic_subject" />
                    Group:';

                echo '<select name="topic_cat">';
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select>';

                echo 'Group Description: <textarea name="post_content" /></textarea>
                    <input type="submit" value="Start Discussion" />
                 </form>';
            }
        }
    }
    else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($con, $query);

        if(!$result)
        {
            //Damn! the query failed, quit
            echo 'An error occured while creating your Discussion. Please try again later.';
        }
        else
        {

            //the form has been posted, so save it
            //insert the topic into the topics table first, then we'll save the post into the posts table
            $sql = "INSERT INTO topics(topic_subject, topic_date, topic_cat, topic_by) VALUES('" . mysqli_real_escape_string($con, $_POST['topic_subject']) . "', NOW(), " . mysqli_real_escape_string($con, $_POST['topic_cat']) . "," . $_SESSION['id'] . ")";

            $result = mysqli_query($con ,$sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.' . mysqli_error($con);
                $sql = "ROLLBACK;";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                //the first query worked, now start the second, posts query
                //retrieve the id of the freshly created topic for usage in the posts query
                $topicid = mysqli_insert_id($con);
                $topic_category = mysqli_real_escape_string($con, $_POST['topic_cat']);

                $sql = "INSERT INTO
                            discussion_posts(
                                  post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . mysqli_real_escape_string($con ,$_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['post_id'] . "
                            )";
                $result = mysqli_query($con, $sql);

                if(!$result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your post. Please try again later.' . mysqli_error($con);
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($con, $sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysqli_query($con, $sql);

                    //after a lot of work, the query succeeded!
                    echo 'You have successfully created <a href="topic.php?id='. $topic_category . '">your new discussion</a>.';
                }
            }
        }
    }
}

?>
 <h1 class = "Tethyr_me">Create Discussion</h1>
 
