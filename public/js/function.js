/**
 * Created by Bob on 14-7-28.
 */
$(document).ready(function(){

    //init smart picklist
    $(".single_select").chosen({placeholder_text_multiple: "Please select...", placeholder_text_single: "Please select..."});

    //hidden upload file input
    $(":input[type='file']").hide();

//    $(".form-label>label[title]").attr("style", "border: 1px solid #e0e0e0; ");


});

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}