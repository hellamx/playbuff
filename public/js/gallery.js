var slideIndex = 1;
showSlides(slideIndex);

function swapSlide(e) {
	showSlides(slideIndex += e);
}

function currentSlide(e) {
	showSlides(slideIndex = e);
}

function showSlides(e) {
	var i;
	var slides = document.getElementsByClassName("product__slide--content");
	var dots = document.getElementsByClassName("preload--sliderImg");

	if (e > slides.length) {
		slideIndex = 1;
	}
	if (e < 1) {
		slideIndex = slides.length;
	}

	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace("active", "");
	}

	slides[slideIndex - 1].style.display = "block";
	dots[slideIndex - 1].className += " active";
}