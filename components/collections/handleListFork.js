import Notice from "./notification";
export function handleListFork(e) {
  const button = e.currentTarget;
  const parent = button.closest(".list-item, .list-single");

  const { listId: list_id } = parent.dataset;
  const { userId: user_id } = WP;

  const notice = new Notice(button.parentElement, [0, -85], 6000);
  parent.dataset.state = "loading";
  notice.setNotice(`cloning collection`);
  window.__FAVE_RECIPE
    .forkList({ user_id, list_id /* list_title */ })
    .then(function waitForResponse(res) {
      if (res.error) {
        const { message } = res.error;
        if (message) {
          alert(message);
        }
        parent.dataset.state = "error";
      } else {
        notice.setNotice(
          `Cloned Collection: <a href="${res.data.link}">See Collection</a>`
        );
        parent.dataset.state = "idle";
      }
    });
}
