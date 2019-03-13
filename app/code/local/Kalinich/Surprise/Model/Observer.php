<?php

class Kalinich_Surprise_Model_Observer {

    static protected $_singletonFlag = false;

    /* @param Varien_Event_Observer $observer
     */

    public function addSurpriseToCart($observer) {
        $a = 1;
    }

    public function saveProductSurpriseData($observer) {
        if (!self::$_singletonFlag) {
            self::$_singletonFlag = true;
        }

        $productId = $observer->getEvent()->getProduct()->getEntityId();
        
        $model = Mage::getModel('kalinich_surprise/surprise');

        $outProducts = Mage::app()->getRequest()->getParam('product_ids',null);
//        $out1 = Mage::helper('adminhtml/js')->decodeGridSerializedInput($outProducts);
        $inProducts = $model->getProductColletion($productId);
        if (!is_null($outProducts) && $outProducts == "") {
            $delProductId = $inProducts;
        }elseif (!is_null($outProducts) && !is_null($inProducts)) {
            $outProducts = explode('&',trim(trim($outProducts,'on'),'&'));
            $saveProductId = array_diff($outProducts,$inProducts);
            $delProductId = array_diff($inProducts,$outProducts);
        }elseif (!is_null($outProducts)) {
            $saveProductId  = explode('&',trim(trim($outProducts,'on'),'&'));
        }



        try {

            if (isset($delProductId)) {
                $collection = Mage::getModel('kalinich_surprise/surprise')->getCollection()
                    ->addFieldToFilter('surprise_id',array('in' => $delProductId));
                foreach ($collection as $item) {
                    $item->setIsActive(false)->save();
                }
            }

            if (isset($saveProductId)) {
                foreach ($saveProductId as $product) {
                    $saveItem = Mage::getModel('kalinich_surprise/surprise')
                        ->addData(array('product_id' => $productId))
                        ->addData(array('surprise_id' => $product))
                        ->addData(array('is_active' => true));
                    /* @var $model Kalinich_Surprise_Model_Surprise*/
                    $model = Mage::getModel('kalinich_surprise/surprise')->getCollection()
                                ->addFieldToFilter('product_id', $productId)
                                ->addFieldToFilter('surprise_id', $product);

                    $id = $model->getData()[0]['id'];

                    if ($id !== null) {
                        $saveItem->addData(array('id' => $id));
                    }

                    $saveItem->save();
                }
            }

        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

    }

    public function getProduct()
    {
        return Mage::registry('product');
    }

    protected function _getRequest()
    {
        return Mage::app()->getRequest();
    }

}