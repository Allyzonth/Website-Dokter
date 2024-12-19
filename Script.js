// JavaScript for Scroll to Top
function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }
  
  // JavaScript for Slideshow
let slideIndex = 0;
showSlides();

function showSlides() {
  let slides = document.getElementsByClassName("mySlides");
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 3000);
}

// JavaScript Pop UP Notification
let popup = document.getElementById("popup")

function openPopup(){
  popup.classList.add("open-popup")
}
function closePopup(){
  popup.classList.remove("open-popup")
}