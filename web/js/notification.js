/**
 * Created by laurent on 11/12/15.
 */
function checkAll()
{
    $('.checkNotif').prop('checked', $('.checkAll').is(':checked'));
}

function markAsRead()
{
    var url = $('#ajax-notification a').attr('href');
    var notifs = [];
    $('.checkNotif:checked').each(function() {
        notifs.push($(this).val())
    });
    if (notifs.length == 0) {
        return;
    }
    $.ajax({
        statusCode: {
            500: function() {
                //@TODO à refacto dans un template twig
                $('div.page-content').prepend('<div class="message-block error-message"><p class="alert-error">Erreur interne, l\'action n\'a pas pu être exécutée</p></div>');
            }
        },
        url: url,
        method: 'POST',
        data: { data: notifs }
    })
    .done(function(response) {
        for (var i in notifs) {
            $('tr#notif'+notifs[i]).addClass('read').removeClass('new');
        }
        $('.checkNotif, .checkAll').prop('checked', false);
        $('ul.content-wrap li.notifications i').html(response);
    });
}