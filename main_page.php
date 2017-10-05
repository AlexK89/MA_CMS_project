<?php
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
    <title>Welcome || Main page</title>
</head>
<body>
<!--<ul>-->
<!--    <li><a href="home_page.php">Home page</a></li>-->
<!--    <li><a href="about_page.php">About page</a></li>-->
<!--    <li><a href="portfolio_page.php">Portfolio page</a></li>-->
<!--</ul>-->

<nav class="page_header">
   <div class="container">
       <div>
           <p><a href="#">Welcome, Vasile</a></p>
       </div>
       <div>
           <form action="log_in.php" method="POST">
               <div class="submit_destroy_button">
                   <label for="destroy"></label>
                   <input type="submit" name="destroy" value="Log out" class="log_off">
               </div>
           </form>
       </div>
   </div>
</nav>
</body>
</html>