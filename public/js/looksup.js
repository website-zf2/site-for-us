/**
 * Created by Bob on 14-7-30.
 */
$(document).ready(function(){

    $(".looksup").click(function(){
        var obj = $(this).siblings('.looksup_obj');
        url = "/" + $(obj).attr("controller") + "/looksup?obj="+$(obj).attr("objid");
        TINY.box.show(url, 1, 700, 380, 1);
    });

    $(".looksup-choices").on("click", '.search-choice-close',function(){
        $(this).parents("li").remove();
    });

    $(document).keyup(function(e){
        if(e.keyCode == 27)
        {
            removePopup();
        }
    });

});

function removePopup()
{
    if( $("#tinytop").length == 1 && $("#tinycontent").length == 1)
    {
        TINY.box.remove();
    }
}
