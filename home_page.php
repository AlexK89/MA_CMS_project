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
    <link rel="stylesheet" href="Portfolio_project-2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/header_aside.css">
    <link rel="stylesheet" href="css/home_page.css">
    <title>HOME Page || CMS</title>
</head>
<body>
<header class="page_header">
    <div class="container">
        <div class="page_header_label">
            <p><a class="toggle_ancher" onclick="toggle_menu(event)"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a><a href="main_page.php" class="welcome_title">Welcome, Vasile</a></p>
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
    <nav class="navigation_bar">
        <ul class="tab_list">
            <li class="selected_tab"><a href="home_page.php">Home page</a></li>
            <li class="tab"><a href="about_page.php">About page</a></li>
            <li class="tab"><a href="portfolio_page.php">Portfolio page</a></li>
        </ul>
    </nav>
</aside>
<div class="content">
    <div class="container">
        <h3 class="form_label">ADD/Modify content form</h3>
        <form action="php_functions/home_functions.php" method="POST" enctype="multipart/form-data" class="main_form">
            <div class="form_block">
                <select name="select_options" id="select_options" class="input_area select_block">
                    <option value="add">Add / Select</option>
                    <?php
                    get_items_list();
                    ?>
                </select>
            </div>
            <div class="form_block">
                <input type="text" name="label" id="label" placeholder="Label" class="input_area label">
            </div>
            <div class="form_block">
                <textarea type="text" name="description" rows="15" id="description" placeholder="Description" class="input_area description"></textarea>
            </div>
            <div class="form_block">
                <label class="upload_button">
                    Choose file...
                    <input type="file" name="file_To_Upload" id="fileToUpload">
                </label>
            </div>
            <div class="form_block submission_buttons">
                <input type="submit" name="add" id="add" value="ADD">
                <input type="submit" name="update" id="update" value="UPDATE" disabled>
                <input type="submit" name="delete" value="DELETE" class="delete">
            </div>
            <h4 class="error">
                <?php
                if ($_GET["error"]) {
                    echo $_GET["error"];
                } else if ($_GET["success"]) {
                    echo $_GET["success"];
                }
                ?>
            </h4>
        </form>
        <?php
        $data = get_items();
        $item_structure= "";
        $counter = 1;

        foreach ($data as $item) {
            $label = $item["label"];
            $description = $item["description"];
            $img_url = $item["img_url"];
            $block_structure .= "<div class=\"item\">";
            $block_structure .=  "<div class=\"item_content_img\">";
            $block_structure .= "<img src=\"Portfolio_project-2.0/img/" . $img_url . "\" alt=\"" . $img_url . "\">";
            $block_structure .= "</div>";
            $block_structure .= "<div class=\"item_content\">";
            $block_structure .= "<div class=\"item_content_header\">";
            $block_structure .= "<h4 class=\"item_content_header_name\">";
            $block_structure .= "Item #" . $counter . ": " . $label . "</h4></div>";
            $block_structure .= "<div class=\"item_content_body\">";
            $block_structure .= "<p class=\"item_content_body_text\">" . $description . "</div></div></div>";

            $counter++;
        }
        echo $block_structure;
        ?>
    </div>
</div>
<script>var get_data = <?php echo json_encode(get_items()); ?>;</script>
<script src="js/title_listen.js"></script>
<script src="./js/sibebar_menu.js"></script>
</body>
</html>