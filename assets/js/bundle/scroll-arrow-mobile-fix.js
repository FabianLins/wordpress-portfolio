function mobileScrollFix() {
    if(window.matchMedia("(any-pointer: coarse)").matches) {
        const selScrollArr = document.querySelector(".scroll-arrow");
        const selScrollBot = document.querySelector(".scroll-bottom-fade");
        selScrollArr.classList.add("js-arrow-rotate-bg");
        selScrollBot.classList.add("js-scroll-bottom-fade");
        setTimeout(() => {
            selScrollArr.classList.remove("js-arrow-rotate-bg");
            selScrollBot.classList.remove("js-scroll-bottom-fade");
        }, 650);
    }
}