<?php

class Kalinich_Surprise_Model_Resource_Surprise extends Mage_Core_Model_Resource_Db_Abstract {

    public function _construct()
    {
        $this->_init('kalinich_surprise/surprise','id');
    }

}