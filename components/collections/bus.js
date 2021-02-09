export default class EventBus {
  constructor(commentMsg) {
    this.bus = new Comment(commentMsg);
    this.dispatch = this.dispatch.bind(this);
  }

  dispatch(event, details) {
    this.bus.dispatchEvent(new CustomEvent(event, details));
  }

  listenFor(event, cb) {
    this.bus.addEventListener(event, cb);
  }
}
