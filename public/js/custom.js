$(document).ready(function(){
	$(".dropdown-button").dropdown();
    $('.parallax').parallax();
    $('.materialboxed').materialbox();
    $(".button-collapse").sideNav();
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
    });


    $('.menu').on('click' , function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        $('.wrap').load(href);
    });

    $.ajaxSetup({
        headers: {
            'X-XSRF-Token': $('meta[name="_token"]').attr('content'),
        },
        beforeSend : function()
        {
            $('#preloader').fadeIn();
        },
        complete : function()
        {
            $('#preloader').fadeOut();
        }
    });
});


