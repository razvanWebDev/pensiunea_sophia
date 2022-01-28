//FOOTER
const currentYearSpan = document.querySelector(".current-year-span");
const getCurrentYear = () => {
  let currentDate = new Date();
  return currentDate.getFullYear();
};

if (!!currentYearSpan) {
  currentYearSpan.innerHTML = getCurrentYear();
}
