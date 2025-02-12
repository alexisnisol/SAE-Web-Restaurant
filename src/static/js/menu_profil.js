document.addEventListener("DOMContentLoaded", function () {
    const profileIcon = document.getElementById("profile-icon");
    const profileMenu = document.getElementById("profile-menu");


    profileIcon.addEventListener("click", function () {
        profileMenu.classList.toggle("open");
    });

    document.addEventListener("click", function (event) {
        if (!profileMenu.contains(event.target) && event.target !== profileIcon) {
            profileMenu.classList.remove("open");
        }
    });

    document.getElementById("close-menu").addEventListener("click", function() {
        document.getElementById("profile-menu").classList.remove("open");
    });
    
});

