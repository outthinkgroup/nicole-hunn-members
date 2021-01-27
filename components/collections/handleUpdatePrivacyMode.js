import Notice from "./notification";
import EventBus from "./bus";

export const privacyModeBus = new EventBus("privacy-mode");

export function handleUpdatePrivacyMode(e) {
  const toggle = e.currentTarget;
  const list = toggle.closest(".list-item, .list-single");

  const { listId: list_id } = list.dataset;
  const { userId: user_id } = WP;

  const new_status = getNewStatus(toggle);
  const notice = new Notice(toggle.parentElement, [0, -35]);
  list.dataset.state = "loading";
  notice.setNotice(`changing to ${new_status}`);
  window.__FAVE_RECIPE
    .changeListPrivacyMode({ user_id, list_id, status: new_status })
    .then(function waitForResponse(res) {
      if (res.error) {
        const { message } = res.error;
        if (message) {
          alert(message);
        }
        list.dataset.state = "error";
      } else {
        notice.setNotice(`collection is now ${new_status}`);
        list.dataset.state = "idle";
        toggle.closest("[data-status]").dataset.status = new_status;
        privacyModeBus.dispatch("privacy-change", {
          detail: { status: new_status },
        });
      }
    });
}

//checked = `publish`
//unchecked = `private`
function getNewStatus(checkboxEl) {
  const { checked } = checkboxEl;
  return toggleStatus(checked);
}
function toggleStatus(checked) {
  return checked == true ? "publish" : "private";
}
