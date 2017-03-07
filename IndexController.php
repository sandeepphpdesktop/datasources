<?php

class Mindtree_Listorder_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        echo 'Hello developer...';
        exit;
    }

    public function sayHelloAction() {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        /**
         * Get the table name
         */
        $collection = Mage::getModel('sales/order')
                        ->getCollection()
                //      ->addFieldToFilter('state',Array('eq'=>Mage_Sales_Model_Order::STATE_NEW))
                        ->addAttributeToSelect('*');
        //var_dump($collection);
        foreach($collection as $order)
        {
            foreach ($order->getAllItems() as $itemId => $item){
                $name=$item->getName();
            }
            
            $json['products'][] = array(
                'id' => $order->getIncrementId(),
                'order_status' => $order->getStatus(),    
                'total' => $order->getIncrementId(),
                'total_items' => $name, 
                'total_invoiced' => $order->getStatus(), 
            );
        }
        var_dump(json_encode($json));
//        $tableName = $resource->getTableName('sales/order');
//
//        $saleafield = $readConnection->describeTable($tableName);
//        var_dump($saleafield);
//        foreach ($saleafield as $order) {
//            $json['products'][] = array(
//                'id' => $order->getEntityId(),
//                'name' => $order->getState(),
//                'href' => $order->getStatus(),                
//            );
//        }
//        $json = array('success' => true);
//	$products = Mage::getModel('catalog/product')->getCollection();
//	$products->addAttributeToSelect(array('name', 'thumbnail', 'price')); //feel free to add any other attribues you need.
//	Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
//	Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products); 
//	$products->getSelect()->order('RAND()')->limit($limit);
//	foreach($products as $product){ 
//		$json['products'][] = array(
//				'id'		=> $product->getId(),
//				'name'		=> $product->getName(),
//				'href'		=> $product->getProductUrl(),
//				'thumb'		=> (string)Mage::helper('catalog/image')->init($product, 'thumbnail'),
//				'pirce'		=> Mage::helper('core')->currency($product->getPrice(), true, false) //." ".$currencyCode,
//			);
//	}
       // var_dump($json);
        //exit;
    }

}

?>