<?php

class Kalinich_Surprise_Model_Resource_Surprise_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

  public function _construct()
  {
      parent::_construct();
      $this->_init('kalinich_surprise/surprise');
  }

}