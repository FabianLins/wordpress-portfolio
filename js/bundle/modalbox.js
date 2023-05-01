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

function catchFocus(lastThis) {
    let element = lastThis;
    if (lastThis.pointerId !== undefined) {
        element = this;
    }
    document.body.classList.add("js-modal-focus");
    modalActive = element.htmlFor;
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
    focusableContent = modal.querySelectorAll(focusableElements);
    lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal
}

function removeFocus() {
    document.body.classList.remove("js-modal-focus");
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
        let lastThis = this;
        catchFocus(lastThis);
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
            if (document.activeElement === lastFocusableElement) {
                firstFocusableElement.focus();
                event.preventDefault();
            }
        }
    }
});