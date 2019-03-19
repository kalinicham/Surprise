<?php
class Kalinich_Surprise_Block_Cart_Item_Renderer extends Mage_Checkout_Block_Cart_Item_Renderer {

    protected function _isSurprise($productId)
    {
        $cart = Mage::getSingleton('checkout/cart');

        foreach ($cart->getItems() as $collectionItem) {
            if (($collectionItem->getName() == 'Kalinich_Surprise') && ($collectionItem->getProductId() == $productId)){
                return true;
            }
        }
        return false;
    }

    public function getProductName()
    {
        if ($this->_isSurprise($this->getProduct()->getId())) {
            return 'Kalinich_Surprise';
        }
        return parent::getProductName();

       /*  return $this->getProduct()->getCustomOptions()['info_buyRequest']->getItem()->getName();*/
    }


    public function escapeHtml($data, $allowedTags = null)
    {
        if ($this->_isSurprise($this->_item->getProduct()->getId()))
        {
            $this->_item->setData('sku','surprise');
        }
        return parent::escapeHtml($data, $allowedTags = null);
    }

public function isOnCheckoutPage() {
    if ($this->_isSurprise($this->_item->getProduct()->getId()))
    {
        return true;
    }
    return false;
}

}