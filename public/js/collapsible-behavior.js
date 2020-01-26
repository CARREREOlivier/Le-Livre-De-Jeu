function changeStoryCollapsibleText(buttonID) {

    if (document.getElementById("see-stories-posts-" + buttonID).innerHTML == "Refermer la liste") {
        document.getElementById("see-stories-posts-" + buttonID).innerHTML ="Voir la liste des posts";

    } else {
        document.getElementById("see-stories-posts-" + buttonID).innerHTML="Refermer la liste";
    }

}

