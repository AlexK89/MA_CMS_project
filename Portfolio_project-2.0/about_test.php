<?php include ("../about_functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Vasile Cojusco | Software engineer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/about.css">
</head>
<body>
<nav>
    <div class="container hover">
        <div class="toggle"><a class="toggle_ancher" onclick="toggle_menu(event)"><i class="fa fa-bars fa-3x" aria-hidden="true"></i></a></div>
        <ul id="menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </div>
</nav>
<section class="header">
    <div class="header_background"></div>
    <div class="container header_content">
        <div class="header_text">
            <h1>About me</h1>
            <p>
                <?php
                    echo get_about_data();
                ?>
            </p>
        </div>
    </div>
</section>
<section class="promissess">
    <div class="container">
        <header>
            <h2>I can help you with</h2>
            <p>
                I can help you with various types of engineering stuff, which can be usefull for your business
            </p>
        </header>
        <body>
            <?php
                $data = get_about_page_items();
                $block_structure= "";

                foreach ($data as $item) {
                    $label = $item["i_can_do_label"];
                    $description = $item["i_can_do_text"];
                    $icon = $item["i_can_do_icon_url"];

                    $block_structure .=  "<div class=\"satisfaction_type\">";
                    $block_structure .= "<p><img src=\"./img/" . $icon . "\"></p>";
                    $block_structure .= "<h4>" . $label . "</h4>";
                    $block_structure .= "<p>" . $description . "</p>";
                    $block_structure .= "</div>";
                }
                echo $block_structure;
            ?>
        </body>
    </div>
</section>
<section class="principles">
    <div class="principles_row">
        <div class="principles_row_block">
            <i class="devicon-javascript-plain colored"></i>
            <i class="devicon-html5-plain colored"></i>
            <i class="devicon-php-plain colored"></i>
            <i class="devicon-bootstrap-plain colored"></i>
            <i class="devicon-mysql-plain-wordmark colored"></i>
            <i class="devicon-wordpress-plain colored"></i>
            <i class="devicon-c-plain colored"></i>
            <i class="devicon-git-plain colored"></i>
            <i class="devicon-css3-plain colored"></i>
            <i class="devicon-photoshop-plain colored"></i>
        </div>
        <div class="container">
            <div class="principles_row_description inline_block">
                <h4>And also</h4>
                <h2>Technologies I am working with</h2>
                <p>
                    some ipsum text, some ipsum text, some ipsum text, some ipsum text, some ipsum text, some ipsum text, some ipsum text, some ipsum text, some ipsum text, some ipsum text, some ipsum text, some ipsum text
                </p>
            </div>
        </div>

    </div>
</section>
<section class="call_to_action">
    <h2>Ready to hire</h2>
    <p>you will be sattisfied of our cooperation</p>
    <p><a class="button" href="contact.html">Hire me</a></p>
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