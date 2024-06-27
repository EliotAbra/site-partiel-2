document.addEventListener("scroll", function () {
  const element = document.querySelector(".police-container1");
  const elementPosition = element.getBoundingClientRect().top;
  const screenPosition = window.innerHeight;

  if (elementPosition < screenPosition) {
    element.classList.add("visible");
  }
});

document.addEventListener("scroll", function () {
  const element = document.querySelector(".police-container2");
  const elementPosition = element.getBoundingClientRect().top;
  const screenPosition = window.innerHeight;

  if (elementPosition < screenPosition) {
    element.classList.add("visible");
  }
});
