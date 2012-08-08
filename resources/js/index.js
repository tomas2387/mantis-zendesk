$(document).ready(function() {
    var pn = $('#projectname');
    var bugsarray = {};

    function prettyPrint(arr) {
        var dumped = "";
        if(typeof(arr) == 'object') { //Array/Hashes/Objects
            for(var item in arr) {
                var value = arr[item];
                if(typeof(value) == 'object') {
                    dumped += '<div class="bug">';
                    dumped += '<span class="number">'+value.id+'</span>';
                    dumped += '<span class="summary" title="'+value.description+'">'+value.summary+'</span>';
                    dumped += '<div class="masdatos hidden">';

                    dumped += '<div><span class="bolded-text">Description:</span> '+value.description+'</div>';
                    dumped += '<div><span class="bolded-text">Reporter:</span> '+value.reporter.name+'</div>';

                    dumped += '</div>';
                    dumped += '</div>';
                }
            }
        }
        return dumped;
    }

    $('.form').live('submit', function(e) {
        e.preventDefault();

        if( ! pn.val()) {
            $('.errormessage').fadeIn('slow');
            $('.errormessage').removeClass('hidden');
            $('.errormessage').html('Write the name of the project first');
        }
        else {
            $.get('mantis/connectMantis.php', {projectname: pn.val()}, function(e) {
                try {
                    var object = eval('(' + e + ')');

                    if(object.error) {
                        console.log(object.error);
                        $('.errormessage').fadeIn('slow');
                        $('.errormessage').removeClass('hidden');
                        $('.errormessage').html(object.error);
                        return false;
                    }

                    $("#content").html('');

                    $('.version').prepend('Mantis Connect version: '+object.version);

                    bugsarray = object.result;
                    $('#content').prepend('<button id="migrate">Move all to Zendesk</button>');
                    $('#content').prepend('<div class="buglist">'+prettyPrint(object.result)+'</div>');
                    $('#content').prepend('<div class="title">Bug list</div>');

                    $('#content').fadeIn('slow');
                }
                catch(error) {
                    console.log(error);
                    $('.errormessage').fadeIn('slow');
                    $('.errormessage').removeClass('hidden');
                    $('.errormessage').html('Error on the response');
                }
            });
        }

        return false;
    });

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
