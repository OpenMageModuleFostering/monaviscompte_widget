<?php
class Monaviscompte_Widget_Block_Widget extends Mage_Core_Block_Abstract implements Mage_Widget_Block_Interface {
 /**
  * Produce the HTML code of a widget
  *
  * @return string
  */
  protected function _toHtml() 
  {
    $itemId = Mage::getStoreConfig('mac_widget/general/item_id');
	$accessKey = Mage::getStoreConfig('mac_widget/general/access_key');

  	return
  		'<div id="widget-' . $itemId .'">'
		. '<script type="text/javascript" src="https://www.monaviscompte.fr/widget?id=' . $itemId . '&public_key=' . $accessKey . '&div=widget-' . $itemId . '"></script>'
		. '</div>';
  }
}