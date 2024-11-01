  jQuery(document).ready(function( $ ) {


var set_position1 = $('.set-position-val').val();

      if(set_position1 == "bottom"){
        $('.show-label').css({'top':'auto','bottom':'0px'});
      }

var pos_fix_relative = $('.pos-fix-relative').val();
if(pos_fix_relative == "relative"){
	$('.show-label').css({'position': 'relative','top':'0'});
}

/////////////////////////////////////////////

 //  count down function

    var countDownDate = $('.get-counter-value').val();
    countDownDate = new Date(countDownDate).getTime();
var x = setInterval(function() {
    var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    if(distance > 0){
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  $('.day1').val(days + "d ");
  $('.hour1').val( hours + "h ");
  $('.min1').val(minutes + "m ");
  $('.sec1').val(seconds + "s ");
}
else{
  $('.day1').val("0d");
  $('.hour1').val("0h");
  $('.min1').val("0m");
  $('.sec1').val("0s");
}
console.log(days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ");

if (distance < 0) {
    clearInterval(x);
  }
}, 1000);
// end count down function





  
}); // end ready function

