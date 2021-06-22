/*
Template Name: App Star
Title: Free android ios mobile app landing page template theme html5 bootstrap
Description: App Star - free landing page templates html5 best for creating an android mobile template or ios app landing pages built with bootstrap.
Keyword: free landing page templates html5, android mobile template, ios app landing page, mobile app theme bootstrap, app landing page template bootstrap free
Author: Bootstrap Website Templates
Author URI: https://bootstrapwebtemplates.com/
Template URI: https://bootstrapwebtemplates.com/free-android-ios-mobile-app-landing-page-template-html5-bootstrap
Tags: app landing page, app Showcase, app template, app website, clean app landing, creative app landing page, mobile app landing page, modern app landing, free landing page templates html5, android mobile template, ios app landing page, mobile app theme bootstrap, app landing page template bootstrap free
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
*/

$(document).ready(function(){

    /*Screenshots carousel scripts*/
    $("#screenshot").owlCarousel({
      loop:true,
      autoplay: true,
      margin:30,
      nav: false,
      navText: ["<i class='fa fa-angle-right'></i>","<i class='fa fa-angle-left'></i>"],
      responsiveClass:true,
      responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }

    });
    
    /*Testimonial carousel scripts*/
    $("#testimonial").owlCarousel({
        loop:true,
        autoplay: true,
        margin: 10,
        nav: true,
        navText: ["<i class='fa fa-angle-right'></i>","<i class='fa fa-angle-left'></i>"],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
            }
        }
    });

    /*Menu bar background color change script*/
    $("#menu-click").click(function(event){
            event.preventDefault();
        });
    $(window).scroll(function(){
       var scrollTop = $(window).scrollTop();
        if(scrollTop>30){
             $("#nav").css("background-color", "#134102");
         }
        else{
        $("#nav").css("background-color", "transparent");
    }
    });

    /*Smoth transition script*/
     // This is a functions that scrolls to #{blah}link
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });

});

/*Nav bar script to open*/
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "20px";
    document.getElementById("main").style.marginLeft = "20px";
    document.getElementById("overlay").style.width = "100%";
    document.getElementById("overlay").style.height = "100%";
    /*document.getElementById("overlay").style.backgroundColor = "rgba(0,0,0,0.4)";*/            
}
/*Script to close nav bar*/
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.getElementById("overlay").style.width = "0%";
    document.getElementById("overlay").style.height = "0%";
}

$(".copyright").after(atob("PGRpdiBjbGFzcz0iY29sLW1kLTYiPjxkaXYgY2xhc3M9InJpZ2h0LXRleHQiPkRlc2lnbiAmYW1wOyBEZXZlbG9wZWQgYnk6IDxhIGhyZWY9Imh0dHBzOi8vYm9vdHN0cmFwd2VidGVtcGxhdGVzLmNvbS8iIHRhcmdldD0iX2JsYW5rIj5Cb290c3RyYXAgV2ViIFRlbXBsYXRlczwvYT48L2Rpdj48L2Rpdj4="));
