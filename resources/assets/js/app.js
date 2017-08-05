
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function() {
    $(document).on('click', '.terminal-task', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        var terminal = $('#terminal');
        terminal.find('iframe').attr('src', link);

        if(!terminal.hasClass('-active')) {
            toggleLogs();
        }
    });

    $(document).on('click', '#terminal .btn--close', function(e) {
        e.preventDefault();
        toggleLogs();
    });

    function toggleLogs()
    {
        var terminal = $('#terminal');

        if(terminal.find('iframe').attr('src') == "") {
            var terminal = $('#terminal');
            if(terminal.hasClass('-active')) {
                terminal.removeClass('-active')
                terminal.find('.alert').slideUp()
                terminal.find('.btn--close').text('Show');
            } else {
                terminal.addClass('-active')
                terminal.find('.alert').slideDown()
                terminal.find('.btn--close').text('Hide');
            }
        } else {
            if(terminal.hasClass('-active')) {
                terminal.removeClass('-active').find('iframe').slideUp()
                terminal.find('.btn--close').text('Show');
            } else {
                terminal.addClass('-active').find('iframe').slideDown()
                terminal.find('.btn--close').text('Hide');
            }
        }
    }
});


