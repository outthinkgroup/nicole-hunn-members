window.addEventListener("DOMContentLoaded", initNotificationAlert);
function initNotificationAlert() {
  const notificationButton = document.querySelector(
    '[data-part="notifications"]'
  );
  notificationButton.addEventListener("click", showRecentUpdates);
}
function showRecentUpdates(e) {
  const button = e.target;
  clearUserNotificationMeta(button);
  toggleUpdatesCard(button);
}
function clearUserNotificationMeta(button) {
  const dot = button.querySelector(".dot");
  if (dot.dataset.notify == "false") return;
  dot.dataset.notify = "false";
  const data = {
    action: "nhm_clear_notification",
    notified: true,
  };
  fetch(`${WP.ajaxUrl}`, {
    method: "POST",
    mode: "cors",
    credentials: "same-origin", // include, *same-origin, omit
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: toQueryString(data),
  }).then((res) => console.log(res));
}

function toggleUpdatesCard(button) {
  const wrapperEl = button.closest(".notification-wrapper");
  const state = wrapperEl.dataset.state;
  if (state === "opened") {
    closeUpdatesCard(wrapperEl);
  } else {
    openUpdatesCard(wrapperEl);
  }
}

function openUpdatesCard(el) {
  console.log("ran");
  el.dataset.state = "opened";
  document.body.addEventListener("click", handleCloseUpdatesCard);
}
function closeUpdatesCard(el) {
  el.dataset.state = "closed";
  document.body.removeEventListener("click", handleCloseUpdatesCard);
}
function handleCloseUpdatesCard(e) {
  console.log("ran handleCloseUpdatesCard");
  if (
    e.target.classList.contains("notification-wrapper") ||
    e.target.closest(".notification-wrapper")
  )
    return;
  const wrapper = document.querySelector(".notification-wrapper");
  closeUpdatesCard(wrapper);
}

function toQueryString(data) {
  const urlSearhParams = new URLSearchParams(data);
  const queryString = urlSearhParams.toString();
  return queryString;
}
