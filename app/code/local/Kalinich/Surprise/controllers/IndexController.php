<?php

class Kalinich_Surprise_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $collection = Mage::getModel('kalinich_surprise/surprise')->getCollection();

        var_dump((string)$collection->getData());
    }
}