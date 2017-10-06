var hide = function(event) {
    document.getElementsByClassName("sidebar")[0].style.left = "-270px";
    document.getElementsByClassName("toggle_ancher")[0].style.color = "#fff";
};
function toggle_menu(event) {
    event.stopPropagation();
    if(document.getElementsByClassName("sidebar")[0].style.left === "0px") {
        document.getElementsByClassName("sidebar")[0].style.left = "-270px";
        document.getElementsByClassName("toggle_ancher")[0].style.color = "#fff";
    }
    else {
        document.addEventListener('touchend', hide, false);
        document.addEventListener('click', hide, false);
        document.getElementsByClassName("sidebar")[0].style.left = "0";
        document.getElementsByClassName("toggle_ancher")[0].style.color = "#00d59e";
    }
}