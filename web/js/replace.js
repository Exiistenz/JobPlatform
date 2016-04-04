/**
 * Created by johan on 11/12/15.
 */
$(document).ready(function () {
    var text = $('#project_appli_visitor_search label');
    var checkbox = $('#project_appli_visitor_search input:checkbox');
    checkbox.hide();

    for (var i = 0; i < text.length; i++) {
        $(checkbox[i]).addClass('checkbox' + i);
        if (checkbox[i].defaultChecked == true) {
            $("<input style='margin-left:6px;' type='radio' name='" + i + "'  value='non'  class='" + i + "'><span style=\'margin-right:22px\';>Non</span></input>").insertAfter(text[i]);
            $("<input style='margin-left:6px;' type='radio' name='" + i + "' value='yes'  checked class='" + i + "'>Oui</input>").insertAfter(text[i]);
        } else {
            $("<input style='margin-left:6px;' type='radio' name='" + i + "'  value='non' checked  class='" + i + "'><span style=\'margin-right:22px\';>Non</span></input>").insertAfter(text[i]);
            $("<input style='margin-left:6px;' type='radio' name='" + i + "' value='yes'  class='" + i + "'>Oui</input>").insertAfter(text[i]);
        }
    }
    $('#project_appli_visitor_search input:radio').on('click', function (e) {
        if (e.target.defaultValue == "yes") {
            $('.checkbox' + e.target.className).prop('checked', true);
        } else if (e.target.defaultValue == "non") {
            $('.checkbox' + e.target.className).prop('checked', false);
        }
    });
});