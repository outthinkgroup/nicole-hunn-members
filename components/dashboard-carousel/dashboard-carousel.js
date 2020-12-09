window.addEventListener("DOMContentLoaded", init);

function init() {
  const wrapper = document.querySelector(".carousel-wrapper");

  if (!wrapper) {
    return;
  }

  const [startAutoNext, stopAutoNext, resetAutoNext] = autoNext();

  //setup initial state
  wrapper.dataset.state = "0";

  const slides = [...wrapper.querySelectorAll(".slide")];
  const dots = [...document.querySelectorAll(".navigation button")];

  allSlideStateInactive();
  slides[0].dataset.state = "active";
  slides[1].dataset.state = "next";
  slides[slides.length - 1].dataset.state = "previous";

  slides.forEach((slide, i) => {
    slide.dataset.slide = i;
    slide.addEventListener("mouseenter", stopAutoNext);
    slide.addEventListener("mouseleave", startAutoNext);
  });
  startAutoNext();

  dots[0].dataset.state = "active";

  dots.forEach((dot, index) =>
    dot.addEventListener("click", () =>
      resetAutoNext(() => navigateDirectly(index))
    )
  );

  function next() {
    navigateByOne(1);
  }
  function navigateByOne(dir) {
    const wrapperEl = document.querySelector(".carousel-wrapper");
    const currentState = Number(wrapperEl.dataset.state);
    const nextState = getNextState(currentState, dir);
    allSlideStateInactive();
    changeState({ wrapperEl, nextState, dir });
  }

  function navigateDirectly(slideIndex) {
    const wrapperEl = document.querySelector(".carousel-wrapper");
    const nextState = Number(slideIndex);
    changeState({ wrapperEl, nextState, dir: 1 });
  }

  function changeState({ wrapperEl, nextState, dir }) {
    //change data attr to show the next slides
    const activeSlide = wrapperEl.querySelector(`[data-slide="${nextState}"]`);
    activeSlide.dataset.state = "active";
    const nextSlide = wrapperEl.querySelector(
      `[data-slide="${getNextState(nextState, dir)}"]`
    );
    nextSlide.dataset.state = "next";
    const previousSlide = wrapperEl.querySelector(
      `[data-slide="${getNextState(nextState, dir * -1)}"]`
    );
    previousSlide.dataset.state = "previous";
    dots.find((_, i) => i == nextState).dataset.state = "active";
    wrapperEl.dataset.state = nextState;
  }

  function allSlideStateInactive() {
    function removeState(el) {
      el.dataset.state = "inactive";
    }
    slides.forEach(removeState);
    dots.forEach(removeState);
  }

  function getNextState(currentState, dir) {
    if (dir == 1) {
      const state = currentState < slides.length - 1 ? currentState + dir : 0;
      console.log(state);
      return state;
    }
    if (dir == -1) {
      return currentState <= 0 ? slides.length - 1 : currentState + dir;
    }
  }

  //responsible for showing the next slide automatically, stopping, and resetting
  function autoNext() {
    let timer;
    function start() {
      timer = setTimeout(function goNext() {
        next();
        console.log("ran");
        start();
      }, 4000);
    }
    function stop() {
      clearTimeout(timer);
    }
    function resetAfter(cb) {
      stop();
      cb();
      start();
    }
    return [start, stop, resetAfter];
  }
}
