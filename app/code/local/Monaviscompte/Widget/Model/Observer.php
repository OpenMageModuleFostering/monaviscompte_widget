<?php

class Monaviscompte_Widget_Model_Observer 
{
	public function send_post_purchase_email($event) {
		$order = new Mage_Sales_Model_Order();
    	$incrementId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
    	$order->loadByIncrementId($incrementId);
		
		$data = array();
		$data['private_key'] = Mage::getStoreConfig('mac_widget/general/api_key');
		$data['order_id'] = $order->getId();
		$data['source'] = 'magento';
		$data['recipient'] = $order->getCustomerEmail();

		if (!empty($order->getCustomerName())) {
			$data['first_name'] = $order->getCustomerName();
		}
		
		$serializedProducts = array();

		$i = 0;
		foreach($order->getAllVisibleItems() as $item) {
			$productId = $item->getProductId();
			$productObject = Mage::getModel('catalog/product');
			$_product = $productObject->load($productId);
			$serializedProducts['products'][$i] = array(
				"id" => strval($productId),
				"name" => $_product->getName(),
				"summary" => $_product->getShortDescription(),
				"picture" => $_product->getImageUrl()
			);
			$i++;
		}
		
		$data['cart'] = json_encode($serializedProducts);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://api.monaviscompte.fr/post-purchase/create/");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10000);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10000);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_exec($curl);
		curl_close($curl);
	}
}