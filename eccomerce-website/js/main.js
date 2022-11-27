// toggle menu when website is in a smaller screen
var MenuItems=document.getElementById("MenuItems");
        MenuItems.style.maxHeight="0px";

        function menutoggle(){
            if(MenuItems.style.maxHeight=="0px"){
                MenuItems.style.maxHeight="200px";
            }
            else{
                MenuItems.style.maxHeight="0px"
            }
        }


// ==============================================================
// for the sliding of images in offers section
var slideIndex = 0;
showSlides();
    

// slide show for the banner offers
function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");

    // for loop
    for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
    }
    slideIndex++;
          
    // diplay sliding effect
    if (slideIndex > slides.length) {slideIndex = 1}    
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }

      // rotation for every picture
      slides[slideIndex-1].style.display="block"; 
      dots[slideIndex-1].className += " active";
      setTimeout(showSlides, 3500); // Change image every 3.5 seconds
}



// =================================================================
// swiping effect for the brands of our page
// Branding section
var swiper = new Swiper(".brand-slider", {
  // looping and adding space between every pic
    spaceBetween: 20,
    loop:true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        450: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        991: {
          slidesPerView: 4,
        },
        1200: {
          slidesPerView: 5,
        },
      },
});






