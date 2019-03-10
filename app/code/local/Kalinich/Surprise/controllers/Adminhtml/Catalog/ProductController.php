<?php

class Kalinich_Surprise_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Controller_Action {

    public function kalinichsurpriseAction() {
        $id = $this->getRequest()->getParam('id');

        $model = null;
        if ($id) {
            $model = Mage::getModel('kalinich_surprise/surprise')->load($id);
        } else {
            $model = Mage::getModel('kalinich_surprise/surprise');
        }

        Mage::register('surprise_block', $model);

        $this->loadLayout();
        $this->renderLayout();
    }

    public function kalinichsurprisegridAction() {
        $id = $this->getRequest()->getParam('id');

        $model = null;
        if ($id) {
            $model = Mage::getModel('kalinich_surprise/surprise')->load($id);
        } else {
            $model = Mage::getModel('kalinich_surprise/surprise');
        }

        Mage::register('surprise_block', $model);

        $this->loadLayout();
        $this->renderLayout();
    }
}