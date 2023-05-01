document.body.classList.remove("no-js");

let sectionsLocked = true;
function unlockSection() {
    if (sectionsLocked) {
        document.body.classList.remove("js-sections");
        document.querySelector("section.about-me img.wheel-icon").classList.add("js-remove-item");
        sectionsLocked = false;
    }
}

const homeBtns = document.querySelectorAll(".js-home-btn");
homeBtns.forEach(currHomeBtn => {
    currHomeBtn.addEventListener("click", unlockSection);
});