let lockScroll = false;
let projectsLocked = true;

function unlockProjects() {
    document.querySelector(".projects").classList.add("js-display-block-important");
    projectsLocked = false;
}

window.onscroll = () => {
    if (!lockScroll && (window.innerHeight + Math.round(window.scrollY)) >= document.body.offsetHeight) {
        if (projectsLocked) {
            unlockProjects();
        }
        else {
            document.querySelector(".list-of-skills").classList.add("js-display-block-important");
            document.querySelector("section.about-me img.wheel-icon").classList.add("js-remove-item");
            lockScroll = true;
        }
    }
};