var slide = document.getElementById("slide");

var srcs = new Array(4);
srcs[0] = "homepageImage1.jpg";
srcs[1] = "homepageImage2.jpg";
srcs[2] = "homepageImage3.jpg";
srcs[3] = "homepageImage4.jpg";

var i=0;
function slideshow() {
    if(i==4){
        i=0;
    }
    slide.src = srcs[i];
    i++;
}

var myInterval = setInterval(slideshow, 1000);