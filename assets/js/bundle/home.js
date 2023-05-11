document.body.classList.remove("no-js");

let sectionsLocked = true;
function unlockSections() {
    if (sectionsLocked) {
        document.body.classList.remove("js-sections");
        document.querySelector("section.about-me img.wheel-icon").classList.add("js-remove-item");
        sectionsLocked = false;
        lockScroll = true;
    }
}