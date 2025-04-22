document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".tab-button");
  const contents = document.querySelectorAll(".tab-content");

  const firstTab = document.querySelector(".tab-button");
  if (firstTab && !document.querySelector(".tab-button.active")) {
    firstTab.classList.add("active");
    document.querySelector(`#${firstTab.dataset.tab}`)?.classList.add("active");
  }

  buttons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      const tabId = this.dataset.tab;

      buttons.forEach((btn) => btn.classList.remove("active"));
      this.classList.add("active");

      contents.forEach((content) => content.classList.remove("active"));
      document.getElementById(tabId)?.classList.add("active");
    });
  });
});
