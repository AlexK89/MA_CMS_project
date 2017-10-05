
function disable_update_button(item)
{
    if (item === "add") {
        document.getElementById("label").value = "";
        document.getElementById("description").value = "";
        if (document.getElementById("project_url")) {
            document.getElementById("project_url").value = "";
        }
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
            if (document.getElementById("project_url")) {
                document.getElementById("project_url").value = element["project_url"];
            }
        }
    });
}
window.addEventListener("load", start, false);