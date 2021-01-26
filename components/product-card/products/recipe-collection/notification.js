export default class Notice {
  constructor(el, [xAxis, yAxis]) {
    this.el = el;
    this.placement = {
      left: xAxis,
      top: yAxis,
    };

    const { y: top, x: left } = this.el.getBoundingClientRect();
    console.log(this.el.getBoundingClientRect());
    this.position = {
      top: window.pageYOffset + (top + this.placement.top * -1),
      left: left + this.placement.left,
    };
    this.noticeEl = document.createElement("div");
    this.noticeEl.classList.add("temp-notice");
    this.noticeEl.style.position = "absolute";
  }

  setNotice = (msg) => {
    this.noticeEl.textContent = msg;
    if (!document.body.contains(this.noticeEl)) {
      document.body.appendChild(this.noticeEl);
      this.noticeEl.style.setProperty("left", `${this.position.left}px`);
      this.noticeEl.style.setProperty("top", `${this.position.top}px`);
    }
    if (this.timer) clearTimeout(this.timer);

    this.timer = setTimeout(this.removeNotice, 3000);
  };

  removeNotice = () => {
    clearTimeout(this.timer);
    // if (document.body.contains(this.noticeEl)) {
    this.noticeEl.parentElement.removeChild(this.noticeEl);
    // }
  };
}
