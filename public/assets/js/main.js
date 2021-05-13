/**
* Template Name: OnePage - v2.2.2
* Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
!(function($) {
  "use strict";

  // Preloader
  $(window).on('load', function() {
    if ($('#preloader').length) {
      $('#preloader').delay(100).fadeOut('slow', function() {
        $(this).remove();
      });
    }
  });

  // Smooth scroll for the navigation menu and links with .scrollto classes
  var scrolltoOffset = $('#header').outerHeight() - 2;
  $(document).on('click', '.nav-menu a, .mobile-nav a, .scrollto', function(e) {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        e.preventDefault();

        var scrollto = target.offset().top - scrolltoOffset;

        if ($(this).attr("href") == '#header') {
          scrollto = 0;
        }

        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu, .mobile-nav').length) {
          $('.nav-menu .active, .mobile-nav .active').removeClass('active');
          $(this).closest('li').addClass('active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').fadeOut();
        }
        return false;
      }
    }
  });

  // Activate smooth scroll on page load with hash links in the url
  $(document).ready(function() {
    if (window.location.hash) {
      var initial_nav = window.location.hash;
      if ($(initial_nav).length) {
        var scrollto = $(initial_nav).offset().top - scrolltoOffset;
        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');
      }
    }
  });

  // Mobile Navigation
  if ($('.nav-menu').length) {
    var $mobile_nav = $('.nav-menu').clone().prop({
      class: 'mobile-nav d-lg-none'
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>');
    $('body').append('<div class="mobile-nav-overly"></div>');

    $(document).on('click', '.mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
      $('.mobile-nav-overly').toggle();
    });

    $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
      e.preventDefault();
      $(this).next().slideToggle(300);
      $(this).parent().toggleClass('active');
    });

    $(document).click(function(e) {
      var container = $(".mobile-nav, .mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').fadeOut();
        }
      }
    });
  } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
    $(".mobile-nav, .mobile-nav-toggle").hide();
  }

  // Navigation active state on scroll
  var nav_sections = $('section');
  var main_nav = $('.nav-menu, #mobile-nav');

  $(window).on('scroll', function() {
    var cur_pos = $(this).scrollTop() + 200;

    nav_sections.each(function() {
      var top = $(this).offset().top,
        bottom = top + $(this).outerHeight();

      if (cur_pos >= top && cur_pos <= bottom) {
        if (cur_pos <= bottom) {
          main_nav.find('li').removeClass('active');
        }
        main_nav.find('a[href="#' + $(this).attr('id') + '"]').parent('li').addClass('active');
      }
      if (cur_pos < 300) {
        $(".nav-menu ul:first li:first").addClass('active');
      }
    });
  });

  // Toggle .header-scrolled class to #header when page is scrolled
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('#header').addClass('header-scrolled');
    } else {
      $('#header').removeClass('header-scrolled');
    }
  });

  if ($(window).scrollTop() > 100) {
    $('#header').addClass('header-scrolled');
  }

  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });

  $('.back-to-top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
  });

  // jQuery counterUp
  $('[data-toggle="counter-up"]').counterUp({
    delay: 10,
    time: 1000
  });

  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      },
      900: {
        items: 3
      }
    }
  });

  // Porfolio isotope and filter
  $(window).on('load', function() {
    var portfolioIsotope = $('.portfolio-container').isotope({
      itemSelector: '.portfolio-item'
    });

    $('#portfolio-flters li').on('click', function() {
      $("#portfolio-flters li").removeClass('filter-active');
      $(this).addClass('filter-active');

      portfolioIsotope.isotope({
        filter: $(this).data('filter')
      });
      aos_init();
    });

    // Initiate venobox (lightbox feature used in portofilo)
    $(document).ready(function() {
      $('.venobox').venobox({
        'share': false
      });
    });
  });

  // Portfolio details carousel
  $(".portfolio-details-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1
  });

  // Init AOS
  function aos_init() {
    AOS.init({
      duration: 1000,
      once: true
    });
  }
  $(window).on('load', function() {
    aos_init();
  });

})(jQuery);

$("#addContact").click(function(e){
  e.preventDefault();
  var name    = $("#name").val();
  var email   = $("#email").val();
  var subject = $("#subject").val();
  var message = $("#message").val();

  $.ajax({
        url: 'Home/contact',
        data: ({ title: title }),
        type: 'post',
        success: function(data) {
            console.log(response);
        }             
  });

})

   
$(".basic_details").click(function(e){
  var table_name =  $(this).attr("data-table-name");
  window.location.href = "/Home/basic_details?page_name="+table_name;
})



$("#send_basic_details").click(function(e){

  e.preventDefault();

  // var firstname     = $("#consumer-fname").val();
  // var consumer_lname     = $("#consumer-lname").val();
  // var consumer_email     = $("#consumer-notice-email").val();
  // var consumer_phone     = $("#consumer-phone").val();
  // var consumer_pincode   = $("#consumer-pincode").val();
  // var consumer_state     = $("#consumer-state").val();
  // var consumer_address   = $("#consumer-address").val();

  // var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  // var phone = $("#phone_number").val();
  // var intRegex = /[0-9 -()+]+$/;
  // var letters = /^[A-Za-z]+$/;

  // var base_url = window.location.origin;


  // if( consumer_fname == ''){
  //   $("html, body").animate({ scrollTop: 0 }, "slow");
  //   $("#err-consumer-fname").show();
  //   return;
  // }else{$("#err-consumer-fname").hide();}


  // if( consumer_lname == ''){
  //   $("html, body").animate({ scrollTop: 0 }, "slow");
  //   $("#err-consumer-lname").show();
  //   return;
  // }else{$("#err-consumer-lname").hide();}


  // if( consumer_email == ''){
  //   $('html, body').animate({
  //               scrollTop: $("#consumer-fname").offset().top
  //         }, 2000);    
  //   $("#err-consumer-email").show();
  //   return;
  // }else{$("#err-consumer-email").hide();}


  // if( !(regex.test(consumer_email)) ){
  //   $('html, body').animate({
  //               scrollTop: $("#consumer-fname").offset()
  //             }, 2000);
  //   $("#err-consumer-email").show();
  //   return;
  // }else{$("#err-consumer-email").hide();}


  // if( consumer_phone == ''){
  //   $('html, body').animate({
  //             scrollTop: $("#consumer-phone").offset()
  //   }, 2000);
  //   $("#consumer_phone").focus();
  //   $("#err-consumer-phone").show();
  //   return;addConsumerNoticeData
  // }else{$("#err-consumer-phone").hide();}


  // if( consumer_pincode == '' ){
    
  //   $("#consumer-pincode").focus();
  //   $("#err-consumer-pincode").show();
  //   return;
  // }else{$("#err-consumer-pincode").hide();}



  // if( consumer_state == ''){
  //   $("#consumer-state").focus();
  //   $("#err-consumer-state").show();
  //   return;
  // }else{$("#err-consumer-state").hide();}


  // if( consumer_address == ''){
    
  //   $("#consumer_address").focus();
  //   $("#err-consumer-address").show();
  //   return;
  // }else{$("#err-consumer-address").hide();}

  var page_name = $("#page_name").val();

  var base_url = window.location.origin;


  $.ajax({
          url: base_url+ "/Notice/saveNoticeData", 
          type: "POST",             
          data: new FormData(document.getElementById("notice-data")),
          contentType: false,                  
          processData:false,
        
        success: function(response)   
        {
          window.location.href= base_url+"/Notice/"+page_name;
        }
    });

})




function checkFile(id,tr_id) {
  
    var fileInput = document.getElementById(id);
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
      
    if (!allowedExtensions.exec(filePath)) {

     $.confirm({
        title: 'Unsupported File Format',
        content: 'Allowed only PDF,PNG,JPEG',
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Try again',
                btnClass: 'btn-red',
                action: function(){
                }
            },
            close: function () {
            }
        }
});

        document.getElementById(tr_id).classList.add("tr-border");
        document.getElementById(tr_id).classList.remove("no-border");

        fileInput.value = '';
        return false;
    } 
    else 
    {
        $("#"+tr_id).removeClass("tr-border");
        $("#"+tr_id).addClass("no-border");

    }
}



$("#save_pf_claim").click(function(e){
  e.preventDefault();
  var pf_office =  $("#pf_office").val();
  var pf_office_address =  $("#pf_office_address").val();
  var no_pf_complaint =  $("#no_pf_complaint").val();
  var base_url = window.location.origin;
  $.ajax({
          url: base_url+ "/Notice/save_pf_claim", 
          type: "POST",             
          data: new FormData(document.getElementById("notice-data")),
          contentType: false,                  
          processData:false,
        success: function(response)   
        {
          if(response == "1"){
             window.location.href= base_url+"/congoPage";
             return;
          }
          if(response == '2'){         
            alert("Something Wents Wrong Please Try After Some Time");
          }

        }
    });


})




$("#esiClaimFinalSubmit").click(function(e){
  e.preventDefault();
  var base_url = window.location.origin;

  if ($('#preloader').length) {
            $('#preloader').delay(100).fadeOut('slow', function() {
            $(this).remove();
          });
  }

    $.ajax({
          url: base_url+ "/Employee/esiClaimFinalSubmit", 
          type: "POST",             
          data: new FormData(document.getElementById("notice-data")),
          contentType: false,                  
          processData:false,
        
        success: function(response)   
        {

        if(response == "1"){
          window.location.href= base_url+"/congoPage";
        return;
        }
        if(response == '2'){         
          alert("Something Wents Wrong Please Try After Some Time");
        }

        }
    });


})

$("#takeToMyNotice").click(function(){
  var base_url = window.location.origin;
  window.location.href = base_url+ "/Home";
});


$("#salaryFinalSubmit").click(function(e){

  e.preventDefault();
  var base_url = window.location.origin;

    $.ajax({
          url: base_url+ "/Employee/salaryFinalSubmit", 
          type: "POST",             
          data: new FormData(document.getElementById("notice-data")),
          contentType: false,                  
          processData:false,
        
        success: function(response)   
        {   
            
        if(response == "1"){
          window.location.href= base_url+"/congoPage";
        return;
        }
        if(response == '2'){
          alert("Something Wents Wrong Please Try After Some Time");
    }

        }
    });


})



$("#harrasmentFinalSubmit").click(function(e){

  e.preventDefault();
  var base_url = window.location.origin;

    $.ajax({
          url: base_url+ "/Employee/harrasmentFinalSubmit", 
          type: "POST",             
          data: new FormData(document.getElementById("notice-data")),
          contentType: false,                  
          processData:false,
        
        success: function(response)   
        {   
            
        if(response == "1"){
          window.location.href= base_url+"/congoPage";
        return;
        }
        if(response == '2'){
          alert("Something Wents Wrong Please Try After Some Time");
    }

        }
    });

})


$("#userSignUp").click(function(){


  var first_name   =  $("#first_name").val();
  var last_name    =  $("#last_name").val();
  var email        =  $("#email_id").val();
  var phone        =  $("#phone_num").val();
  var password     =  $("#password").val();
  var dob          =  $("#dob").val();
  var gender       =  $('input[name=gender]:checked').val();
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var intRegex = /[0-9 -()+]+$/;
  var letters = /^[A-Za-z]+$/;



  // var today = new Date();
  //   var birthDate = new Date(dob);
  //   var age = today.getFullYear() - birthDate.getFullYear();
  //   var m = today.getMonth() - birthDate.getMonth();
  //   if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
  //       age = age - 1;
  //   }

  if(first_name == ''){
    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Name");
    $("#first_name").focus();
    $('.error-msg').delay(3000).fadeOut('slow');
    return;

  }

  if( !(first_name.match(letters)) ){
    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Name");
    $("#first_name").focus();
    $('.error-msg').delay(3000).fadeOut('slow');
    return;
  }

  if(last_name == ''){
    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Name");
    $("#last_name").focus();
    $('.error-msg').delay(3000).fadeOut('slow');
    return;
  }

  if( !(last_name.match(letters)) ){

    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Name");
    $("#last_name").focus();
    $('#registerModal').scrollTop(0);
    $('.error-msg').delay(3000).fadeOut('slow');
    return;
  }

  if(email == ''){

    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Email");
    $("#email_id").focus();
    $('#registerModal').scrollTop(0);
    $('.error-msg').delay(3000).fadeOut('slow');
    return;
  }

  if(!(regex.test(email))) {

    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Email");
    $("#email_id").focus();
    $('#registerModal').scrollTop(0);
    $('.error-msg').delay(3000).fadeOut('slow');
    return;

  }
    
  if((phone.length < 10) || (!intRegex.test(phone)))
  {
    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Number");
    $("#phone_num").focus();
    $('#registerModal').scrollTop(0);
    $('.error-msg').delay(3000).fadeOut('slow');
    return;
  }
  if( (phone.length != 10 ) )
  {
    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Number");
    $("#phone_num").focus();
    $('#registerModal').scrollTop(0);
    $('.error-msg').delay(3000).fadeOut('slow');
    return;
  }

  if(password == ''){

    $(".error-msg").show();
    $(".error-msg").html("Please Provide Valid Password");
    $("#password").focus();
    $('#registerModal').scrollTop(0);
    $('.error-msg').delay(3000).fadeOut('slow');
    return;
  }

  // if(dob == ''){

  //   $(".error-msg1").show();
  //   $(".error-msg1").html("Please Provide Valid Email");
  //   $("#dob").focus();
  //   $('#getStarted').scrollTop(0);
  //   $('.error-msg1').delay(3000).fadeOut('slow');
  //   return;
  // }

  // if(age < 18){
  //   alert("Age Should be greater than 18 years");
  //   return;
  // }

  var age =12;


  var base_url = window.location.origin;
  
  $.ajax({
    url: base_url+"/User/",
    type: "post",
    data:{'first_name':first_name,'last_name':last_name,'email':email,
          'password':password,'dob':dob,'age':age,'phone':phone,'gender':gender},
    dataType: 'json',
    cache: false,

    success: function (response) {

    if(response.status=='404'){

    $(".error-msg").show();
    $(".error-msg").html(response.msg);
    $('#registerModal').animate({
          scrollTop: $(".error-msg").offset().top
        }, 800);

        $("#"+response.focus).focus();
      return;

    }

        $(".error-msg").hide();
        $(".success-msg").show();
        $(".success-msg").html(response.msg);

        $('#registerModal').animate({
          scrollTop: $(".success-msg").offset().top
        }, 800);

        $(".success-msg").focus();
        window.location.href = base_url+"/Home";

    },
    error: function(jqXHR, textStatus, errorThrown) {
       console.log(textStatus, errorThrown);
    }
});
  

})


$("#loginUser").click(function(){

  var loginEmail         = $("#loginEmail").val();
  var loginPass          = $("#loginPass").val();
  var redirectNoticeName = $("#noticeName").val();
  var base_url = window.location.origin;

  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;


  if(loginEmail == ''){
    alert("Email is not valid");
    $("#loginEmail").focus();
    return;
  }

  if(!(regex.test(loginEmail))) {
    alert("Email is not valid");
    $("#loginEmail").focus();
    return;
  }

  if(loginPass == ''){
    alert("Password can not be blanked");
    $("#loginPass").focus();
    return;
  }

  $(".error-msg").hide();

  $("#loader").show();

  $.ajax({
        url: base_url+"/User/login",
        type: "post",
        data:{'email':loginEmail,'password':loginPass},
        success: function (response) {
          if( response==1 || response== '1' ){
            $(".loader").show();
            setTimeout(function(){ 
              window.location.href = base_url+"/Home"
               }, 2000);

          }else{

            $("#loginEmail").val('');
            $("#loginPass").val('');
            $(".error-msg").show();
            $(".error-msg").html("<p>Invalid Credentials!</p>");
            return;
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });

})



$("#logOut").click(function(){

    var action  = 'logout';
    var base_url = window.location.origin;

  $.ajax({
    url: base_url+"/User/userLogOut",
    type: "post",
    data:{'action':action},
    success: function (response) {
      window.location.href = base_url+"/Home"
    },
    error: function(jqXHR, textStatus, errorThrown) {
       console.log(textStatus, errorThrown);
    }
});

 
})