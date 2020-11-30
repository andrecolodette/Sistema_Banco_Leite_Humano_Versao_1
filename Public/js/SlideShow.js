var slideIndex = 1;
var slideResert = showSlides(slideIndex);

function plusSlides(n=1) {
    clearTimeout(slideResert);
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    clearTimeout(slideResert);
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlide");
    var dots = document.getElementsByClassName("slideDot");

    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }

    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";

    clearTimeout(slideResert);
    slideResert = setTimeout(plusSlides, 5000);
}
