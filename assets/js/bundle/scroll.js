let lockScroll = false;
let projectsLocked = true;

function unlockProjects() {
    document.querySelector(".projects").classList.add("js-display-block-important");
    projectsLocked = false;
}

window.addEventListener('scroll', () => {
    if (!lockScroll && (window.innerHeight + Math.round(window.scrollY)) >= document.body.offsetHeight - 100) {
        if (projectsLocked) {
            unlockProjects();
        }
        else {
            unlockSections();
            // unlockSections() => home.js
            lockScroll = true;
        }
    }
});