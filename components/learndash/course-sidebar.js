window.addEventListener("load", courseScriptsInit);
function courseScriptsInit() {
  if (!document.getElementById("course_navigation")) return;

  const modules = [
    ...document.querySelectorAll(
      ".learndash_navigation_lesson_topics_list > div"
    ),
  ];
  modules.forEach((topic, index) => {
    const lessons = [...topic.querySelectorAll(".topic_item")];
    const totalLessons = lessons.length;
    const completedLessons = lessons.filter((lesson) =>
      lesson.querySelector(".topic-completed")
    );
    const totalCompletedLessons =
      completedLessons.length > 0 ? completedLessons.length : 0;

    const percentCompleted = `${Math.floor(
      (totalCompletedLessons / totalLessons) * 100
    )}`;

    topic.style.setProperty("--module-progress", percentCompleted);

    if (percentCompleted === `100`) {
      topic.classList.add("completed");
    }
  });
}
