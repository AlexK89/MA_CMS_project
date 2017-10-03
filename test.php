<?php include ("functions.php"); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>ADD FORM</h3>
<form action="test.php" method="POST">
    <input type="text" name="content_name" placeholder="content_name">
    <textarea name="text_content" placeholder="text_content"></textarea>
    <input type="submit" name="add" value="ADD">
</form>
<h3>EDIT FORM</h3>
<form action="test.php" method="POST">
    <input type="text" name="edit_content_name" placeholder="content_name" id="content_name">
    <textarea name="edit_text_content" placeholder="text_content" id="text_content"></textarea>
    <select name="users" id="select_options">
        <?php
            get_data_list();
        ?>
    </select>
    <input type="submit" name="edit" value="EDIT">
</form>

<h3>DELETE FORM</h3>
<form action="test.php" method="POST">
    <select name="remove_item" id="">
        <?php
            get_data_list();
        ?>
    </select>
    <input type="submit" name="delete_item" value="DELETE">
</form>
<script>
    var get_data = <?php echo json_encode(get_data()); ?>;
    var item = document.getElementById('select_options').value;
    function start(){
        document.getElementById("select_options").addEventListener("change", addActivityItem, false);
    }

    function addActivityItem(){
        item = document.getElementById('select_options').value;
        get_data.forEach(function(element)
        {
            if(element["content_name"] === item) {
                console.log(element);
                document.getElementById("content_name").value = element["content_name"];
                document.getElementById("text_content").value = element["text_content"];
            }
        });
    }

    window.addEventListener("load", start, false);
</script>
</body>
</html>