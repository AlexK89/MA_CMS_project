<?php
/**
 * Created by PhpStorm.
 * User: alexandrk
 * Date: 04/10/2017
 * Time: 10:17
 */

include("../php_functions/home_functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vasile Cojusco | Software engineer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<nav>
		<div class="container hover">
			<div class="toggle"><a class="toggle_ancher" onclick="toggle_menu(event)"><i class="fa fa-bars fa-3x" aria-hidden="true"></i></a></div>
			<ul id="menu">
				<li><a href="#">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="portfolio.php">Portfolio</a></li>
				<li><a href="contact.html">Contact</a></li>
			</ul>
		</div>
	</nav>
	<section class="header">
		<div class="header_background"></div>
		<div class="container header_content">
			<div class="header_text">
				<h4>I am here because of you ...</h4>
				<h1>Software engineer is here to help</h1>
				<a class="button" id="smooth_scroll" href="#info_scroll">More details</a>
			</div>
		</div>
	</section>
	<section class="info" id="info_scroll">
		<h4>You should know</h4>
		<h2>Some cool text, which inspire you</h2>
		<p>some ipsum text, some ipsum text, some ipsum text, some ipsum text</p>
		<a class="button" href="about.php">Click on me</a>
	</section>
	<section class="principles">
		<div class="container">

            <?php
            $data = get_items($table_name);
            $block_structure= "";
            $counter = 1;
            foreach ($data as $item) {
                $label = $item["label"];
                $description = $item["description"];
                $img_url = $item["img_url"];

                $block_structure .=  "<div class=\"principles_row\">";
                $block_structure .= "<div class=\"principles_row_block\">";
                $block_structure .= "<div class=\"principles_row_img inline_block\">";
                $block_structure .= "<img src=\"./img/" . $img_url . "\" alt=\"" . $img_url . "\">";
                $block_structure .= "</div></div>";
                $block_structure .= "<div class=\"principles_row_description inline_block\">";
                $block_structure .= "<h4>Thing #" . $counter . "</h4>";
                $block_structure .= "<h2>" . $label . "</h2>";
                $block_structure .= "<p>" . $description . "</p>";
                $block_structure .= "</div></div>";

                $counter++;
            }
            echo $block_structure;
            ?>
        </div>
	</section>
	<section class="statistics">
		<div class="statistics_background"></div>
		<div class="filter"></div>
		<div class="container">
			<div class="statistics_left">
				<div class="statistics_left_number">
					<p class="statistics_left_number_name">Rate of success</p>
					<h1>99.99%</h1>
					<p class="statistics_left_number_comment">just because I can do better</p>
				</div>
				<div class="statistics_left_number">
					<p class="statistics_left_number_name">Projects done</p>
					<h1>7</h1>
				</div>
			</div>
			<div class="statistics_right">
				<p>at least you want to check ...</p>
				<h1>Projects in details</h1>
				<a class="button" href="portfolio.php">Let me check</a>
			</div>
		</div>
	</section>
	<section class="promissess">
		<div class="container">
			<header>
				<h2>Satisfaction of my clients meaning a lot to me</h2>
				<p>Cooperating with me, you definitely get ...</p>
			</header>
			<div class="body">
				<div class="satisfaction_type">
					<p><img src="./img/calendar.png"></p>
					<h4>Timing</h4>
					<p>Deadline metters. Get your product in time.</p>
				</div>
				<div class="satisfaction_type">
					<p><img src="./img/equipment.png"></p>
					<h4>Maintainable code</h4>
					<p>Clean and tidy code make your project easy to maintain and upgrade</p>
				</div>
				<div class="satisfaction_type">
					<p><img src="./img/birthday.png"></p>
					<h4>Enjoy your business</h4>
					<p>Get your order with no extra worries and save you time.</p>
				</div>
			</div>
		</div>
	</section>
	<section class="call_to_action">
		<h2>Ready to hire</h2>
		<p>you will be satisfied of our cooperation</p>
		<p><a class="button" href="contact.html">Hire me</a></p>
	</section>
	<footer>
		<p>&copy; Copyright by Vasile Cojusco.</p>
	</footer>
	<script src="./js/jquery-3.2.1.min.js" charset="utf-8"></script>
	<script type="text/javascript" defer>
		var hide = function(event) {
    document.getElementById("menu").style.top = "-455px";
    document.getElementsByClassName("toggle_ancher")[0].style.color = "#fff";
};
	    function toggle_menu(event) {
            event.stopPropagation();
            if(document.getElementById("menu").style.top == "0px") {
                document.getElementById("menu").style.top = "-455px";
                document.getElementsByClassName("toggle_ancher")[0].style.color = "#fff";
            }
            else {
                document.addEventListener('touchend', hide, false);
                document.addEventListener('click', hide, false);
                document.getElementById("menu").style.top = "0";
                document.getElementsByClassName("toggle_ancher")[0].style.color = "#919294";
            }
        }
		$('#smooth_scroll[href^="#"]').on('click',function (e) {
            e.preventDefault();

            var target = this.hash;
            var $target = $(target);

            $('html, body').stop().animate({
		        'scrollTop': $target.offset().top
		    }, 900, 'swing', function () {
                window.location.hash = target;
            });
		});
		$(window).scroll(function(e){
            parallax();
        });
		function parallax(){
            var scrolled = $(window).scrollTop();
            $('.header_background').css('top',-(scrolled*0.15)+'px');
            $('.statistics_background').css('top',-(scrolled*0.1)+'px');
        }
	</script>
</body>
</html>