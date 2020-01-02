function toggleSwitchActions() {

    var x = document.getElementById("toggleVisibility");
    var y = document.getElementById("switchLabel");

    if (x.value === "none") {
        x.value = "all";
        y.innerHTML = "Visible par tous";
    } else {
        x.value = "none";
        y.innerHTML = "Visible pour les auteur/co-auteurs/personnes sélectionnées";
    }
}

