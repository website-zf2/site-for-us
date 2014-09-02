/**
 * Created by Bob on 14-8-5.
 */
function hiddenForm(obj_form)
{
    $(obj_form).find("fieldset").each(function(){
        hiddenFieldset($(this))
    });


    if($(obj_form).find(".looksup-container").length!=0)
    {

        $(obj_form).find(".looksup-container").each(function(){
            $(this).parents("tr:first").hide();
            var showValue = "";
            $(this).find(".search-choice").find("span").each(function(){
                showValue +=$(this).text()+"<br/>";
             });
            $(this).parents("tr:first").before('<tr class="form-element-show looksup-show" element-name="'+$(this).find(".looksup-choices").attr("id")+'"><td class="form-label"><label><span>'+$(this).parents("tr:first").find("td:first").find("label").html()+'</span></label></td><td class="form-input">'+showValue+'</td></tr>');

        });
    }
    if($(obj_form).find(":input[name='ProductBasic[ProductName]']").length!=0)
    {
        var temp_obj = $(obj_form).find(":input[name='ProductBasic[ProductName]']");
        $(temp_obj).before("<span class='form-element-show' element-name='"+$(temp_obj).attr("name")+"'>"+$(temp_obj).val()+"</span>");
            $(temp_obj).hide();
    }

    //add special icon behind special label

//    $(".form-element-show[element-name='ProductFeatureCloudFocused']").children(".form-label").append("<span class='product-icons-feature-c icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureRemoteAccess']").children(".form-label").append("<span class='product-icons-feature-ra icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureEnergyEfficient']").children(".form-label").append("<span class='product-icons-feature-se icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureImproveHealth']").children(".form-label").append("<span class='product-icons-feature-ih icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureImproveSafety']").children(".form-label").append("<span class='product-icons-feature-is icon-grayscale'></span>")
//
//    $(".form-element-show[element-name='ProductFeatureOSCompatibility'][value='1']").children(".form-label").append("<span class='product-icons-os-1 icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureOSCompatibility'][value='2']").children(".form-label").append("<span class='product-icons-os-2 icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureOSCompatibility'][value='3']").children(".form-label").append("<span class='product-icons-os-3 icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureOSCompatibility'][value='5']").children(".form-label").append("<span class='product-icons-os-5 icon-grayscale'></span>");
//
//    $(".form-element-show[element-name='ProductFeatureConnectivity'][value='1']").children(".form-label").append("<span class='product-icons-connectivity-1 icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureConnectivity'][value='4']").children(".form-label").append("<span class='product-icons-connectivity-4 icon-grayscale'></span>");
//    $(".form-element-show[element-name='ProductFeatureConnectivity'][value='2']").children(".form-label").append("<span class='product-icons-connectivity-2 icon-grayscale'></span>");

//    $(".form-element-show[element-name='ProductFeaturePowerSupply']").each(function(){
//        if($(this).find("label").text().indexOf("Cable/Adapter")!=-1)
//        {
//            $(this).children(".form-label").append("<span class='product-icons-power-cable icon-grayscale'></span>");
//        }
//        else if($(this).find("label").text().indexOf("Battery")!=-1)
//        {
//            $(this).children(".form-label").append("<span class='product-icons-power-battery icon-grayscale'></span>");
//        }
//    });

    //adjustment label and icon make vertical middle
//    $(".form-label>.icon-grayscale").each(function(){
//
//        var obj_grayIcon = $(this);
//        var grayIcon_height = $(obj_grayIcon).height();
//        var obj_label = $(obj_grayIcon).siblings("label");
//        var label_height = $(obj_label).height();
//        var obj_td = $(obj_grayIcon).parents("td:first");
//        var td_height = grayIcon_height > label_height ? grayIcon_height : label_height;
//        $(obj_td).css({position: "relative", height: td_height});
//        $(obj_grayIcon).css({position: "absolute", right: "20px", top: grayIcon_height/2+(td_height-grayIcon_height)/2});
//        $(obj_label).css({position: "absolute", right: "41px", top: label_height/2+(td_height-label_height)/2});
//    });


//return ;
    //checkbox re-order
//    $("#ProductSoftware, #ProductFeature, #ProductConnectivity").each(function(){
//        var yes_index = 0;
//        var no_index = 0;
//        var fieldset_check_yes = {};
//        var fieldset_check_no = {};
//
//        $(this).find(".icon-checkbox-No").each(function(){
//            if($(this).parents("tr:first").attr("element-name")!="ProductFeatureNoDependencyHardWare" &&  $(this).parents("tr:first").attr("element-name")!="ProductFeatureAPI")
//            {
//                fieldset_check_no[no_index++] = $(this).parents("tr:first").prop('outerHTML');
//                $(this).parents("tr:first").remove();
//            }
//        });
//
//        $(this).find(".icon-checkbox-Yes").each(function(){
//            if($(this).parents("tr:first").attr("element-name")!="ProductFeatureNoDependencyHardWare" &&  $(this).parents("tr:first").attr("element-name")!="ProductFeatureAPI")
//            {
//                fieldset_check_yes[yes_index++] = $(this).parents("tr:first").prop('outerHTML');
//                $(this).parents("tr:first").remove();
//            }
//        });
//
//
//
//        if(true)
//        {
//            if($(this).attr("id")== "ProductSoftware")
//            {
//                for (j = (no_index-1); j>=0; j--)
//                {
//                    $(this).find('tbody').prepend(fieldset_check_no[j]);
//                }
//
//                for (j = (yes_index-1); j>=0; j--)
//                {
//                    $(this).find('tbody').prepend(fieldset_check_yes[j]);
//                }
//
//
//            }
//            else
//            {
//                for (j in fieldset_check_yes)
//                {
//                    $(this).find('tbody').append(fieldset_check_yes[j]);
//                }
//                for (j in fieldset_check_no)
//                {
//                    $(this).find('tbody').append(fieldset_check_no[j]);
//                }
//            }
//
//        }
//    });


}
function hiddenFieldset(obj_fieldset)
{
    $(obj_fieldset).find(":input[type!='hidden']").not('button').each(function(){

        hiddenElement($(this));

    });


}

function hiddenElement(obj_element)
{
    showElementValue(obj_element);
    $(obj_element).parents("tr:first").hide();
    if($(obj_element).hasClass("looksup-input"))
    {
        $(obj_element).parents(".looksup-container").hide();
    }
}

function showElementValue(obj_element)
{
    var i =0;
    var show_tr_items = {};
    var  showValue = "";
    var tr_class= "";
    var td_label = "";
    var tr_value = "";
    var element_name = $(obj_element).attr("name");
    if(element_name==undefined)
        return ;
    tr_class = element_name.replace(/[\W]/g, "");
    tr_label = $(obj_element).parents("tr:first").find("td:first").html();
    tr_value =$(obj_element).val();
    if($(obj_element).is('select'))
    {
        if($(obj_element).hasClass("data-select"))
        {
            if($(obj_element).hasClass("select-year"))
            {
                showValue = switchMonthly($(obj_element).parent().children(".select-month").children("option:selected").val()) + " "+$(obj_element).parent().children(".select-day").children("option:selected").text()+", "+$(obj_element).parent().children(".select-year").children("option:selected").text() ;
                if(differDate!="")
                    showValue += " <span style='font-size: 11px; color: #7f7f7f'>("+differDate+")</span>";
                show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};
            }
            else
            {
                return ;
            }
        }
        else if($(obj_element).attr("name")=='productRegionalAvailability[RegionalAvailability][]')
        {
            $(obj_element).children("option:selected").each(function(){
                showValue= "<span style='width:75px; display: inline-block'>"+$(this).text() +"</span><span class='fancyButton clickOut'>15 shops</span>";
                tr_label  = "<label ><span class='flag-icon-1'></span></label>";
                show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};
            });
        }
        else if($(obj_element).hasClass("not-show-list"))
        {
            $(obj_element).children("option:selected").each(function(){
                 if($(obj_element).attr("name")=="ProductFeature[OSCompatibility][]")
                {
                    showValue += "<span class='product-icons-os-"+$(this).val()+" icon-grayscale icon-grayscale-withoutMargin'></span><br/>";

                    //<span class='product-icons-connectivity-2 icon-grayscale'></span>
                }
                else if($(obj_element).attr("name")=="ProductFeature[Connectivity][]")
                {
                    showValue += "<span class='product-icons-connectivity-"+$(this).val()+" icon-grayscale icon-grayscale-withoutMargin'></span><br/>";
                }
                else if($(obj_element).attr("name")=="ProductFeature[PowerSupply][]")
                {
                    if($(this).text().indexOf("Cable/Adapter")!=-1)
                    {
                        showValue +="<span class='product-icons-power-cable icon-grayscale icon-grayscale-withoutMargin'></span><br/>";
                    }
                    else if($(this).text().indexOf("Battery")!=-1)
                    {
                        showValue +="<span class='product-icons-power-battery icon-grayscale icon-grayscale-withoutMargin'></span><br/>";
                    }
                }
                else
                {
                    showValue += $(this).text()+"<br/>";
                }
            });

            if($(obj_element).attr("name")=="ProductBasic[Status]" && $(obj_element).val()=="5")
            {
                showValue = "<b><font color='green'>"+showValue+"</font></b>";
            }


            show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};

        }//multi select to checkboxes list
        else
        {
            $(obj_element).children("option:selected").each(function(){
                tr_label = "<label>"+$(this).text()+"</label>";
                showValue = "<span class='icon-checkbox-Yes'></span>";
                show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};
            });
        }
    }
    else if($(obj_element).is(':checkbox'))
    {
            if(showValue= $(obj_element).is(':checked'))
            {
                if($(obj_element).siblings(".multi-checkbox-value").length!=0)
                    tr_label = "<label>"+$(obj_element).siblings(".multi-checkbox-value").text()+"</label>";
                showValue = "<span class='icon-checkbox-Yes'></span>";
                show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};
            }
            else if($(obj_element).attr("name")=="ProductFeature[NoDependencyHardWare]" || $(obj_element).attr("name")=="ProductFeature[MonthlyServiceFee]" || $(obj_element).attr("name")=="ProductFeature[CloudFocused]"  )
            {
                if($(obj_element).siblings(".multi-checkbox-value").length!=0)
                    tr_label = "<label>"+$(obj_element).siblings(".multi-checkbox-value").text()+"</label>";
                showValue = "<span class='icon-checkbox-No'></span>";
                show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};
            }
    }
    else if($(obj_element).hasClass("dimensions"))
    {
            if($(obj_element).hasClass("height") || $(obj_element).hasClass("width") || $(obj_element).hasClass('depth'))
            {
                showValue = "<span class='dimensions-wight-value'>"+addCommas($(obj_element).val()) +  " <font>inches ('')</font></span> <span class='dimensions-wight-value'> "+addCommas($(obj_element).siblings("input[unit=cm]").val()) + " <font>centimeters (cm)</font></span> <span class='dimensions-wight-value'> "+addCommas($(obj_element).siblings("input[unit=mm]").val()) + " <font>millimeters (mm)</font></span>";
                tr_label = "<label>"+$(obj_element).attr("placeholder")+"</label>";
                show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};
            }
            else
            {
                return ;
            }
    }
    else if($(obj_element).hasClass("weight"))
    {
        if($(obj_element).hasClass("master"))
        {
            showValue = "<span class='dimensions-wight-value'> "+addCommas($(obj_element).siblings("input[unit=lb]").val()) + " <font>pounds (lb)</font></span> <span class='dimensions-wight-value'>"+addCommas($(obj_element).val()) +  " <font>grams (g)</font></span>  <span class='dimensions-wight-value'> "+addCommas($(obj_element).siblings("input[unit=oz]").val()) + " <font>ounces (oz)</font></span>";
            tr_label = "<label>"+$(obj_element).attr("placeholder")+"</label>";
            show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};
        }
        else
        {
            return ;
        }
    }
    else if($(obj_element).val()!=undefined){
        showValue = $(obj_element).val().replace(/\n/gi, '<br />');
        if(IsURL(showValue))
        {
            if(showValue.indexOf("http")==-1)
                showValue ="http://"+showValue;

            if($(obj_element).attr("name")=="ProductBasic[Website]" || $(obj_element).attr("name")=="ProductFeature[ProductInstallationGuide]" || $(obj_element).attr("name")=="ProductFeature[APIWebsite]")
            {
                showValue = "<a href='" + showValue + "' target='_blank' style='text-decoration: none !important;'><span class='icon-blueArrow'></span> Open in new tab</a>";
            }
            else
            showValue = "<a href='" + showValue + "' target='_blank' style='font-weight: bold;text-decoration: underline !important;'>" + showValue + "</a>";
        }


        show_tr_items[i++] = {tr_class:tr_class, td_label: tr_label, td_value:showValue, tr_value:tr_value};
    }


    if(true || show_tr_items.length > 0)
    {
        for (j in show_tr_items)
        {
            show_tr = show_tr_items[j];
            if(show_tr.td_value!="")
                $(obj_element).parents("tr:first").before('<tr class="form-element-show" element-name="'+show_tr.tr_class+'" value="'+show_tr.tr_value+'"><td class="form-label">'+show_tr.td_label+'</td><td class="form-input">'+show_tr.td_value+'</td></tr>');
        }
    }

}

function IsURL(str_url)
{
    var strRegex ="^((https{0,1}:\\/\\/(www\\.){0,1})|(ftp:\\/\\/www\\.)|(www\\.))[\\w\\-\\.@:%\\?\\+~#=]+";
    var re=new RegExp(strRegex);

    return re.test(str_url);
}

function showFieldset(show_fieldset)
{
    $(show_fieldset).find(".form-element-show").hide();
    $(show_fieldset).find(".form-element").show();
}

function showElement( show_element )
{
    $(show_element).hide();
    var element_name = $(show_element).attr("element-name");
    if(element_name=="ProductBasic[ProductName]")
    {
        $(":input[name='ProductBasic[ProductName]']").show();
        return;
    }
    $(show_element).siblings("tr.form-element-show[element-name="+element_name+"]").hide();

    if($(show_element).hasClass("looksup-show"))
    {
        $(show_element).siblings("tr.form-element").find("ul[id="+element_name+"]").parents("tr:first").show();
        return ;
    }

    $(show_element).siblings("tr.form-element").find(":input[type!='hidden']").not('button').each(function(){
        if($(this).attr("name")!=undefined && $(this).attr("name").replace(/[\W]/g, "")==element_name)
        {
            $(this).parents("tr:first").show();
            return;
        }
    });

//    $(show_element).parents("fieldset").find("i")
//    $(show_span).siblings(".multi-checkbox-value").show();

}

function showAndHide(checkboxname,hiddenelementnamearray)
{
        if($(':input[name="'+checkboxname+'"]').is(':checked')==true)
        {
            for(i=0;i<hiddenelementnamearray.length;i++)
                $(':input[name="'+hiddenelementnamearray[i]+'"]').parents("tr").show();
        }
        else
        {
            for(i=0;i<hiddenelementnamearray.length;i++)
            {
                $(':input[name="'+hiddenelementnamearray[i]+'"]').parents("tr").hide();
            }
        }
}

function switchMonthly(month)
{

    var months = new Array();
    months[1] = "January";
    months[2] = "February";
    months[3] = "March";
    months[4] = "April";
    months[5] = "May";
    months[6] = "June";
    months[7] = "July";
    months[8] = "August";
    months[9] = "September";
    months[10] = "October";
    months[11] = "November";
    months[12] = "December";
    return months[month];
}

$(document).ready(function(){
    $(".form-element").click(function(){
        if($(this).find(":input[type=checkbox]").length==1 && $(this).find(".multi-checkbox-item").length==0)
        {
            $(this).find(":input[type=checkbox]").trigger("click");
        }
    });

    $(".multi-checkbox-value").click(function(){
       $(this).siblings(":input[type=checkbox]").trigger("click");
    });

    $(":input[type=checkbox]").click(function(e){
        e.stopPropagation();
    });


});

