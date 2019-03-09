<?php

class Kalinich_Surprise_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout();
        echo 'Kalinich_Surptise_IndexController work';
        $this->renderLayout();
    }
}