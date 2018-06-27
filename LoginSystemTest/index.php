<?php
	include_once 'header.php';
?>
<section class="main-container">
<html>
<head>
<!-- Local Style -->
<style> 
div.gallery {
    border: 2px solid #ccc;
}

div.gallery:hover {
    border: 1px solid #777;
}

div.gallery img {
    width: 100%;
    height: auto;
}

div.desc {
    padding: 10px;
    text-align: center;
}

* {
    box-sizing: border-box;
}

.responsive {
    padding: 0 1px;
    float: left;
    width: 24.99999%;
}

@media only screen and (max-width: 700px) {
    .responsive {
        width: 49.99999%;
        margin: 6px 0;
    }
}

@media only screen and (max-width: 500px) {
    .responsive {
        width: 100%;
    }
}

.clearfix:after {
    content: "";
    display: table;
    clear: both;
}
.flex-container {
    display: -webkit-flex;
    display: flex;  
    -webkit-flex-flow: row wrap;
    flex-flow: row wrap;
    text-align: center;
	padding-left: 9em;
	
}

.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
	padding-left: 4em;

}

.article {
    text-align: middle;
	padding-left: 4em;
}

header {background: MediumSeaGreen;color:white;}
footer {background: #aaa;color:white;}

h1 { font-size: 4em }
h3 { font-size: 2em }
@media all and (min-width: 768px) {
   
    .article {-webkit-flex:5 0px;flex:5 0px;-webkit-order:2;order:2;}
    footer {-webkit-order:3;order:3;}
}
</style>
</head>
<body>

<div class="flex-container">
<!-- Main Conent of the webpage -->
<article class="article">
 
<H2>Welcome</H2>

<H3> Popular Titles </H3>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="http://localhost/loginsystemtest/bookID1.php">
     <img src="/LoginSystemTest/BookCovers/cats.jpg" alt="" style="width:160px;height:180px;">
    </a>
    <div class="desc">Girls<br>Author: Meister,Cari</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="http://localhost/loginsystemtest/bookID2.php">
     <img src="/LoginSystemTest/BookCovers/fire trucks.jpg" alt="" style="width:160px;height:180px;">
    </a>
    <div class="desc">Boys<br>Author: Joanne, Mattern </div>
  </div>
</div>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="http://localhost/loginsystemtest/bookID3.php">
     <img src="/LoginSystemTest/BookCovers/The great alone.jpg" alt="" style="width:160px;height:180px;">
    </a>
    <div class="desc">Adventure<br>Author: Kristin, Hannah</div>
  </div>
</div>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="http://localhost/loginsystemtest/bookID4.php">
     <img src="/LoginSystemTest/BookCovers/Still me.jpg" alt="" style="width:160px;height:180px;">
    </a>
    <div class="desc">Romance<br>Author:  Jojo, Moyes</div>
  </div><br>
</div>
<br>
<br>
<br>
  <H3> News </H3>
  <P> Author James Petterson will be visiting the library for a book reading / signing on April 30th 2018 at 9am. </p>
  <br>
<a class="weatherwidget-io" href="https://forecast7.com/en/45d09n93d01/55110/?unit=us" data-label_1="SAINT PAUL" data-label_2="WEATHER" data-icons="Climacons Animated" data-theme="original" data-basecolor="#1e7b46" >SAINT PAUL WEATHER</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
</article>



<!-- Bottom of the webpage -->
<footer>Sp18 CSCI 2050-90 - Riley Stephens <br> Hours <br> Monday: 8-5 Tuesday: 8-5 Wednesday: 8-5 Thursday: 8-9 Friday: Closed Saturday-Sunday: 11-4</footer>
</div>

</body>
</html>


	<div class="main-wrapper">

		<?php
			include($_SERVER["DOCUMENT_ROOT"] . "\LoginSystemTest\Includes\sideBarLogic.inc.php");
		?>
	</div>
</section>

<?php
	include_once 'footer.php';
?>

