ScrollReveal({ reset: true });
ScrollReveal().reveal('.nav', {
    duration: 5000,
    move: 0
  });
ScrollReveal().reveal(".section-intro", {
    duration: 3000,
    origin: "top",
    distance: "400px",
    easing: "cubic-bezier(0.5, 0, 0, 1)",
    rotate: {
      x: 20,
      z: -10
    }
  });
  ScrollReveal().reveal(".section-reserve", {
    duration: 3000,
    origin: "top",
    distance: "400px",
    easing: "cubic-bezier(0.5, 0, 0, 1)",
    rotate: {
      x: 20,
      z: -10
    }
  });
ScrollReveal().reveal('.section-about', {
    duration: 5000,
    move: 0
  });
  ScrollReveal().reveal('.section-form-menu', {
    duration: 5000,
    move: 0
  });
ScrollReveal().reveal('.section-menu', {
    duration: 5000,
    move: 0
  });
  ScrollReveal().reveal('.section-footer', {
    duration: 5000,
    move: 0
  });

  $(document).ready( function() {
    var now = new Date();
    var month = (now.getMonth() + 1);               
    var day = now.getDate();
    if (month < 10) 
        month = "0" + month;
    if (day < 10) 
        day = "0" + day;
    var today = now.getFullYear() + '-' + month + '-' + day;
    $('#datePicker').val(today);
});

$(".close").click(function() {
  $(this)
    .parent(".alert")
    .fadeOut();
});