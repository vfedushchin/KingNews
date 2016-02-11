jQuery(document).ready(function($){



/* start script for adding data-atribute to menu
=============================================*/ 
// ------------------------------------------------------------------------

/*menu_target = $('#main-menu > li > a');
menu_target.attr('data-title', "Test menu");*/
// menu_target.attr('data-title', $(this).val());

$( "#main-menu > li > a" ).each(function( index ) {
    $( this ).attr('data-title', $( this ).text());
});

/* end script for adding data-atribute to menu
=============================================*/



});