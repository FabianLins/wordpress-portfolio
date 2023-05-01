// Remove No JS class
document.body.classList.remove("no-js");

// Handle buttons
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

// Modal Boxes Keyboard Accessibility and Focus
const checkBoxLabel = document.querySelectorAll("label.js-checkbox-keyboard");
const modalBoxes = document.querySelectorAll(".js-modal-label");
const modalClose = document.querySelectorAll("label.js-modal-close");
let modalActive = false;
let firstFocusableElement = null;
let focusableContent = null;
let lastFocusableElement = null;

function handleToggle(event) {
    if (event.key === "Enter") {
        const selector = document.getElementById(this.htmlFor);
        selector.checked = !selector.checked;
    }
}

function catchFocus() {
    document.body.classList.add("js-modal-focus");
    modalActive = this.htmlFor;
    const focusableElements =
        "button, [href], input, select, textarea, [tabindex]:not([tabindex='-1'])";
    const modal = document.querySelector(`#${modalActive}~ .modal-container`); // select the modal by it's id
    firstFocusableElement = modal.querySelectorAll(focusableElements); // get first element to be focused inside modal
    firstFocusableElement.forEach(currFocus => {
        if ((currFocus.classList).value) {
            (currFocus.classList).forEach((currClass) => {
                if (currClass === "js-modal-close") {
                    firstFocusableElement = currFocus;
                }
            });
        }
    })
    firstFocusableElement.focus();
    focusableContent = modal.querySelectorAll(focusableElements);
    lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal
    //document.querySelector(".scroll-arrow").classList.add("js-remove-item");
}

function removeFocus() {
    document.body.classList.remove("js-modal-focus");
    //document.querySelector(".scroll-arrow").classList.remove("js-remove-item");
    modalActive = false;
    firstFocusableElement = null;
    focusableContent = null;
    lastFocusableElement = null;
}

function keyRemoveFocus(event) {
    if (event.key === "Enter") {
        removeFocus();
    }
}

function keyCatchFocus(event) {
    if (event.key === "Enter") {
        removeFocus();
    }
}

document.addEventListener("keydown", (event) => {
    if (modalActive && event.key === "Escape") {
        const isNotCombinedKey = !(event.ctrlKey || event.altKey || event.shiftKey);
        if (isNotCombinedKey) {
            const selector = document.getElementById(modalActive);
            selector.checked = false;
            removeFocus();
        }
    }
});

checkBoxLabel.forEach((currCheckBox) => {
    currCheckBox.addEventListener("keydown", handleToggle);
});

modalBoxes.forEach((currModal) => {
    currModal.addEventListener("keydown", keyCatchFocus);
    currModal.addEventListener("click", catchFocus);
});

modalClose.forEach((currClose) => {
    currClose.addEventListener("keydown", keyRemoveFocus);
    currClose.addEventListener("click", removeFocus);
});

document.addEventListener("keydown", function (event) {
    if (event.key === "Tab") {
        if (event.shiftKey) { // Shift + Tab
            if (document.activeElement === firstFocusableElement) {
                lastFocusableElement.focus();
                event.preventDefault();
            }
        } else {
            console.log(document.activeElement);
            if (document.activeElement === lastFocusableElement) {
                firstFocusableElement.focus();
                event.preventDefault();
            }
        }
    }
});