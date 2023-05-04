
  
  <?php 
  include("includes/header.php");
  include("includes/form_handlers/blogpost_handler.php");
  include("includes/form_handlers/cat_placement.php");
  ?>

<?php 

if(isset($_POST['post'])){

	$uploadOk = 1;
	$imageName = $_FILES['fileToUpload']['name'];
	$errorMessage = "";

	if($imageName != "") {
		$targetDir = "assets/images/posts/";
		$imageName = $targetDir . uniqid() . basename($imageName);
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload']['size'] > 10000000) {
			$errorMessage = "Sorry your file is too large";
			$uploadOk = 0;
		}

		if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if($uploadOk) {
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
				//image uploaded okay
			}
			else {
				//image did not upload
				$uploadOk = 0;
			}
		}

	}

	if($uploadOk) {
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], 'none', $imageName);
	}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
	}

}


 ?>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="assets/js/OpenClose.js"></script>
  <script>
  $( function() {
    $( "#slider-range-max" ).slider({
      range: "max",
      min: 1,
      max: 10,
      value: 2,
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.value );
      }
    });
    $( "#amount" ).val( $( "#slider-range-max" ).slider( "value" ) );
  } );
  </script>

 <div  id = "poll" class = "poll">
<form>
  <center><h4>Is this post credible?</h4></center>
  <center><a href="cred.php" class="btn"><i class="fa fa-info-circle fa-lg"></i></a></center>
  <hr>
  <br>
  <label for="amount">Number of sources:</label>
  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
  <div id="slider-range-max"></div>
  <hr>
  <label>List Sources (seperated by a comma):</label>
  <br>
  <textarea name="blogpost_text" id="blogpost_text" class="char-textarea" placeholder="List here..."></textarea>
  <hr>
  <br>
  <label>Supporting Documentation Links (seperated by a comma):</label>
  <br>
  <textarea name="blogpost_text" id="blogpost_text" class="char-textarea" placeholder="List links..."></textarea>
  <hr>
  <br>
  <label>Objective vs. Subjective:</label>
  <hr>
  <br>
  <label>Misleading vs. Straight Forward:</label>
  <hr>
  <br>
  <label for="amount">Relavancy:</label>
  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
  <div id="slider-range-max"></div>
  <br>
</form>
<button onclick="closePoll();" type="button" class="btn btn-danger">Cancel</button>
<input class = "btn btn-success" type="submit" name="pollvote" id="poll_button" value="Score">
</div>


	<div class="user_details column" >
		<a href="<?php echo '$userLoggedIn'; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			//echo $user['first_name'] . " " . $user['last_name'];
			  echo 'My Profile';
			 ?>
			</a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>"; 
			echo "Likes: " . $user['num_likes'];

			?>
		</div>
    
	</div>
  <div class="trend_details column">

    <h4>Popular</h4>

    <div class="trends">
      <?php 
      $query = mysqli_query($con, "SELECT * FROM trends ORDER BY hits DESC LIMIT 9");

      foreach ($query as $row) {
        
        $word = $row['title'];
        $word_dot = strlen($word) >= 14 ? "..." : "";

        $trimmed_word = str_split($word, 14);
        $trimmed_word = $trimmed_word[0];

        echo "<div style'padding: 1px'>";
        echo $trimmed_word . $word_dot;
        echo "<br></div><br>";


      }
      
      ?>

    </div>
    

  </div>

<button class="tether" onclick="openIcon(); openCloser(); openNews();" >T</button>
<!--<button id = "tether_icon" class = "add_tether">+</button> -->
<button  id = "T_icon" class="tether_following" onclick="openForm(); openTools(); openToolNote(); " >Friends</button>
<button  id = "news_icon" class="tether_news" onclick="openRss(); openTools(); openWeather();" >Newsfeed</button>
<button id = "X_icon" class="close_tether" onclick="closeIcon(); closeForm(); closeCloser(); closeNews(); closeRss(); closeTools(); closeBox(); closeNotepad(); closeToolNote(); closeWeather(); closePoll(); closeCompare();">X</button> 

 

	<div id="myForm" class="post_form" > 
		<!--<div class="main_column column" id="main_canvas_parent"> --><!-- Newsfeed -->
      <div class="post_column">
		<form class="form-container" action="index.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload"><!-- file loading img -->
			<textarea data-length=500 class="char-textarea" name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
			<input type="submit" name="post" id="post_button" value="POST">
      <h4><span class="char-count">500</span> Max</h4> <!--  500 Min  if needed-->
			<hr>
		</form>
		<div class="posts_area">
    </div>
		<!-- <button id="load_more">Load More Posts</button> -->
		<img id="loading" src="assets/images/icons/loading.gif">

  <button type="button" class="btn cancel" onclick="closeForm();">Close</button>	
  </div>	
  </div>

<div id = "compare" class = "compare_box">
 <center> <h4>Compare Posts</h4></center>
   
<?php
 /* $sql = "SELECT *, MATCH(body) AGAINST('$body') AS score FROM posts WHERE MATCH(body) AGAINST('$body') 
ORDER BY score DESC LIMIT 5";*/
/*  $sql = "SELECT * FROM posts WHERE body LIKE '$query%' LIMIT 8";
  //%".$term."%
  //$r_query = mysql_query($sql); 
  $result = mysqli_query($con, $sql);
  $resultCheck = mysqli_num_rows($result);

  if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo $row['query'];
      //echo "<br></div><br>";

    }
  }*/

  ?>
    <br> 
  <center> <button class = "btn btn-danger" onclick="closeCompare();" type = "button">Close</button> </center>
</div>

<!--<div id = "blogP" class = "post_blog_box">
    <form class="form-container" action="index.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="fileToUpload" id="fileToUpload">
      <textarea data-length=2500 class="char-textarea" name="blogpost_text" id="blogpost_text" placeholder="Got something to say?"></textarea>
      <input type="submit" name="blogpost" id="post_button" value="POST">
      <h4><span class="char-count">2500</span> Max</h4> 
      <hr>
    </form>
<button onclick="closeBlogPost();" type="button" class="btn btn-danger">Cancel</button>
</div> -->

<div id = "open_News" class = "news_column">
<div class=" tab">
  <button class="tablinks" onclick="openCity(event, 'localnews')">Local News</button>
  <button class="tablinks" onclick="openCity(event, 'weather')">Weather</button>
  <button class="tablinks" onclick="openCity(event, 'following')">Following</button>
  <button class="tablinks" onclick="openCity(event, 'worldnews')">World News</button>
  <button class="tablinks" onclick="openCity(event, 'Add')">Add +</button>
  <button id = "Tech_category" category class="tablinks cat" onclick="openCity(event, 'Technology')">Technology</button>
  <button id = "Animal_category" category class="tablinks cat" onclick="openCity(event, 'Animal')">Animals</button>
  <button id = "Food_category" category class="tablinks cat" onclick="openCity(event, 'Food')">Food</button>
  <button id = "Health_category" category class="tablinks cat" onclick="openCity(event, 'Health')">Health</button>
  <button id = "Travel_category" category class="tablinks cat" onclick="openCity(event, 'Travel')">Travel</button>
  <button id = "Lifestyle_category" category class="tablinks cat" onclick="openCity(event, 'Lifestyle')">Lifestyle</button>
  <button id = "Religion_category" category class="tablinks cat" onclick="openCity(event, 'Religion')">Religion</button>
  <button id = "Business_category" category class="tablinks cat" onclick="openCity(event, 'Business')">Business</button>
  <button id = "Sports_category" category class="tablinks cat" onclick="openCity(event, 'Sports')">Sports</button>
  <button id = "Entertainment_category" category class="tablinks cat" onclick="openCity(event, 'Entertainment')">Entertainment</button>
  <button id = "Cars_category" category class="tablinks cat" onclick="openCity(event, 'Cars')">Cars</button>
  <button id = "Family_category" category class="tablinks cat" onclick="openCity(event, 'Family')">Family</button>
  <button id = "Games_category" category class="tablinks cat" onclick="openCity(event, 'Games')">Games</button>
  <button id = "Unexplained_category" category class="tablinks cat" onclick="openCity(event, 'Unexplained')">Unexplained</button>
</div>

<div id="worldnews" class="tabcontent">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.yahoo.com/news/rss"; rssfeed_url[1]="https://www.cnbc.com/id/100003114/device/rss/rss.html";rssfeed_url[2]="https://www.espn.com/espn/rss/news"; rssfeed_url[3]="https://www.cbsnews.com/latest/rss/main"; rssfeed_url[4]="http://feeds.foxnews.com/foxnews/latest"; rssfeed_url[5]= "http://rss.cnn.com/rss/cnn_topstories.rss"; rssfeed_url[6]= "http://feeds.bbci.co.uk/news/world/rss.xml"; rssfeed_url[7]= "https://www.nytimes.com/svc/collections/v1/publish/https://www.nytimes.com/section/world/rss.xml"; rssfeed_url[8]= "https://buzzfeed.com/world.xml"; rssfeed_url[9]= "defence-blog.com/feed"; rssfeed_url[10]= "https://thecipherbrief.com/feed"; rssfeed_url[11]= "https://www.reddit.com/r/worldnews/.rss"; rssfeed_url[12]= "theguardian.com/world/rss"; rssfeed_url[13]= "feeds.washingtonpost.com/rss/world"; rssfeed_url[14]= "https://feeds.npr.org/1004/rss.xml"; rssfeed_url[15]= "https://time.com/feed/"; rssfeed_url[16]= "https://abcnews.go.com/abcnews/internationalheadlines"; rssfeed_url[17]= "http://feeds.feedburner.com/time/world"; rssfeed_url[18]= "https://www.huffpost.com/section/front-page/feed?x=1"; rssfeed_url[19]= "https://vox.com/rss/world/index.xml"; rssfeed_url[20]= "https://www.scmp.com/rss/91/feed"; rssfeed_url[21]= "https://www.latimes.com/world/rss2.0.xml"; rssfeed_url[22]= "https://www.washingtontimes.com/rss/headlines/news/world"; rssfeed_url[23]= "https://www.cbc.ca/cmlink/rss-world"; rssfeed_url[24] = "http://rssfeeds.usatoday.com/UsatodaycomNation-TopStories"; rssfeed_url[25]= "theguardian.com/world/rss"; rssfeed_url[26]= "http://feeds.reuters.com/Reuters/domesticNews"; rssfeed_url[27]= "https://www.politico.com/rss/politicopicks.xml"; rssfeed_url[28]= "https://nypost.com/feed/"; rssfeed_url[29]= "http://feeds.feedburner.com/breitbart";
rssfeed_frame_width="425"; 
rssfeed_frame_height="535";
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="15"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="off"; 
rssfeed_css_url=""; 
rssfeed_title="off"; 
rssfeed_title_name="Recent News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#EC9F05"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "769c39857ccf3482fed5490c7675d428"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 

</div>
<div id="localnews" class="tabcontent">
  <h3>Local News</h3>
</div>

<div id="weather" class="tabcontent">
  <h3>Your Weather Forcast</h3>
   <!-- <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <div class="elfsight-app-992fc457-c35a-41db-87d4-a460c85f09dd"></div>-->
</div>
<div id="Add" class="tabcontent">
  <div class = "AddC">
  <h3>Add Category</h3>
  <h6> Choose a category from the options below to add or remove it to your newsfeed!</h6>
  <hr>
  <ul>
    <li><button onclick = "addtech();" class = "plus">+</button> <button onclick = "addtech();" class = "add_cat">Technology</button> <button onclick = "removetech();"class = "minus">-</button></li>
    <br></br>
    <li><button onclick = "addAnimal();" class = "plus">+</button> <button onclick = "addAnimal();" class = "add_cat">Animals</button> <button onclick = "removeAnimal();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addFood();" class = "plus">+</button> <button onclick = "addFood();" class = "add_cat">Food</button> <button onclick = "removeFood();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addHealth();" class = "plus">+</button> <button onclick = "addHealth();" class = "add_cat">Health</button> <button onclick = "removeHealth();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addTravel();" class = "plus">+</button> <button onclick = "addTravel();" class = "add_cat">Travel</button> <button onclick = "removeTravel();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addBusiness();" class = "plus">+</button> <button onclick = "addBusiness();" class = "add_cat">Business</button> <button onclick = "removeBusiness();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addReligion();" class = "plus">+</button> <button onclick = "addReligion();" class = "add_cat">Religion</button> <button onclick = "removeReligion();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addSports();" class = "plus">+</button> <button onclick = "addSports();" class = "add_cat">Sports</button> <button onclick = "removeSports();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addEntertainment();" class = "plus">+</button> <button onclick = "addEntertainment();" class = "add_cat">Entertainment</button> <button onclick = "removeEntertainment();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addCars();" class = "plus">+</button> <button onclick = "addCars();" class = "add_cat">Cars</button> <button onclick = "removeCars();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addFamily();" class = "plus">+</button> <button onclick = "addFamily();" class = "add_cat">Family</button> <button onclick = "removeFamily();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addGames();" class = "plus">+</button> <button onclick = "addGames();" class = "add_cat">Games</button> <button onclick = "removeGames();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addLifestyle();" class = "plus">+</button> <button onclick = "addLifestyle();" class = "add_cat">Lifestyle</button> <button onclick = "removeLifestyle();" class = "minus">-</button> </li>
    <br></br>
    <li><button onclick = "addUnexplained();" class = "plus">+</button> <button onclick = "addUnexplained();" class = "add_cat">Unexplained</button> <button onclick = "removeUnexplained();" class = "minus">-</button> </li>

</ul>
</div>
</div>


<div id="following" class="tabcontent">
  <h3>Following</h3>
  <hr>
  <div class="posts_area">

    </div>
</div>

<div id="Technology" class="tabcontent">
  <button  onclick = "openTech(); closeTechB();" class = "switch_news">News</button>
  <button onclick = "openTechB(); closeTech();" class = "switch_blogs">Blogs</button>
  <div id = "tech" class = "tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.techmeme.com/feed.xml?x=1"; rssfeed_url[1]="https://feeds.feedburner.com/TechCrunch/"; rssfeed_url[2]="https://www.technologyreview.com/feed/"; rssfeed_url[3]="http://feeds.arstechnica.com/arstechnica/technology-lab"; rssfeed_url[4]="https://www.wired.com/feed/rss";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Technology News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "5f3004e2cc12b92472b2ddc11c026e0b"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script>  
<!-- end sw-rss-feed code -->
</div>
    <div id = "techB" class = "tech_news">
      <div class="blogbg blogposts_area">
      </div>
    </div>
  <div class = "cat_footer">
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postBlog();" class = "news_post">+</button>
  </div>

</div>
<div id="Animal" class="tabcontent">
  <button  onclick = "openAnimal(); closeAnimalB();" class = "switch_news">News</button>
  <button onclick = "openAnimalB(); closeAnimal();" class = "switch_blogs">Blogs</button>
<div id = animal class = "tech_news">
<!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://worldanimalnews.com/feed/"; rssfeed_url[1]="https://www.youtube.com/feeds/videos.xml?user=AnimalPlanetTV"; rssfeed_url[2]="https://www.youtube.com/feeds/videos.xml?user=NatGeoWild"; rssfeed_url[3]="https://www.peta.org/blog/feed/"; rssfeed_url[4]="https://www.buzzfeed.com/animals.xml";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Animal News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "78d5d6656febc2f8f5734c3afdedbb29"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 

<!-- end sw-rss-feed code -->

</div>
<div id = "animalB" class = "tech_news">
      <div class="blogbg animalposts_area">

    </div>
</div>

  <div class = "cat_footer"> 
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postAnimalBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Food" class="tabcontent">
  <button  onclick = "openFood(); closeFoodB();" class = "switch_news">News</button>
  <button onclick = "openFoodB(); closeFood();" class = "switch_blogs">Blogs</button>
  <div id = "food" class = "tech_news">
<!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.skinnytaste.com/feed/"; rssfeed_url[1]="https://www.superhealthykids.com/feed/"; rssfeed_url[2]="https://www.thehealthyhomeeconomist.com/feed/"; rssfeed_url[3]="https://www.buzzfeed.com/food.xml"; rssfeed_url[4]="https://therecipecritic.com/feed/";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Food News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "cf305ebe3504e8a80402454428bbdbb2"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
<!-- end sw-rss-feed code -->
</div>

  <div id = "foodB" class = "tech_news">
        <div class="blogbg foodposts_area">

    </div>
  </div>

  <div class = "cat_footer"> 
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postFoodBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Health" class="tabcontent">
  <button  onclick = "openHealth(); closeHealthB();" class = "switch_news">News</button>
  <button onclick = "openHealthB(); closeHealth();" class = "switch_blogs">Blogs</button>
  <div id = "health" class = "tech_news">
<!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.hsph.harvard.edu/news/feed/?post_type=featured-news-story"; rssfeed_url[1]="https://www.mayoclinic.org/rss/all-health-information-topics"; rssfeed_url[2]="https://www.medicaldaily.com/rss"; rssfeed_url[3]="https://rssfeeds.webmd.com/rss/rss.aspx?RSSSource=RSS_PUBLIC"; rssfeed_url[4]="http://feeds.feedburner.com/Medgadget";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Health News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0";  
rssfeed_cache = "08f5d77becb5c7499cfbf0d65497ff3a"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
<!-- end sw-rss-feed code -->
</div>

  <div id = "healthB" class = "tech_news">
        <div class="blogbg healthposts_area">

    </div>
  </div>

  <div class = "cat_footer"> 

    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postHealthBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Travel" class="tabcontent">
  <button  onclick = "openTravel(); closeTravelB();" class = "switch_news">News</button>
  <button onclick = "openTravelB(); closeTravel();" class = "switch_blogs">Blogs</button>
<div id = "travel" class = "tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.buzzfeed.com/bringme.xml"; rssfeed_url[1]="https://www.usvisa.ae/blog/feed/"; rssfeed_url[2]="https://www.luxurytraveladvisor.com/rss/xml"; rssfeed_url[3]="https://feeds.feedburner.com/breakingtravelnews"; rssfeed_url[4]="https://www.bbc.com/culture/feed.rss";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Travel News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "eeb67fa3b21a6cb535eee9716565894e"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
<!-- end sw-rss-feed code -->
</div>

  <div id = "travelB" class = "tech_news">
        <div class="blogbg travelposts_area">

    </div>
  </div>

  <div class = "cat_footer"> 
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postTravelBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Business" class="tabcontent">
  <button  onclick = "openBusiness(); closeBusinessB();" class = "switch_news">News</button>
  <button onclick = "openBusinessB(); closeBusiness();" class = "switch_blogs">Blogs</button>
<div id = "business" class="tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="http://feeds.marketwatch.com/marketwatch/topstories/"; rssfeed_url[1]="https://www.inc.com/rss/"; rssfeed_url[2]="http://feeds.marketwatch.com/marketwatch/realtimeheadlines/"; rssfeed_url[3]="https://feeds.npr.org/1095/podcast.xml"; rssfeed_url[4]="https://www.entrepreneur.com/latest.rss";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Business News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "66961409112cb3338f960c9c9b328254"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 

<!-- end sw-rss-feed code -->
</div>

  <div id = "businessB" class = "tech_news">
        <div class="blogbg businessposts_area">

    </div>
  </div>
    <div class = "cat_footer"> 
      <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postBusinessBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Religion" class="tabcontent">
  <button  onclick = "openReligion(); closeReligionB();" class = "switch_news">News</button>
  <button onclick = "openReligionB(); closeReligion();" class = "switch_blogs">Blogs</button>
<div id = "religion" class="tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.worldreligionnews.com/feed/"; rssfeed_url[1]="https://www.nytimes.com/svc/collections/v1/publish/http://www.nytimes.com/topic/subject/religion-and-belief/rss.xml"; rssfeed_url[2]="https://www.christianheadlines.com/rss"; rssfeed_url[3]="https://blogs.lse.ac.uk/religionglobalsociety/feed/"; rssfeed_url[4]="https://www.theguardian.com/world/religion/rss";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Religious News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "e10c70ce2cf91ea99c8e27181e292f80"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
<!-- end sw-rss-feed code -->
</div>

  <div id = "religionB" class = "tech_news">
        <div class="blogbg religionposts_area">

    </div>
  </div>
    <div class = "cat_footer"> 
      <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postReligionBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Sports" class="tabcontent">
  <button  onclick = "openSports(); closeSportsB();" class = "switch_news">News</button>
  <button onclick = "openSportsB(); closeSports();" class = "switch_blogs">Blogs</button>
<div id = "sports" class="tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.buzzfeed.com/sports.xml"; rssfeed_url[1]="https://www.espn.com/espn/rss/news"; rssfeed_url[2]="https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU"; rssfeed_url[3]="https://www.cbssports.com/rss/headlines/"; rssfeed_url[4]="https://sports.yahoo.com/top/rss/";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Sports News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "749067064a43102b7b8726e9997bd265"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
</div>

  <div id = "sportsB" class = "tech_news">
        <div class="blogbg sportsposts_area">

    </div>
  </div>

    <div class = "cat_footer"> 
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postSportsBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Entertainment" class="tabcontent">
  <button  onclick = "openEntertainment(); closeEntertainmentB();" class = "switch_news">News</button>
  <button onclick = "openEntertainmentB(); closeEntertainment();" class = "switch_blogs">Blogs</button>
<div id = "entertainment" class="tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.buzzfeed.com/tvandmovies.xml"; rssfeed_url[1]="http://feeds.bet.com/AllBetcom"; rssfeed_url[2]="https://www.etonline.com/news/rss"; rssfeed_url[3]="https://celebrityinsider.org/feed/"; rssfeed_url[4]="https://hollywoodlife.com/feed/";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Entertainment News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "4ddd3b2a8330e55ef58e1439f93a797a"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
</div>

  <div id = "entertainmentB" class = "tech_news">
        <div class="blogbg entertainmentposts_area">

    </div>
  </div>
    <div class = "cat_footer"> 
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postEntertainmentBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Cars" class="tabcontent">
  <button  onclick = "openCars(); closeCarsB();" class = "switch_news">News</button>
  <button onclick = "openCarsB(); closeCars();" class = "switch_blogs">Blogs</button>
<div id = "cars" class="tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="http://feeds.feedburner.com/autonews/BreakingNews"; rssfeed_url[1]="https://www.autoblog.com/rss.xml"; rssfeed_url[2]="https://www.motor1.com/rss/articles/all/"; rssfeed_url[3]="https://www.motor1.com/rss/photos/all/"; rssfeed_url[4]="https://www.motortrend.com/feed/";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Car News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "ca734639198a4a6ca8ecaaa331da7b47"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
</div>

  <div id = "carsB" class = "tech_news">
        <div class="blogbg carsposts_area">

    </div>
  </div>
    <div class = "cat_footer"> 
      <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postCarsBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Family" class="tabcontent">
  <button  onclick = "openFamily(); closeFamilyB();" class = "switch_news">News</button>
  <button onclick = "openFamilyB(); closeFamily();" class = "switch_blogs">Blogs</button>
<div id = "family" class="tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="http://www.newyorkfamily.com/feed/"; rssfeed_url[1]="https://www.motherdistracted.co.uk/feed"; rssfeed_url[2]="http://jimdaly.focusonthefamily.com/feed/"; rssfeed_url[3]="https://www.familylife.com/podcast/familylife-today/"; rssfeed_url[4]="https://www.childandfamilyblog.com/feed/";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Family News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "ed79105560ea96f8937cd9475153705f"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 

</div>

  <div id = "familyB" class = "tech_news">
        <div class="blogbg familyposts_area">

    </div>
  </div>

    <div class = "cat_footer">
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postFamilyBlog();" class = "news_post">+</button> 
  </div>
</div>

<div id="Lifestyle" class="tabcontent">
  <button  onclick = "openLifestyle(); closeLifestyleB();" class = "switch_news">News</button>
  <button onclick = "openLifestyleB(); closeLifestyle();" class = "switch_blogs">Blogs</button>
<div id = "lifestyle" class="tech_news">
<!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://www.luxuo.com/feed"; rssfeed_url[1]="https://discover.luxury/feed/"; rssfeed_url[2]="https://www.reddit.com/r/LUXURYLIFE/.rss"; rssfeed_url[3]="http://www.consciouslifestylemag.com/feed/"; rssfeed_url[4]="https://www.wealthmanagement.com/rss.xml";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Lifestyle News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "ad3ee081e1b58f0c0fca172d3e732310"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 


</div>

  <div id = "lifestyleB" class = "tech_news">
        <div class="blogbg lifestyleposts_area">

    </div>
  </div>

    <div class = "cat_footer">
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postLifestyleBlog();" class = "news_post">+</button> 
  </div>
</div>

<div id="Games" class="tabcontent">
  <button  onclick = "openGames(); closeGamesB();" class = "switch_news">News</button>
  <button onclick = "openGamesB(); closeGames();" class = "switch_blogs">Blogs</button>
<div id = "games" class="tech_news">
  <!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://toucharcade.com/feed/"; rssfeed_url[1]="http://feeds.feedburner.com/DroidGamers/?x=1"; rssfeed_url[2]="http://feeds.ign.com/ign/games-all"; rssfeed_url[3]="https://www.gameinformer.com/news.xml"; rssfeed_url[4]="https://news.xbox.com/en-us/feed/";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Gaming News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "6334390db3c36456f08ab622cbd4dafb"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
</div>

  <div id = "gamesB" class = "tech_news">
        <div class="blogbg gamesposts_area">

    </div>
  </div>
    <div class = "cat_footer"> 
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postGamesBlog();" class = "news_post">+</button>
  </div>
</div>

<div id="Unexplained" class="tabcontent">
  <button  onclick = "openUnexplained(); closeUnexplainedB();" class = "switch_news">News</button>
  <button onclick = "openUnexplainedB(); closeUnexplained();" class = "switch_blogs">Blogs</button>
<div id = "unexplained" class="tech_news">
<!-- start sw-rss-feed code --> 
<script type="text/javascript"> 
<!-- 
rssfeed_url = new Array(); 
rssfeed_url[0]="https://reason.com/volokh/feed/atom/?x=1"; rssfeed_url[1]="https://www.businessinsider.com/category/conspiracy-theory.rss"; rssfeed_url[2]="http://feeds.abovetopsecret.com/new.xml"; rssfeed_url[3]="https://www.conspiracyarchive.com/feed/";  
rssfeed_frame_width="425"; 
rssfeed_frame_height="500"; 
rssfeed_scroll="off"; 
rssfeed_scroll_step="10"; 
rssfeed_scroll_bar="on"; 
rssfeed_target="_blank"; 
rssfeed_font_size="14"; 
rssfeed_font_face="Nunito-Bold"; 
rssfeed_border="on"; 
rssfeed_css_url=""; 
rssfeed_title="on"; 
rssfeed_title_name="Unexplained News"; 
rssfeed_title_bgcolor="#EC9F05"; 
rssfeed_title_color="#7c602a"; 
rssfeed_title_bgimage=""; 
rssfeed_footer="off"; 
rssfeed_footer_name="rss feed"; 
rssfeed_footer_bgcolor="#fff"; 
rssfeed_footer_color="#333"; 
rssfeed_footer_bgimage=""; 
rssfeed_item_title_length="50"; 
rssfeed_item_title_color="#666"; 
rssfeed_item_bgcolor="#fff"; 
rssfeed_item_bgimage=""; 
rssfeed_item_border_bottom="on"; 
rssfeed_item_source_icon="off"; 
rssfeed_item_date="on"; 
rssfeed_item_description="on"; 
rssfeed_item_description_length="120"; 
rssfeed_item_description_color="#666"; 
rssfeed_item_description_link_color="#333"; 
rssfeed_item_description_tag="on"; 
rssfeed_no_items="0"; 
rssfeed_cache = "9baf60022a1895c151fa73f7147c8994"; 
//--> 
</script> 
<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
</div>

  <div id = "unexplainedB" class = "tech_news">
        <div class="blogbg unexplainedposts_area">

    </div>
  </div> 

    <div class = "cat_footer"> 
    <button class = "filter"><i class='fa fa-cog fa-lg'></i></button>
    <button onclick = "postUnexplainedBlog();" class = "news_post">+</button>
    </div>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
</div>

 <!-- <label onclick = "openBox();" id = "toolbar" class = "lookup" for="checkbox">Look Up</label> -->

<div  id = "lookup_box" class="box">
  <div id="panel2" class="panel panel-warning resizable draggable">
    <div class="panel-heading draggable-handler">
    </div>
    <div class="panel-body">
      <button type="button" class="box_btn cancel" onclick="closeBox();">Close</button>  
      <iframe src="https://www.bing.com/" width="500px" height="600px"></iframe>
    </div>
  </div>
</div>

<!--<label onclick="openNotepad();" id = "toolnote" class="notepad_btn">Notepad</label> -->

<div id="notepad" class = "box">
  <div id="panel2" class="panel panel-warning resizable draggable">
    <div class="panel-heading draggable-handler"></div>
    <div class="panel-body">
      <button type="button" class="box_btn cancel" onclick="closeNotepad();">Close</button> 
     <textarea  class = "notepad_box" placeholder="Start typing ..."></textarea>
    </div>
  </div>
</div>

<label onclick="openWeatherBox();" id = "weather" class="weather_popup">Weather</label>

<div id="weather_box" class = "box" >
  <div id="panel2" class="panel panel-warning resizable draggable">
    <div class="panel-heading draggable-handler"></div>
    <div class="panel-body">
      <button type="button" class="box_btn cancel" onclick="closeWeatherBox();">Close</button> 
     <script src="https://apps.elfsight.com/p/platform.js" defer></script>
     <div class = "weather_btn">
   </div>
    </div>
  </div>
</div>


<script>
  var d = document;

// not using this at the moment but might do later for graceful degradation...
function supports_html5_storage() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
  } catch (e) {
    return false;
  }
}

d.addEventListener('DOMContentLoaded', function(){

  var savedContent = localStorage.getItem("notepadcontent");
  if(savedContent != null){
    d.getElementById("notepad").value = savedContent;
  }
 
 
 d.getElementById("notepad").onkeyup = function(){
  var data = d.getElementById("notepad").value;  localStorage.setItem("notepadcontent", data);
  }
});
</script>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() { //jquery


  $( "#main_canvas_parent" ).append( $( "canvas" ) ).attr("id","bubble"); //bubble123 may not be relevant anymore

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

   /* $(function(){
  
  $("#post_text").on("keypress", function(){
 
    var length = $(this)[0].selectionStart;
 
    if(length >= 254) {
 
      $(this).attr('onkeypress', 'return false')
    }
 
    else
      $(this).removeAttr('onkeypress');
  });
});*/

		$(window).scroll(function() {
		//$('#load_more').on("click", function() {

			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
			//if (noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});


	</script>

  <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery


  $( "#main_canvas_parent" ).append( $( "canvas" ) ).attr("id","bubble"); //bubble123 may not be relevant anymore

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_blogposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.blogposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.blogposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.blogposts_area').find('.nextPage').val();
      var noMorePosts = $('.blogposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_blogposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.blogposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.blogposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.blogposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.blogposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

  <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_animalposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.animalposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.animalposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.animalposts_area').find('.nextPage').val();
      var noMorePosts = $('.animalposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_animalposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.animalposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.animalposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.animalposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.animalposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

    <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_healthposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.healthposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.healthposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.healthposts_area').find('.nextPage').val();
      var noMorePosts = $('.healthposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_healthposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.healthposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.healthposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.healthposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.healthposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>


<script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_foodposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.foodposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.foodposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.foodposts_area').find('.nextPage').val();
      var noMorePosts = $('.foodposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_foodposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.foodposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.foodposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.foodposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.foodposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

<script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_travelposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.travelposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.travelposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.travelposts_area').find('.nextPage').val();
      var noMorePosts = $('.travelposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_travelposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.travelposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.travelposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.travelposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.travelposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

  <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_businessposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.businessposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.businessposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.businessposts_area').find('.nextPage').val();
      var noMorePosts = $('.businessposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_businessposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.businessposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.businessposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.businessposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.businessposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

 <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_religionposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.religionposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.religionposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.religionposts_area').find('.nextPage').val();
      var noMorePosts = $('.religionposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_religionposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.religionposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.religionposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.religionposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.religionposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

    </script>

 <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_sportsposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.sportsposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.sportsposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.sportsposts_area').find('.nextPage').val();
      var noMorePosts = $('.sportsposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_sportsposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.sportsposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.sportsposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.sportsposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.sportsposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

   <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_entertainmentposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.entertainmentposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.entertainmentposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.entertainmentposts_area').find('.nextPage').val();
      var noMorePosts = $('.entertainmentposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_entertainmentposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.entertainmentposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.entertainmentposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.entertainmentposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.entertainmentposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

     <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_carsposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.carsposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.carsposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.carsposts_area').find('.nextPage').val();
      var noMorePosts = $('.carsposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_carsposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.carsposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.carsposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.carsposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.carsposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>


   <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_unexplainedposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.unexplainedposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.unexplainedposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.unexplainedposts_area').find('.nextPage').val();
      var noMorePosts = $('.unexplainedposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_unexplainedposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.unexplainedposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.unexplainedposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.unexplainedposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.unexplainedposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

       <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_gamesposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.gamesposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.gamesposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.gamesposts_area').find('.nextPage').val();
      var noMorePosts = $('.gamesposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_gamesposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.gamesposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.gamesposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.gamesposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.gamesposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

       <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_familyposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.familyposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.familyposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.familyposts_area').find('.nextPage').val();
      var noMorePosts = $('.familyposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_familyposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.familyposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.familyposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.familyposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.familyposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>

    <script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';

  $(document).ready(function() { //jquery

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_lifestyleposts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.lifestyleposts_area').html(data);
      }
    });


    $(window).scroll(function() {
    //$('#load_more').on("click", function() {

      var height = $('.lifestyleposts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.lifestyleposts_area').find('.nextPage').val();
      var noMorePosts = $('.lifestyleposts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
      //if (noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_lifestyleposts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.lifestyleposts_area').find('.nextPage').remove(); //Removes current .nextpage 
            $('.lifestyleposts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
            $('.lifestyleposts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

            $('#loading').hide();
            $('.lifestyleposts_area').append(response);
          }
        });

      } //End if 

      return false;

    }); //End (window).scroll(function())


  });


  </script>
	</div>

	</div>

</body>
</html>
<!-- start bubble script -->
<script>
	;(function() {

  "use strict";

  var lava0;
  var ge1doot = {
    screen: {
      elem:     null,
      callback: null,
      ctx:      null,
      width:    0,
      height:   0,
      left:     0,
      top:      0,
      init: function (id, callback, initRes) {
        this.elem = document.getElementById(id);
        this.callback = callback || null;
        if (this.elem.tagName == "CANVAS") this.ctx = this.elem.getContext("2d");
        window.addEventListener('resize', function () {
          this.resize();
        }.bind(this), false);
        this.elem.onselectstart = function () { return false; }
        this.elem.ondrag        = function () { return false; }
        initRes && this.resize();
        return this;
      },
      resize: function () {
        var o = this.elem;
        this.width  = o.offsetWidth;
        this.height = o.offsetHeight;
        for (this.left = 0, this.top = 0; o != null; o = o.offsetParent) {
          this.left += o.offsetLeft;
          this.top  += o.offsetTop;
        }
        if (this.ctx) {
          this.elem.width  = this.width;
          this.elem.height = this.height;
        }
        this.callback && this.callback();
      }
    }
  }

  // Point constructor
  var Point = function(x, y) {
    this.x = x;
    this.y = y;
    this.magnitude = x * x + y * y;
    this.computed = 0;
    this.force = 0;
  };
  Point.prototype.add = function(p) {
    return new Point(this.x + p.x, this.y + p.y);
  };

  // Ball constructor
  var Ball = function(parent) {
    var min = .1;
    var max = 1.5;
    this.vel = new Point(
      (Math.random() > 0.5 ? 1 : -1) * (0.2 + Math.random() * 0.25), (Math.random() > 0.5 ? 1 : -1) * (0.2 + Math.random())
    );
    this.pos = new Point(
      parent.width * 0.2 + Math.random() * parent.width * 0.6,
      parent.height * 0.2 + Math.random() * parent.height * 0.6
    );
    this.size = (parent.wh / 15) + ( Math.random() * (max - min) + min ) * (parent.wh / 15);
    this.width = parent.width;
    this.height = parent.height;
  };

  // move balls
  Ball.prototype.move = function() {

    // bounce borders
    if (this.pos.x >= this.width - this.size) {
      if (this.vel.x > 0) this.vel.x = -this.vel.x;
      this.pos.x = this.width - this.size;
    } else if (this.pos.x <= this.size) {
      if (this.vel.x < 0) this.vel.x = -this.vel.x;
      this.pos.x = this.size;
    }

    if (this.pos.y >= this.height - this.size) {
      if (this.vel.y > 0) this.vel.y = -this.vel.y;
      this.pos.y = this.height - this.size;
    } else if (this.pos.y <= this.size) {
      if (this.vel.y < 0) this.vel.y = -this.vel.y;
      this.pos.y = this.size;
    }

    // velocity
    this.pos = this.pos.add(this.vel);

  };

  // lavalamp constructor
  var LavaLamp = function(width, height, numBalls, c0, c1) {
    this.step = 5;
    this.width = width;
    this.height = height;
    this.wh = Math.min(width, height);
    this.sx = Math.floor(this.width / this.step);
    this.sy = Math.floor(this.height / this.step);
    this.paint = false;
    this.metaFill = createRadialGradient(width, height, width, c0, c1);
    this.plx = [0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 0];
    this.ply = [0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1];
    this.mscases = [0, 3, 0, 3, 1, 3, 0, 3, 2, 2, 0, 2, 1, 1, 0];
    this.ix = [1, 0, -1, 0, 0, 1, 0, -1, -1, 0, 1, 0, 0, 1, 1, 0, 0, 0, 1, 1];
    this.grid = [];
    this.balls = [];
    this.iter = 0;
    this.sign = 1;

    // init grid
    for (var i = 0; i < (this.sx + 2) * (this.sy + 2); i++) {
      this.grid[i] = new Point(
        (i % (this.sx + 2)) * this.step, (Math.floor(i / (this.sx + 2))) * this.step
      )
    }

    // create metaballs
    for (var k = 0; k < numBalls; k++) {
      this.balls[k] = new Ball(this);
    }
  };
  // compute cell force
  LavaLamp.prototype.computeForce = function(x, y, idx) {

    var force;
    var id = idx || x + y * (this.sx + 2);

    if (x === 0 || y === 0 || x === this.sx || y === this.sy) {
      force = 0.6 * this.sign;
    } else {
      force = 0;
      var cell = this.grid[id];
      var i = 0;
      var ball;
      while (ball = this.balls[i++]) {
        force += ball.size * ball.size / (-2 * cell.x * ball.pos.x - 2 * cell.y * ball.pos.y + ball.pos.magnitude + cell.magnitude);
      }
      force *= this.sign
    }
    this.grid[id].force = force;
    return force;
  };
  // compute cell
  LavaLamp.prototype.marchingSquares = function(next) {
    var x = next[0];
    var y = next[1];
    var pdir = next[2];
    var id = x + y * (this.sx + 2);
    if (this.grid[id].computed === this.iter) {
      return false;
    }
    var dir, mscase = 0;

    // neighbors force
    for (var i = 0; i < 4; i++) {
      var idn = (x + this.ix[i + 12]) + (y + this.ix[i + 16]) * (this.sx + 2);
      var force = this.grid[idn].force;
      if ((force > 0 && this.sign < 0) || (force < 0 && this.sign > 0) || !force) {
        // compute force if not in buffer
        force = this.computeForce(
          x + this.ix[i + 12],
          y + this.ix[i + 16],
          idn
        );
      }
      if (Math.abs(force) > 1) mscase += Math.pow(2, i);
    }
    if (mscase === 15) {
      // inside
      return [x, y - 1, false];
    } else {
      // ambiguous cases
      if (mscase === 5) dir = (pdir === 2) ? 3 : 1;
      else if (mscase === 10) dir = (pdir === 3) ? 0 : 2;
      else {
        // lookup
        dir = this.mscases[mscase];
        this.grid[id].computed = this.iter;
      }
      // draw line
      var ix = this.step / (
          Math.abs(Math.abs(this.grid[(x + this.plx[4 * dir + 2]) + (y + this.ply[4 * dir + 2]) * (this.sx + 2)].force) - 1) /
          Math.abs(Math.abs(this.grid[(x + this.plx[4 * dir + 3]) + (y + this.ply[4 * dir + 3]) * (this.sx + 2)].force) - 1) + 1
        );
      ctx.lineTo(
        this.grid[(x + this.plx[4 * dir]) + (y + this.ply[4 * dir]) * (this.sx + 2)].x + this.ix[dir] * ix,
        this.grid[(x + this.plx[4 * dir + 1]) + (y + this.ply[4 * dir + 1]) * (this.sx + 2)].y + this.ix[dir + 4] * ix
      );
      this.paint = true;
      // next
      return [
        x + this.ix[dir + 4],
        y + this.ix[dir + 8],
        dir
      ];
    }
  };

  LavaLamp.prototype.renderMetaballs = function() {
    var i = 0, ball;
    while (ball = this.balls[i++]) ball.move();
    // reset grid
    this.iter++;
    this.sign = -this.sign;
    this.paint = false;
    ctx.fillStyle = this.metaFill;
    ctx.beginPath();
    // compute metaballs
    i = 0;
    //ctx.shadowBlur = 50;
    //ctx.shadowColor = "green";
    while (ball = this.balls[i++]) {
      // first cell
      var next = [
        Math.round(ball.pos.x / this.step),
        Math.round(ball.pos.y / this.step), false
      ];
      // marching squares
      do {
        next = this.marchingSquares(next);
      } while (next);
      // fill and close path
      if (this.paint) {
        ctx.fill();
        ctx.closePath();
        ctx.beginPath();
        this.paint = false;
      }
    }
  };

  // gradients
  var createRadialGradient = function(w, h, r, c0, c1) {
    var gradient = ctx.createRadialGradient(
      w / 1, h / 1, 0,
      w / 1, h / 1, r
    );
    gradient.addColorStop(0, c0);
    gradient.addColorStop(1, c1);
    return gradient;
  };

  // main loop
  var run = function() {
    requestAnimationFrame(run);
    ctx.clearRect(0, 0, screen.width, screen.height);
    lava0.renderMetaballs();
  };
  // canvas
  var screen = ge1doot.screen.init("bubble", null, true),
      ctx = screen.ctx;
  screen.resize();
  // create LavaLamps
  lava0 = new LavaLamp(screen.width, screen.height, 6, "#FC575E", "#F7B42C");

  run();

})();
</script>

<!-- drag and resize internet script -->
<script type="text/javascript">
$('.draggable-handler').mousedown(function(e){
  drag = $(this).closest('.draggable')
  drag.addClass('dragging')
  drag.css('left', e.clientX-$(this).width()/2)
  drag.css('top', e.clientY-$(this).height()/2 - 10)
  $(this).on('mousemove', function(e){    
    drag.css('left', e.clientX-$(this).width()/2)
    drag.css('top', e.clientY-$(this).height()/2 - 10)
    window.getSelection().removeAllRanges()
  })
})

$('.draggable-handler').mouseleave(stopDragging)
$('.draggable-handler').mouseup(stopDragging)

function stopDragging(){
  drag = $(this).closest('.draggable')
  drag.removeClass('dragging')
  $(this).off('mousemove')
}

// setTimeout(function(
//           $("")
//           ){}, 4000);

$(document).on('click', 'a#check-iframe-content-url', function(){
  // blocked by CORS
  alert($("#iframe-source").contents().find('.primary'));
});
</script>
  <!-- post paramaters-->
  <script>

    $(".char-textarea").on("keyup",function(event){
  checkTextAreaMaxLength(this,event);
});

/*
Checks the MaxLength of the Textarea
-----------------------------------------------------
@prerequisite:  textBox = textarea dom element
        e = textarea event
                length = Max length of characters
*/
function checkTextAreaMaxLength(textBox, e) { 
    
    var maxLength = parseInt($(textBox).data("length"));
    
  
    if (!checkSpecialKeys(e)) { 
        if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
   } 
  $(".char-count").html(maxLength - textBox.value.length);
    
    return true; 
} 
/*
Checks if the keyCode pressed is inside special chars
-------------------------------------------------------
@prerequisite:  e = e.keyCode object for the key pressed
*/
function checkSpecialKeys(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
        return false; 
    else 
        return true; 
}

  </script>

  <!--<script>
  function NoRefresh()
  {
    if ( window.history.replaceState ) 
        {
  window.history.replaceState( null, null, window.location.href );
        }
  }
</script> -->
