$(document).ready(function () {
    var firstPane = $('#sldOne');
    var first = $('#sldOne .next_but');
    var second = $('#sldTwo .next_but');
	var third = $('#sldThree .next_but');
    
   firstPane.fadeIn(0);
  
    first.on('click', function (e) {
      e.preventDefault();
        $(this).parent().delay(100).fadeOut(100);
        $("#sldTwo").delay(200).fadeIn(150);
    });
	
    second.on('click', function (e) {
        e.preventDefault();
        $(this).parent().delay(100).fadeOut(100);
        $("#sldThree").delay(200).fadeIn(150);
    });
	
    third.on('click', function (e) {
        e.preventDefault();
        $(this).parent().delay(100).fadeOut(100);
        $("#sldTwo").delay(200).fadeIn(150);
    });
}); 