<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Welcome to Tethyr!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css'><link rel="stylesheet" href="./register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>


	<?php  

	if(isset($_POST['register_button'])) {
		echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});

		</script>

		';
	}


	?>

	<div class="wrapper">

		<div class="login_box">

			<div class="login_header">
				
				<h1>Tethyr!</h1>
				Login or sign up below!
			</div>
			<br>
			<div id="first">

				<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Password">
					<br>
					<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>"; ?>
					<input type="submit" name="login_button" value="Login">
					<br>
					<a href="#" id="signup" class="signup">Need an account? Register here!</a>
				    <?php if(isset($_GET['reg'])) echo "<div style='color: #14C800;'>You are all set! Go ahead and login!</div>"; ?>

				</form>

			</div>

			<div id="second">

				<form action="register.php" method="POST">
					<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
					
					


					<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>

					<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
					else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
					else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>

					<input type="password" name="reg_password" placeholder="Password" required>
					<br>
					<input type="password" name="reg_password2" placeholder="Confirm Password" required>
					<br>
					<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
					else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
					else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>


					<input type="submit" name="register_button" value="Register">
					<br>

					<?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
					<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>

				</form>

			</div>


		</div>

	</div>

	<div class="main"></div>

<div class="footer">
  <div class="bubbles">
    <div class="bubble" style="--size:4.115247921471865rem; --distance:9.733237780351937rem; --position:30.875775257406218%; --time:3.824738342322748s; --delay:-2.403767713585019s;"></div>
    <div class="bubble" style="--size:3.94731361907213rem; --distance:7.965771769649667rem; --position:64.74912883532299%; --time:3.1802077969080687s; --delay:-2.853333794018452s;"></div>
    <div class="bubble" style="--size:5.970396526518048rem; --distance:6.799849808332633rem; --position:47.461787311638794%; --time:2.906804618620112s; --delay:-3.026176345870497s;"></div>
    <div class="bubble" style="--size:2.721910404915869rem; --distance:6.56844689146422rem; --position:-1.646750467602407%; --time:2.395396725452613s; --delay:-3.358258627860375s;"></div>
    <div class="bubble" style="--size:4.972533288371916rem; --distance:9.483668709311678rem; --position:103.79859303076157%; --time:2.2161319781242104s; --delay:-2.004518723153265s;"></div>
    <div class="bubble" style="--size:2.129363573107753rem; --distance:9.6195292164718rem; --position:14.172192097005233%; --time:2.267125108313594s; --delay:-2.7046352220865746s;"></div>
    <div class="bubble" style="--size:3.6492958395863093rem; --distance:6.4919734834914795rem; --position:70.96095266058767%; --time:2.8857416798562894s; --delay:-2.554999953708857s;"></div>
    <div class="bubble" style="--size:3.530429049681093rem; --distance:6.560764799092362rem; --position:94.55829276689713%; --time:2.414178357762448s; --delay:-2.271916136605826s;"></div>
    <div class="bubble" style="--size:3.6821839742261506rem; --distance:7.243123544217773rem; --position:84.05404462219568%; --time:3.1354444190872024s; --delay:-3.615331307832036s;"></div>
    <div class="bubble" style="--size:4.706570600489132rem; --distance:9.616642245182394rem; --position:-1.3771390544089712%; --time:3.7064208524223665s; --delay:-3.876374038085482s;"></div>
    <div class="bubble" style="--size:3.3495767043903646rem; --distance:9.36221620694185rem; --position:29.88942140206384%; --time:2.4350055919020295s; --delay:-3.1797053679933693s;"></div>
    <div class="bubble" style="--size:3.753860862123682rem; --distance:8.96058051711229rem; --position:46.44021753410172%; --time:2.5849467516634337s; --delay:-2.0848918479934855s;"></div>
    <div class="bubble" style="--size:2.7171842714619086rem; --distance:9.909727031386883rem; --position:39.57711050365091%; --time:3.0230400855233515s; --delay:-2.5351215910138563s;"></div>
    <div class="bubble" style="--size:2.552216481153888rem; --distance:9.407863969355173rem; --position:0.06993939889577305%; --time:3.7113652330319606s; --delay:-2.8752523966058288s;"></div>
    <div class="bubble" style="--size:4.968161148836284rem; --distance:6.867517937870169rem; --position:62.48694182527062%; --time:2.722621432464071s; --delay:-3.244310943600138s;"></div>
    <div class="bubble" style="--size:5.116145618883845rem; --distance:7.9916072624994525rem; --position:90.32389804390594%; --time:2.4066378088996996s; --delay:-2.3108367455333876s;"></div>
    <div class="bubble" style="--size:2.504294968236457rem; --distance:8.941603056708892rem; --position:-0.8146960337857445%; --time:2.0283138066340283s; --delay:-2.158787278871151s;"></div>
    <div class="bubble" style="--size:2.8526106502234523rem; --distance:9.938956675743743rem; --position:3.7376899415660176%; --time:3.3503275556354404s; --delay:-3.0073860217237773s;"></div>
    <div class="bubble" style="--size:4.132604905120431rem; --distance:9.07017841367152rem; --position:32.81987054375311%; --time:2.9273545544507766s; --delay:-3.1609455888906806s;"></div>
    <div class="bubble" style="--size:2.044477404928964rem; --distance:7.447519203451691rem; --position:6.429444504315377%; --time:2.915689754329412s; --delay:-3.023875695312355s;"></div>
    <div class="bubble" style="--size:2.0089382951337997rem; --distance:9.654759128548708rem; --position:6.411383728457578%; --time:2.409765667378125s; --delay:-2.8858178552470637s;"></div>
    <div class="bubble" style="--size:5.3409297778316756rem; --distance:6.882013612900061rem; --position:82.97695687140785%; --time:3.3312879490336735s; --delay:-2.597114125931425s;"></div>
    <div class="bubble" style="--size:2.401371001687153rem; --distance:8.33989139652855rem; --position:101.13358394736993%; --time:2.336947271489716s; --delay:-2.7267044793322004s;"></div>
    <div class="bubble" style="--size:2.0517284672973366rem; --distance:9.522578118797574rem; --position:58.93893016722215%; --time:2.583679973185796s; --delay:-2.6616946559284806s;"></div>
    <div class="bubble" style="--size:5.963113255156876rem; --distance:9.525746957779544rem; --position:81.93130756594813%; --time:3.0489062496612243s; --delay:-3.0005847923515496s;"></div>
    <div class="bubble" style="--size:3.8998868461211256rem; --distance:8.027984366392651rem; --position:8.58927246133274%; --time:3.437251606598925s; --delay:-2.4110862284789594s;"></div>
    <div class="bubble" style="--size:3.6262216185998284rem; --distance:9.537022469250807rem; --position:87.4168718003936%; --time:3.2794884653286043s; --delay:-3.2475759791073813s;"></div>
    <div class="bubble" style="--size:4.080307352044018rem; --distance:8.756773313490289rem; --position:82.57439844119449%; --time:3.716704279289957s; --delay:-3.672192519973169s;"></div>
    <div class="bubble" style="--size:4.9750197898842785rem; --distance:9.703158627121638rem; --position:54.07446309580588%; --time:2.129494060676738s; --delay:-3.653040001629552s;"></div>
    <div class="bubble" style="--size:5.76681337149454rem; --distance:9.529364949824526rem; --position:77.44047585416116%; --time:2.894243281608108s; --delay:-2.7872258810445856s;"></div>
    <div class="bubble" style="--size:4.173959548755574rem; --distance:9.135843350203968rem; --position:0.6434027926529984%; --time:3.732499622104941s; --delay:-2.2521624422152375s;"></div>
    <div class="bubble" style="--size:2.5350069398529236rem; --distance:9.390036513192538rem; --position:91.34964723304701%; --time:2.2706980951303124s; --delay:-2.021774947950785s;"></div>
    <div class="bubble" style="--size:3.1929690469274687rem; --distance:7.335052065327721rem; --position:68.25485671202922%; --time:2.7026497488642134s; --delay:-3.224007948446216s;"></div>
    <div class="bubble" style="--size:5.8972760367959545rem; --distance:9.919482050640319rem; --position:69.15165606250125%; --time:2.3728185835728026s; --delay:-3.0228035466344947s;"></div>
    <div class="bubble" style="--size:5.03821059899845rem; --distance:9.201938890775686rem; --position:59.835416736952624%; --time:3.4325823609893407s; --delay:-2.223233995202099s;"></div>
    <div class="bubble" style="--size:5.1242208019967315rem; --distance:9.30618378658632rem; --position:74.37227776775471%; --time:2.425691691566182s; --delay:-2.3371140117645517s;"></div>
    <div class="bubble" style="--size:4.261393334492603rem; --distance:7.263041934535704rem; --position:63.764730861655735%; --time:2.1180012224057614s; --delay:-3.202128699796544s;"></div>
    <div class="bubble" style="--size:4.862227979894856rem; --distance:6.97049668604033rem; --position:36.95559739342971%; --time:3.9507896062410945s; --delay:-2.8254468308274636s;"></div>
    <div class="bubble" style="--size:2.428078911257491rem; --distance:6.669857189199806rem; --position:104.5316528184236%; --time:3.0944779740010477s; --delay:-2.0558394099158845s;"></div>
    <div class="bubble" style="--size:3.7519826797241134rem; --distance:8.803337463033102rem; --position:38.214221254192175%; --time:2.199833108518145s; --delay:-3.1202509276418153s;"></div>
    <div class="bubble" style="--size:5.616232606584667rem; --distance:9.606512335631752rem; --position:7.446055722942669%; --time:2.2911483937718846s; --delay:-3.5719537590871466s;"></div>
    <div class="bubble" style="--size:4.169935894328392rem; --distance:6.074390543792458rem; --position:20.357000569078025%; --time:3.1205686784204745s; --delay:-2.8006853629539097s;"></div>
    <div class="bubble" style="--size:4.673150185542932rem; --distance:6.867057312436494rem; --position:50.98207508862656%; --time:2.802522141070182s; --delay:-2.3378228692368506s;"></div>
    <div class="bubble" style="--size:2.3020240642415013rem; --distance:6.676794564766999rem; --position:-3.9475589843916037%; --time:3.4904204829565786s; --delay:-3.9543309868996293s;"></div>
    <div class="bubble" style="--size:3.1713485980208116rem; --distance:8.255260528112917rem; --position:85.30509396445889%; --time:2.6720183086308884s; --delay:-3.99724065842484s;"></div>
    <div class="bubble" style="--size:2.8636348822963393rem; --distance:8.5378610688234rem; --position:57.654831664227885%; --time:3.2610827859897995s; --delay:-3.2123011756594058s;"></div>
    <div class="bubble" style="--size:4.043544159379678rem; --distance:6.940226148416648rem; --position:55.28097054714091%; --time:3.68552503720987s; --delay:-3.488875602744239s;"></div>
    <div class="bubble" style="--size:4.499123556289485rem; --distance:6.08651120387131rem; --position:84.23574410459892%; --time:3.424956199018158s; --delay:-2.118481344234117s;"></div>
    <div class="bubble" style="--size:4.494591244868551rem; --distance:6.386261716876474rem; --position:25.873295406404374%; --time:3.7347174896064272s; --delay:-2.0100342264414537s;"></div>
    <div class="bubble" style="--size:2.5933103463271543rem; --distance:9.78758232079904rem; --position:15.01399839089386%; --time:2.2870809960121767s; --delay:-3.7710981151312066s;"></div>
    <div class="bubble" style="--size:3.4884670252153613rem; --distance:9.848416469499814rem; --position:81.2807121285826%; --time:2.9596462886170465s; --delay:-2.0399021422565538s;"></div>
    <div class="bubble" style="--size:4.378177121238019rem; --distance:8.849385342470335rem; --position:103.18842074795546%; --time:2.5281367432807977s; --delay:-2.5609071251050812s;"></div>
    <div class="bubble" style="--size:5.942375168422022rem; --distance:9.361875736479963rem; --position:59.93587744043097%; --time:3.7474376257570814s; --delay:-2.5838956852045407s;"></div>
    <div class="bubble" style="--size:4.6000338559365375rem; --distance:8.377306679251454rem; --position:78.1961834362449%; --time:3.637006886486502s; --delay:-2.3376865938150306s;"></div>
    <div class="bubble" style="--size:3.4127667562177475rem; --distance:6.439461435100819rem; --position:-3.3341705876576055%; --time:3.6544806473186804s; --delay:-3.079573238302622s;"></div>
    <div class="bubble" style="--size:3.940657686172065rem; --distance:6.047042826409211rem; --position:48.79827032901164%; --time:3.62502424252403s; --delay:-3.778557612165335s;"></div>
    <div class="bubble" style="--size:3.5774971681140215rem; --distance:8.738347128173013rem; --position:24.516068870449082%; --time:3.1000381477581187s; --delay:-2.5233634808204335s;"></div>
    <div class="bubble" style="--size:4.146906031914578rem; --distance:8.825521229404572rem; --position:91.89067421879055%; --time:2.0584040459399238s; --delay:-3.0531123585839572s;"></div>
    <div class="bubble" style="--size:5.5771743753395615rem; --distance:9.910619066065298rem; --position:79.41649246190457%; --time:2.2613148980326736s; --delay:-2.801585320023605s;"></div>
    <div class="bubble" style="--size:5.9983447642034555rem; --distance:9.25553383145866rem; --position:29.32555573056068%; --time:2.1015416563286453s; --delay:-2.2742045819935677s;"></div>
    <div class="bubble" style="--size:4.672371158247332rem; --distance:9.068841122954025rem; --position:93.32655907156699%; --time:2.574296397043356s; --delay:-2.2264522103079987s;"></div>
    <div class="bubble" style="--size:4.484119317531071rem; --distance:6.840946063092901rem; --position:6.869090310584767%; --time:3.715234031674111s; --delay:-3.7184212467652813s;"></div>
    <div class="bubble" style="--size:4.546456162823704rem; --distance:6.621572194242258rem; --position:39.32362522509018%; --time:2.881265685128077s; --delay:-2.937485545953344s;"></div>
    <div class="bubble" style="--size:4.429326825373269rem; --distance:8.175623133258776rem; --position:3.0367745480368527%; --time:2.464557084253404s; --delay:-3.801333143669356s;"></div>
    <div class="bubble" style="--size:2.5337991710777006rem; --distance:8.04770339971693rem; --position:51.910136466364264%; --time:2.4178581703598527s; --delay:-2.2776616984204665s;"></div>
    <div class="bubble" style="--size:4.985436279147603rem; --distance:7.120169094149777rem; --position:78.66617023474895%; --time:2.4704675015457838s; --delay:-2.028555152156538s;"></div>
    <div class="bubble" style="--size:4.970968964944014rem; --distance:6.262316072901663rem; --position:27.8198596651076%; --time:2.7980430671553997s; --delay:-2.8354459411086457s;"></div>
    <div class="bubble" style="--size:2.347361614829672rem; --distance:9.50463181104777rem; --position:104.59353614778983%; --time:2.4431107416235274s; --delay:-2.1829669036127677s;"></div>
    <div class="bubble" style="--size:4.569117806275843rem; --distance:9.965806154130561rem; --position:37.864609371078735%; --time:3.452782668154096s; --delay:-2.8850723910122205s;"></div>
    <div class="bubble" style="--size:2.028342622208492rem; --distance:8.148628698845911rem; --position:5.866309684474523%; --time:3.0105602904825526s; --delay:-2.640331933179606s;"></div>
    <div class="bubble" style="--size:2.874265624908282rem; --distance:8.929499561849607rem; --position:99.88274119118003%; --time:3.7825712368384865s; --delay:-3.5721337432326576s;"></div>
    <div class="bubble" style="--size:5.468031855102132rem; --distance:6.050004050112652rem; --position:69.72576731365642%; --time:3.4555492592776833s; --delay:-2.4191563446140867s;"></div>
    <div class="bubble" style="--size:2.445241726171238rem; --distance:7.900240570813456rem; --position:74.47570264299195%; --time:2.070274779183877s; --delay:-2.140873344617225s;"></div>
    <div class="bubble" style="--size:3.4647566215753365rem; --distance:8.316310814647116rem; --position:15.381703301203387%; --time:2.6060865562761024s; --delay:-3.3444215794334315s;"></div>
    <div class="bubble" style="--size:5.041816776963507rem; --distance:6.645046844986729rem; --position:72.5983442083072%; --time:3.3222721113111873s; --delay:-2.3977423154235322s;"></div>
    <div class="bubble" style="--size:3.681752651992327rem; --distance:8.876053753028906rem; --position:101.68832169726389%; --time:3.165874679925596s; --delay:-2.041127301934604s;"></div>
    <div class="bubble" style="--size:4.099294703703703rem; --distance:9.515788737885474rem; --position:81.07939186296373%; --time:3.022916953751552s; --delay:-2.5096836197446546s;"></div>
    <div class="bubble" style="--size:2.992785447000962rem; --distance:9.190762852331826rem; --position:26.630598303776765%; --time:2.108079083716145s; --delay:-2.943957862076221s;"></div>
    <div class="bubble" style="--size:2.681070503899016rem; --distance:7.384158156485269rem; --position:67.40489891985005%; --time:3.4713183159614274s; --delay:-3.3208457806790372s;"></div>
    <div class="bubble" style="--size:5.248682429426107rem; --distance:7.216393074269996rem; --position:42.55169769088021%; --time:2.1328275673563764s; --delay:-3.0270688504563674s;"></div>
    <div class="bubble" style="--size:2.9400647550123677rem; --distance:9.065367451769758rem; --position:69.54139670568303%; --time:2.6194355842782864s; --delay:-3.941355968177644s;"></div>
    <div class="bubble" style="--size:5.796948083142334rem; --distance:6.16549396870031rem; --position:96.72350753498324%; --time:2.939797072093913s; --delay:-2.305298734347333s;"></div>
    <div class="bubble" style="--size:3.7286435104721702rem; --distance:7.903972715929161rem; --position:103.29785003264567%; --time:3.9303053494338585s; --delay:-2.661905377770498s;"></div>
    <div class="bubble" style="--size:4.361439802777907rem; --distance:6.0005005664486rem; --position:41.390369970297094%; --time:3.504220406949639s; --delay:-2.1101826777699046s;"></div>
    <div class="bubble" style="--size:4.7975704625368865rem; --distance:6.628264228145503rem; --position:26.497095874281527%; --time:3.7011656097889345s; --delay:-2.97360752190362s;"></div>
    <div class="bubble" style="--size:5.110166255706783rem; --distance:9.59301346238085rem; --position:80.55534586668404%; --time:2.6477011293479906s; --delay:-3.697407555531347s;"></div>
    <div class="bubble" style="--size:2.9398568710721786rem; --distance:7.97739324642145rem; --position:95.21298993191758%; --time:2.5009917836459277s; --delay:-2.798308803902776s;"></div>
    <div class="bubble" style="--size:4.907057575908199rem; --distance:8.985214418138138rem; --position:74.67403542562322%; --time:2.1899555010673253s; --delay:-3.787872856386305s;"></div>
    <div class="bubble" style="--size:3.8680136408985915rem; --distance:6.420017022095954rem; --position:0.29704949698575067%; --time:3.4850808760576206s; --delay:-3.7615142643838655s;"></div>
    <div class="bubble" style="--size:3.2749262134759185rem; --distance:7.394270855662712rem; --position:102.67178226435905%; --time:2.229692636791137s; --delay:-3.625401787456824s;"></div>
    <div class="bubble" style="--size:2.1221579513126585rem; --distance:6.2249068500892015rem; --position:73.06645760856003%; --time:2.9530665298953593s; --delay:-2.4615769304949016s;"></div>
    <div class="bubble" style="--size:2.2144037770489584rem; --distance:7.782343992481818rem; --position:17.267068965814314%; --time:2.6674554540539193s; --delay:-3.955022480816762s;"></div>
    <div class="bubble" style="--size:5.936333337316403rem; --distance:6.042576796225013rem; --position:75.87495920829609%; --time:2.7593109307309525s; --delay:-2.370619284421313s;"></div>
    <div class="bubble" style="--size:5.465349472193461rem; --distance:8.746762449756462rem; --position:12.251312581674938%; --time:3.7731696116808737s; --delay:-3.0102155912896893s;"></div>
    <div class="bubble" style="--size:2.6691371377861284rem; --distance:7.755306176456555rem; --position:26.8763276531095%; --time:2.0086422519619416s; --delay:-2.7351210314525627s;"></div>
    <div class="bubble" style="--size:3.402234090007191rem; --distance:9.680638276344958rem; --position:96.58709651733737%; --time:2.4948163560549523s; --delay:-3.861462888750241s;"></div>
    <div class="bubble" style="--size:5.841497012946574rem; --distance:7.023150136492275rem; --position:-3.502732634286194%; --time:3.8163873352750888s; --delay:-2.078380555886728s;"></div>
    <div class="bubble" style="--size:5.348582841866168rem; --distance:8.641202191461483rem; --position:56.47680917585916%; --time:2.6293402822543155s; --delay:-3.6784396258136773s;"></div>
    <div class="bubble" style="--size:3.5833076891544273rem; --distance:9.420743184970686rem; --position:9.371486691503979%; --time:2.2887518102456506s; --delay:-2.3011212675362747s;"></div>
    <div class="bubble" style="--size:5.714404371953114rem; --distance:9.385526912427576rem; --position:99.40161536983477%; --time:2.9953962166250268s; --delay:-2.7573025054252605s;"></div>
    <div class="bubble" style="--size:2.546616191958515rem; --distance:6.343407794708072rem; --position:68.58573641060207%; --time:2.603357541847359s; --delay:-3.156855689741648s;"></div>
    <div class="bubble" style="--size:5.1811910023809435rem; --distance:7.878798081928365rem; --position:35.99995991607153%; --time:3.462598469469456s; --delay:-3.640652707188345s;"></div>
    <div class="bubble" style="--size:4.655601860517449rem; --distance:8.836072829490252rem; --position:102.10852485686738%; --time:3.8373529090649647s; --delay:-3.723240091436396s;"></div>
    <div class="bubble" style="--size:3.7353231174844135rem; --distance:8.73751311876989rem; --position:15.114391168831183%; --time:2.8433856759545044s; --delay:-3.895336322142695s;"></div>
    <div class="bubble" style="--size:2.3932063584536873rem; --distance:9.474034886623766rem; --position:100.03585838543043%; --time:2.0353835063416095s; --delay:-2.128854722290974s;"></div>
    <div class="bubble" style="--size:5.987484894312848rem; --distance:6.655976188771319rem; --position:97.19330971262691%; --time:3.719294809033526s; --delay:-3.8990125086565834s;"></div>
    <div class="bubble" style="--size:2.886317297310317rem; --distance:8.161431912327116rem; --position:30.62335804313352%; --time:2.2494456240633625s; --delay:-3.2583477311846574s;"></div>
    <div class="bubble" style="--size:3.7650355362153674rem; --distance:7.018800528397649rem; --position:45.57597153396459%; --time:2.0610464097134917s; --delay:-2.7737176580611727s;"></div>
    <div class="bubble" style="--size:4.675560384793347rem; --distance:8.350391563682797rem; --position:46.77402969917725%; --time:2.3191523019171805s; --delay:-2.515512244177834s;"></div>
    <div class="bubble" style="--size:3.098297684329834rem; --distance:6.709742149066354rem; --position:10.558670041289513%; --time:3.3492354507698554s; --delay:-2.093177440966723s;"></div>
    <div class="bubble" style="--size:3.4070496509359627rem; --distance:9.206754022943446rem; --position:51.79995991880745%; --time:3.781575840903754s; --delay:-3.5137833673264836s;"></div>
    <div class="bubble" style="--size:5.6800903348449rem; --distance:6.3471566372535255rem; --position:20.857997321184165%; --time:2.8844834223154447s; --delay:-2.02624895642204s;"></div>
    <div class="bubble" style="--size:3.7577222196092057rem; --distance:9.191629289425565rem; --position:31.444784412890236%; --time:3.1854920528603103s; --delay:-3.0789342610731123s;"></div>
    <div class="bubble" style="--size:5.857009849492944rem; --distance:8.809438614278932rem; --position:3.401307727204479%; --time:2.4352094158100246s; --delay:-3.4982830546724504s;"></div>
    <div class="bubble" style="--size:5.471028488757742rem; --distance:6.753310832812757rem; --position:49.91588743674439%; --time:3.781792562375773s; --delay:-3.70568019297143s;"></div>
    <div class="bubble" style="--size:4.262362328422841rem; --distance:6.7166945473820325rem; --position:77.02062746327411%; --time:3.7901011613374402s; --delay:-2.7155258658680337s;"></div>
    <div class="bubble" style="--size:4.30578669374563rem; --distance:6.826795095447139rem; --position:62.575705650164096%; --time:2.743892660924282s; --delay:-3.883913326396578s;"></div>
    <div class="bubble" style="--size:2.827813437044811rem; --distance:9.033315196627989rem; --position:35.924110770735574%; --time:3.9117918998593817s; --delay:-2.473449609307484s;"></div>
    <div class="bubble" style="--size:3.5401743254493763rem; --distance:8.657267071505387rem; --position:100.11923144417588%; --time:3.648301493664546s; --delay:-2.973400200512867s;"></div>
    <div class="bubble" style="--size:2.143136336079629rem; --distance:6.2171523428164rem; --position:70.50885363519099%; --time:3.577275614935906s; --delay:-2.812688125621186s;"></div>
    <div class="bubble" style="--size:3.8619860835067223rem; --distance:8.710227344830837rem; --position:10.429148351980928%; --time:3.078732733205809s; --delay:-3.590756746380803s;"></div>
    <div class="bubble" style="--size:5.65221960880329rem; --distance:8.325239522271369rem; --position:8.88710141934174%; --time:3.1744981136461354s; --delay:-3.888181514732186s;"></div>
    <div class="bubble" style="--size:2.94122331548106rem; --distance:6.476307309999167rem; --position:79.45504536238045%; --time:2.9803072582501273s; --delay:-3.608395684662448s;"></div>
    <div class="bubble" style="--size:3.913360973481881rem; --distance:7.090899919119673rem; --position:91.81258628190182%; --time:2.089923544891227s; --delay:-3.48948367351345s;"></div>
    <div class="bubble" style="--size:2.6168411120302837rem; --distance:9.484998834954293rem; --position:75.7943271899149%; --time:2.8142236231487954s; --delay:-2.3380440807352025s;"></div>
    <div class="bubble" style="--size:3.7457729220032654rem; --distance:9.578658405626989rem; --position:0.16471479961778446%; --time:3.9312889857454953s; --delay:-2.6890968410493743s;"></div>
    <div class="bubble" style="--size:5.8529912710006995rem; --distance:8.147853448674221rem; --position:50.16435859042864%; --time:2.6784718928963063s; --delay:-3.9752602972330116s;"></div>
    <div class="bubble" style="--size:4.595054648993362rem; --distance:8.970459410659508rem; --position:14.715273758005566%; --time:3.6780291248283112s; --delay:-2.57711760975201s;"></div>
  </div>
  <div class="content">
  <div>

    </div>
    <div><a class="image" href="https://codepen.io/z-" target="_blank" ></a>
      <p>©2019 Not Really</p>
    </div>
  </div>
</div>
<svg style="position:fixed; top:100vh">
  <defs>
    <filter id="blob">
    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
      <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="blob"></feColorMatrix>
      <feComposite in="SourceGraphic" in2="blob" operator="atop"></feComposite>
    </filter>
  </defs>
</svg>
<!-- end paste-->
</div>
</body>
</html>