<?php
/**
 * Created by PhpStorm.
 * User: kalinicham
 * Date: 09.03.2019
 * Time: 22:41
 */

class Kalinich_Surprise_Helper_Data extends Mage_Core_Helper_Abstract {

    const IS_ACTIVE_ENABLED  = '1';

    public function getSurpriseId($addProductId) {
        /* @var $surpriseColection Kalinich_Surprise_Model_Surprise */
        $surpriseColection = Mage::getModel('kalinich_surprise/surprise')->getCollection()
            ->addFieldToFilter('product_id',$addProductId)
            ->addFieldToFilter('is_active', self::IS_ACTIVE_ENABLED)
            ->setOrder('count_order','ASC')->getItems();
        if (count($surpriseColection) > 0) {
            $idSurprise = array_shift($surpriseColection);
            return $idSurprise->getSurpriseId();
        }

        return false;
    }

}