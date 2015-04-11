<style>
.sel_wrap{height:25px}
.sel_wrap select{display:none}
.sel_imul{width:200px}
.sel_imul .sel_selected{position:relative;padding:0 0 0 14px}
.sel_imul.act .sel_selected{}
.sel_imul .sel_options{
background:#ededed;overflow:auto;position:absolute;width:186px;display:none;z-index:10;padding:7px 0 7px 14px;
-moz-box-shadow:0 3px 7px #555;-webkit-box-shadow:0 3px 7px #555;box-shadow:0 3px 7px #555}
.sel_options .sel_option, .selected-text{background-image:url(../modules/mod_jshopping_currencies/images/flags.gif);padding:0 0 0 27px;line-height:13px;color:#000;background-repeat:no-repeat;cursor:pointer;height:11px;margin:10px}
.selected-text span {border-bottom:1px dotted #666}
.sel_options .sel_option:hover span {border-bottom:1px solid #FFF}
<?php if ($eur){ ?>
#sel_option_<?php echo $eur;?>, #sel_option_selected_<?php echo $eur;?> {background-position:0 0}
<?php }
if ($usd){ ?>
#sel_option_<?php echo $usd;?>, #sel_option_selected_<?php echo $usd;?> {background-position:0 -11px}
<?php }
if ($rub){ ?>
#sel_option_<?php echo $rub;?>, #sel_option_selected_<?php echo $rub;?> {background-position:0 -22px}
<?php }
if ($uah){ ?>
#sel_option_<?php echo $uah;?>, #sel_option_selected_<?php echo $uah;?> {background-position:0 -33px}
<?php } ?>
</style>
<?php
    print $currencies_display_list;
?>
<script type="text/javascript">
function redesign(select, addclass) {

addclass = typeof(addclass) != 'undefined' ? addclass : '';

jQuery(select).wrap('<div class=\"sel_wrap ' + addclass + '\"/>');

var sel_options = '';

var selected_option = false;

jQuery(select).children('option').each(function() {

if(jQuery(this).is(':selected')){

selected_option = jQuery(this).index();

}
if(!jQuery(this).is(':selected')){
	sel_options = sel_options + '<div id= \"sel_option_'+jQuery(this).val()+'\" class=\"sel_option\" value=\"' + jQuery(this).val() + '\"><span>' + jQuery(this).html() + '</span></div>';
}
});



var sel_imul = '<div class=\"sel_imul\">\
<div class=\"sel_selected\">\
<div id= \"sel_option_selected_'+jQuery(select).children('option').eq(selected_option).val()+'\" class=\"selected-text\"><span>' + jQuery(select).children('option').eq(selected_option).html() + '</span></div>\
<div class=\"sel_arraw\"></div>\
</div>\
<div class=\"sel_options\">' + sel_options + '</div>\
</div>';

jQuery(select).before(sel_imul);

}

jQuery(document).ready(function(){

redesign('#id_currency');

jQuery('.sel_imul').live('click', function() {

jQuery('.sel_imul').removeClass('act');
jQuery(this).addClass('act');

if (jQuery(this).children('.sel_options').is(':visible')) {

jQuery('.sel_options').hide();

}
else {

jQuery('.sel_options').hide();
jQuery(this).children('.sel_options').show();

}

});
});


jQuery('.sel_option').live('click', function() {

var tektext = jQuery(this).html();
jQuery(this).parent('.sel_options').parent('.sel_imul').children('.sel_selected').children('.selected-text').html(tektext);
jQuery(this).parent('.sel_options').parent('.sel_imul').children('.sel_selected').children('.selected-text').attr('id', 'sel_option_selected_'+jQuery(this).attr('value'));

jQuery(this).parent('.sel_options').children('.sel_option').removeClass('sel_ed');
jQuery(this).addClass('sel_ed');

var tekval = jQuery(this).attr('value');
tekval = typeof(tekval) != 'undefined' ? tekval : tektext;
jQuery(this).parent('.sel_options').parent('.sel_imul').parent('.sel_wrap').children('select').children('option').removeAttr('selected').each(function() {
if (jQuery(this).val() == tekval) {

jQuery(this).attr('selected', 'select');

}
});
location.href='<?php echo $url;?>';
});


var selenter = false;

jQuery('.sel_imul').live('mouseenter', function() {

selenter = true;

});

jQuery('.sel_imul').live('mouseleave', function() {

selenter = false;

});
jQuery(document).click(function() {

if (!selenter) {

jQuery('.sel_options').hide();
jQuery('.sel_imul').removeClass('act');
}

});

</script>