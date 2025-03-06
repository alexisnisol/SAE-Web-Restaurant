document.addEventListener("DOMContentLoaded", function () {
    const profileIcon = document.getElementById("profile-icon");
    const profileMenu = document.getElementById("profile-menu");
    const closeMenu = document.getElementById("close-menu");

    if (!profileIcon || !profileMenu || !closeMenu) return;

    const isLoggedIn = profileIcon.getAttribute("data-logged-in") === "true";

    if (isLoggedIn) {
        profileIcon.addEventListener("click", function (event) {
            event.stopPropagation(); 
            profileMenu.classList.toggle("open");
        });

        document.addEventListener("click", function (event) {
            if (!profileMenu.contains(event.target) && event.target !== profileIcon) {
                profileMenu.classList.remove("open");
            }
        });

        closeMenu.addEventListener("click", function () {
            profileMenu.classList.remove("open");
        });
    }
});
