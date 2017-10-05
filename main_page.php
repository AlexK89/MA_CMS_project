<?php
include ("./php_functions/home_functions.php");
include ("./php_functions/login_functions.php");
if (!check_data($our_user, $our_user_pass)) {
    header("Location: log_in.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header_aside.css">
    <link rel="stylesheet" href="css/main_page.css">
    <title>Welcome || Main page</title>
</head>
<body>
<header class="page_header">
    <div class="container">
        <div class="page_header_label">
            <p><a href="main_page.php">Welcome, Vasile</a></p>
        </div>
        <div class="page_header_logoff">
            <form action="log_in.php" method="POST">
                <div class="submit_destroy_button">
                    <label for="destroy"></label>
                    <input type="submit" name="destroy" value="Log out" class="log_off">
                </div>
            </form>
        </div>
    </div>
</header>
<aside class="sidebar">
    <nav class= "navigation_bar">
        <ul class="tab_list">
            <li class="tab"><a href="home_page.php">Home page</a></li>
            <li class="tab"><a href="about_page.php">About page</a></li>
            <li class="tab"><a href="portfolio_page.php">Portfolio page</a></li>
        </ul>
    </nav>
</aside>
<div class="content">
    <div class="container">
        <div class="projects_amount">
            <h2 class="projects_number">50</h2>
            <h4 class="project_number_label">Total amount of projects</h4>
        </div>
        <section class="technologies">
            <div class="container">
                <header>
                    <h2 class="technologies_section_label">Choose technology</h2>
                </header>
                <div class="technologies_body">
                    <a class="technology_type" href="#">
                        <p><i class="devicon-html5-plain colored"></i></p>
                        <h4>HTML/CSS</h4>
                    </a>
                    <a class="technology_type" href="#">
                        <p><i class="devicon-javascript-plain colored"></i></p>
                        <h4>JS</h4>
                    </a>
                    <a class="technology_type" href="#">
                        <p><i class="devicon-php-plain colored"></i></p>
                        <h4>PHP</h4>
                    </a>
                    <a class="technology_type" href="#">
                        <p><i class="devicon-bootstrap-plain colored"></i></p>
                        <h4>Bootstrap</h4>
                    </a>
                    <a class="technology_type" href="#">
                        <p><i class="devicon-c-plain colored"></i></p>
                        <h4>C</h4>
                    </a>
                    <a class="technology_type" href="#">
                        <p><i class="devicon-wordpress-plain colored"></i></p>
                        <h4>WordPress</h4>
                    </a>
                </div>
            </div>
        </section>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $('.projects_number').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 3000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
</body>
</html>