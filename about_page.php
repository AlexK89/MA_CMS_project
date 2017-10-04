<?php include ("about_functions.php"); ?>

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
<h3>About section</h3>
<form action="about_page.php" method="POST">
    <div class="form_block">
        <textarea name="about_welcome_text" id="about_welcome_text" cols="30" rows="10" placeholder="About me"><?php echo get_about_data();?></textarea>
    </div>
    <input type="submit" name="update_about" id="update_about" value="UPDATE">
</form>
<h3>ADD/Modify content form</h3>
<form action="about_functions.php" method="POST" enctype="multipart/form-data">
    <div class="form_block">
        <select name="select_options" id="select_options">
            <option value="add">Add</option>
            <?php
            get_about_page_items_list();
            ?>
        </select>
    </div>
    <div class="form_block">
        <input type="file" name="file_To_Upload" id="fileToUpload">
    </div>
    <div class="form_block">
        <input type="text" name="i_can_do_label" id="i_can_do_label" placeholder="I can do label">
    </div>
    <div class="form_block">
        <textarea name="i_can_do_text" id="i_can_do_text" cols="30" rows="10" placeholder="I can do"></textarea>
    </div>
    <div class="form_block">
        <input type="submit" name="add" id="add" value="ADD">
        <input type="submit" name="update" id="update" value="UPDATE" disabled>
        <input type="submit" name="delete" value="DELETE">
    </div>
</form>
<script>
    var get_data = <?php echo json_encode(get_about_page_items()); ?>;

    function disable_update_button(item)
    {
        if (item === "add") {
            document.getElementById("i_can_do_label").value = "";
            document.getElementById("i_can_do_text").value = "";
            document.getElementById('update').disabled = true;
            document.getElementById('add').disabled = false;
        } else {
            document.getElementById('update').disabled = false;
            document.getElementById('add').disabled = true;
        }
    }
    function start()
    {
        document.getElementById("select_options").addEventListener("change", addActivityItem, false);
    }

    function addActivityItem()
    {
        var item = document.getElementById('select_options').value;
        disable_update_button(item);
        get_data.forEach(function(element)
        {
            if(element["i_can_do_label"] === item) {
                document.getElementById("i_can_do_label").value = element["i_can_do_label"];
                document.getElementById("i_can_do_text").value = element["i_can_do_text"];
            }
        });
    }

    window.addEventListener("load", start, false);
</script>
</body>
</html>