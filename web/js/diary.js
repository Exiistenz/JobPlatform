/**
 * Created by laurent on 11/12/15.
 */
//advisor
function checkAllDays()
{
    $('.checkable').prop('checked', $('.checkAll').is(':checked'));
    $('input[class^="checkDay_"]').prop('checked', $('.checkAll').is(':checked'));
}
function checkOneDay(day)
{
    $('input[id^="'+day+'"]').prop('checked', $('.checkDay_'+day).is(':checked'));
}
function buildMatrix()
{
    var matrix = [];
    $('.checkable').each(function(){
        if($(this).is(':checked')){
            matrix.push(this.id)
        }
    });
    $('#project_appli_disponibility_matrix').val(JSON.stringify(matrix));
    return true;
}

function copyPreviousWeek()
{
    var url = $('#ajax-diary-advisor a').attr('href');
    $.ajax({
        statusCode: {
            404: function() {
                //@TODO à refacto dans un template twig
                $('div.page-content').prepend('<div class="message-block info-message"><p class="alert-info">Vous n\'avez rien planifié la semaine précédente</p></div>');
            },
            500: function() {
                $('div.page-content').prepend('<div class="message-block error-message"><p class="alert-error">Erreur interne, l\'action n\'a pas pu être exécutée</p></div>');
            }
        },
        url: url,
    })
    .done(function( matrix ) {
        $(':checked').removeAttr('checked');
        jsonMatrix = JSON.parse(matrix);
        for (var indispo in jsonMatrix) {
            $('#'+jsonMatrix[indispo]).prop('checked', true);
        }
    });
}

//visitor
function getAgendaAdvisor(advisor_id)
{
    var url = $('#ajax-diary-visitor a').attr('href');
    var advisor_id = $('#project_appli_appointment_advisor').val();
    $.ajax({
        statusCode: {//si 404 afficher un message d'erreur
            404: function () {
                $('div.page-content').prepend('<div class="message-block info-message"><p class="alert-info"></p>Le conseiller n\'a pas été trouvé</div>');
            },
            500: function () {
                //@TODO à refacto dans un template twig
                $('div.page-content').prepend('<div class="message-block error-message"><p class="alert-error">Erreur interne, l\'action n\'a pas pu être exécutée</p></div>');
            }
        },
        url: url+"?advisor_id="+advisor_id,
    })
    .done(function( data ) {
        $('#advisorDiary').html(data);
    });
}