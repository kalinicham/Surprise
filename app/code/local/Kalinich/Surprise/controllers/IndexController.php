<?php

class Kalinich_Surprise_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        /* @var $collection Varien_Db_Select
         */
//        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection = Mage::getModel('catalog/product')->getCollection();
        $myTable = Mage::getModel('core/resource')->getTableName('kalinich_surprise/surprise');
        $collection->getSelect()->joinLeft(
            array('t1'=> $myTable),'e.entity_id = t1.surprise_id',
            array('count_order')
        );

        var_dump((string)$collection->getSelect());
        var_dump($collection->getData());
    }
}