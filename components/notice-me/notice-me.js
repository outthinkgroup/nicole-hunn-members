window.addEventListener("DOMContentLoaded", noticeMe);

const intersectionOptions = {
  threshold: [0, 0.25, 0.5],
};
const observer = new IntersectionObserver(noticeMeNow, intersectionOptions);

console.log("hello", "from notice-me");
function noticeMe() {
  const allEl = [...document.querySelectorAll(".notice-me")];
  allEl.forEach((el) => {
    el.parentElement.style.setProperty("perspective", "900px");
    observer.observe(el);
  });
}

function noticeMeNow(entries, observer) {
  entries.forEach((entry) => {
    console.log(entry);
    const { target, isIntersecting, intersectionRatio } = entry;

    if (isIntersecting) {
      if (intersectionRatio > 0.5) {
        target.classList.add("now");
        return;
      }
    }

    target.classList.remove("now");
  });
}
