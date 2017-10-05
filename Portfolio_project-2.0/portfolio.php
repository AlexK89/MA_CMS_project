<?php include("../php_functions/portfolio_functions.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Vasile Cojusco | Software engineer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/portfolio.css">
</head>
<body>
<nav>
    <div class="container hover">
        <div class="toggle"><a class="toggle_ancher" onclick="toggle_menu(event)"><i class="fa fa-bars fa-3x" aria-hidden="true"></i></a></div>
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </div>
</nav>
<section class="header">
    <div class="header_background"></div>
    <div class="container header_content">
        <h4>Here you can find</h4>
        <h1>My Projects I am proud of</h1>
    </div>
</section>
<section class="principles">
    <div class="container">

        <?php
        $data = get_items();
        $block_structure= "";
        $counter = 1;

        foreach ($data as $item) {
            $label = $item["label"];
            $description = $item["description"];
            $img_url = $item["img_url"];
            $project_url = $item["project_url"];

            $block_structure .=  "<div class=\"principles_row\">";
            $block_structure .= "<div class=\"principles_row_block\">";
            $block_structure .= "<div class=\"principles_row_img inline_block\">";
            $block_structure .= "<img src=\"./img/" . $img_url . "\" alt=\"" . $img_url . "\">";
            $block_structure .= "</div>";
            $block_structure .= "<div class=\"principles_row_link inline_block\">";
            $block_structure .= "<a class=\"button\" href=\"" . $project_url . "\">Go to project</a>";
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
</section>
<section class="call_to_action">
    <h2>Ready to hire</h2>
    <p>you will be sattisfied of our cooperation</p>
    <p><a class="button" href="#info_scroll">Hire me</a></p>
</section>
<footer>
    <p>&copy; Copyright by Vasile Cojusco.</p>
</footer>
<script src="./js/jquery-3.2.1.min.js" charset="utf-8"></script>
<script type="text/javascript">
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
    $(window).scroll(function(e){
        parallax();
    });
    function parallax(){
        var scrolled = $(window).scrollTop();
        $('.header_background').css('top',-(scrolled*0.15)+'px');
    }
</script>
</body>
</html>
