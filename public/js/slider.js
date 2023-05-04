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
	var slides = document.getElementsByClassName("slide-content");

	if (e > slides.length) {
		slideIndex = 1;
	}
	if (e < 1) {
		slideIndex = slides.length;
	}

	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
	}

	slides[slideIndex - 1].style.display = "block";
}

setInterval(swapSlide, 5000, +1);