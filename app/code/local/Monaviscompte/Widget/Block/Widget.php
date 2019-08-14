<?php
class Monaviscompte_Widget_Block_Widget extends Mage_Core_Block_Abstract implements Mage_Widget_Block_Interface {
/**
  * Produce the HTML code of a widget
  *
  * @return string
  */
  protected function _toHtml() {
    $itemId = self::getData('item_id');
    $accessKey = self::getData('access_key');
  
  	$itemId = str_replace(' ', '', $itemId);
  	$accessKey = str_replace(' ', '', $accessKey);
  
  	return
  		'<div id="widget-' . $itemId .'">'
		. '<script type="text/javascript" src="http://local.monaviscompte.fr/widget?id=' . $itemId . '&public_key=' . $accessKey . '&div=widget-' . $itemId . '"></script>'
		. '</div>';
  }
}