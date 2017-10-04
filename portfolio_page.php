<?php include ("portfolio_functions.php"); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portfolio page || CMS</title>
</head>
<body>
<h3>ADD/Modify content form</h3>
<form action="portfolio_page.php" method="POST" enctype="multipart/form-data">
    <div class="form_block">
        <select name="select_options" id="select_options">
            <option value="add">Add</option>
            <?php
            get_portfolio_items_list();
            ?>
        </select>
    </div>
    <div class="form_block">
        <input type="text" name="label" id="label" placeholder="label">
    </div>
    <div class="form_block">
        <textarea type="text" name="description" cols="60" rows="20" id="description" placeholder="Description"></textarea>
    </div>
    <div class="form_block">
        <input type="file" name="file_To_Upload" id="fileToUpload">
    </div>
    <div class="form_block">
        <input type="text" name="project_url" id="project_url" placeholder="Project url">
    </div>
    <div class="form_block">
        <input type="submit" name="add" id="add" value="ADD">
        <input type="submit" name="update" id="update" value="UPDATE" disabled>
        <input type="submit" name="delete" value="DELETE">
    </div>
</form>

<script>
    var get_data = <?php echo json_encode(get_portfolio_items()); ?>;

    function disable_update_button(item)
    {
        if (item === "add") {
            document.getElementById("label").value = "";
            document.getElementById("description").value = "";
            document.getElementById("project_url").value = "";
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
            if(element["label"] === item) {
                document.getElementById("label").value = element["label"];
                document.getElementById("description").value = element["description"];
                document.getElementById("project_url").value = element["project_url"];
            }
        });
    }

    window.addEventListener("load", start, false);
</script>
</body>
</html>