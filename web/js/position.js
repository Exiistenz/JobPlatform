/**
 * Created by laurent on 11/12/15.
 */
function hideButtons()
{
    $('.bt-up').show().first().hide();
    $('.bt-down').show().last().hide();
}
function move(type, id)
{
    var data = [id];
    var url = $('#ajax-document-position a').attr('href');
    if (type == 'up') {
        var trToChange = $('tr#document_'+id).prev();
    } else if (type == 'down') {
        var trToChange = $('tr#document_'+id).next();
    }
    if (trToChange.length == 0 || $('tr#document_'+id).length == 0) {
        return;
    }
    data.push(parseInt(trToChange.attr('id').replace('document_','')));
    $.ajax({
        url: url,
        method: 'POST',
        data: { data: data }
    })
    .done(function(response) {
        if (response == 'ok') {
            if (type == 'up') {
                $('tr#document_'+data[1]).before($('tr#document_'+data[0]).detach());
            } else if (type == 'down') {
                $('tr#document_'+data[1]).after($('tr#document_'+data[0]).detach());
            }
            hideButtons();
        }
    });
}
function up(id)
{
    move("up",id);
}

function down(id)
{
    move("down",id);
}