<?php
/**
* @version      3.0.2 17.12.2012
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

    defined('_JEXEC') or die('Restricted access');
   
    if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'jshopping.php')){
        JError::raiseError(500,"Please install component \"joomshopping\"");
    }
	$eur = $params->get('eur');
	$usd = $params->get('usd');
	$rub = $params->get('rub');
	$uah = $params->get('uah');
    require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
    require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."jtableauto.php");
    require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'tables'.DS.'config.php'); 
    require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");

    JSFactory::loadCssFiles();

    JTable::addIncludePath(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'tables');
    $currency = JTable::getInstance('currency', 'jshop');

    $currencis_list = $currency->getAllCurrencies('1');

    $jshopConfig = JSFactory::getConfig();   
    $jshopConfig->loadCurrencyValue();
    
    $url = JRoute::_("index.php?option=com_jshopping&id_currency=idcurval&back=idbackval");
    $url = str_replace("idbackval", urlencode($_SERVER['REQUEST_URI']), $url);
    $url = str_replace("idcurval", "'+jQuery('#id_currency').val()+'", $url);    
    $currencies_display_list = JHTML::_('select.genericlist',$currencis_list,'id_currency','class = "inputbox" size = "1" onchange = "location.href=\''.$url.'\'"' ,'currency_id','currency_name',$jshopConfig->cur_currency);
    
    require(JModuleHelper::getLayoutPath('mod_jshopping_currencies'));   
?>