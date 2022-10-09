window.addEventListener("scroll", function () {
    let header = document.querySelector(".subHeader")
    header.classList.toggle("sticky", window.scrollY > 0)
})
