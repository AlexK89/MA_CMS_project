<?php
    include ("./php_functions/about_functions.php");
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
    <title>About page || CMS</title>
</head>
<body>
<ul>
    <li><a href="home_page.php">Home page</a></li>
    <li><a href="about_page.php">About page</a></li>
    <li><a href="portfolio_page.php">Portfolio page</a></li>
</ul>
<h3>About section</h3>
<form action="./php_functions/about_functions.php" method="POST">
    <div class="form_block">
        <textarea name="about_welcome_text" id="about_welcome_text" cols="30" rows="10" placeholder="About me"><?php echo get_about_data();?></textarea>
    </div>
    <input type="submit" name="update_about" id="update_about" value="UPDATE">
</form>
<h3>ADD/Modify content form</h3>
<form action="./php_functions/about_functions.php" method="POST" enctype="multipart/form-data">
    <div class="form_block">
        <select name="select_options" id="select_options">
            <option value="add">Add</option>
            <?php
                get_items_list();
            ?>
        </select>
    </div>
    <div class="form_block">
        <input type="file" name="file_To_Upload" id="fileToUpload">
    </div>
    <div class="form_block">
        <input type="text" name="label" id="label" placeholder="I can do label">
    </div>
    <div class="form_block">
        <textarea name="description" id="description" cols="30" rows="10" placeholder="I can do"></textarea>
    </div>
    <div class="form_block">
        <input type="submit" name="add" id="add" value="ADD">
        <input type="submit" name="update" id="update" value="UPDATE" disabled>
        <input type="submit" name="delete" value="DELETE">
    </div>
</form>
<h4 class="error">
    <?php
        if ($_GET["error"]) {
            echo $_GET["error"];
        } else if ($_GET["success"]) {
            echo $_GET["success"];
        }
    ?>
</h4>
<form action="log_in.php" method="post">
    <div class="submit_button">
        <label for="destroy"></label>
        <input type="submit" name="destroy" value="Log out">
    </div>
</form>
<script>var get_data = <?php echo json_encode(get_items()); ?>;</script>
<script type="text/javascript" src="js/title_listen.js"></script>
</body>
</html>