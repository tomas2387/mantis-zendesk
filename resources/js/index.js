$(document).ready(function() {
    $('.errormessage').live('click', function(e) {
        if(!$(this).hasClass('hidden')) {
            $(this).fadeOut('slow');
        }
    });

    $('.bug').live('click', function(e) {
        var masdatos = $(this).children('.masdatos');
        if(masdatos) {
            if(masdatos.hasClass('hidden')) {
                masdatos.slideDown();
                masdatos.removeClass('hidden');
            }
            else {
                masdatos.slideUp();
                masdatos.addClass('hidden');
            }
        }
    });

    $('#migrate').live('click', function(e) {
        var jsonbugs = JSON.stringify(bugsarray);
        console.log(jsonbugs);
        $.post('zendesk/zdticket.php', {arrayBugs: bugsarray}, function(e) {
            console.log(e);
        });
    });
});
