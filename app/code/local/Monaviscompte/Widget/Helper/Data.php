<?php
class Monaviscompte_Widget_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getSettings() 
	{
		$itemId = Mage::getStoreConfig('mac_widget/general/item_id');
		$accessKey = Mage::getStoreConfig('mac_widget/general/access_key');
		$apiKey = Mage::getStoreConfig('mac_widget/general/api_key');
		
		return array('itemId' => $itemId, 'accessKey' => $accessKey, 'apiKey' => $apiKey);
	}
}