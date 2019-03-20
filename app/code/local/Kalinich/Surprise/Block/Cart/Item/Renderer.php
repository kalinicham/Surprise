<?php
class Kalinich_Surprise_Block_Cart_Item_Renderer extends Mage_Checkout_Block_Cart_Item_Renderer {

    protected function getProductId() {
        return $this->getProduct()->getId();
    }

    protected function isSurprise($productId)
    {
        $cart = Mage::getModel('checkout/cart');
        foreach ($cart->getItems() as $collectionItem) {
            if (($collectionItem->getName() == 'Kalinich_Surprise') && ($collectionItem->getProductId() == $productId)){
                    return true;
            }elseif (($collectionItem->getOrigData('name') == 'Kalinich_Surprise') && ($collectionItem->getProductId() == $productId)) {
                return true;
            }
        }
        return false;
    }

    public function getProductName()
    {
        return ($this->isSurprise($this->getProductId()) ? 'Kalinich Surprise' : parent::getProductName());
    }

    public function getConfigureUrl()
    {
        return ($this->isSurprise($this->getProductId()) ? '#' : parent::getConfigureUrl());
    }


    public function isOnCheckoutPage()
    {
        return ($this->isSurprise($this->getProductId()) ? true : parent::isOnCheckoutPage());
    }

    public function getProductUrl()
    {
        return ($this->isSurprise($this->getProductId()) ? '#' : parent::getProductUrl());
    }

    public function getProductThumbnail()
    {
        if ($this->isSurprise($this->getProductId()))
        {
            $this->getProduct()->setData('thumbnail', '/s/u/surprise.png');
         }
        return parent::getProductThumbnail();
    }
      public function escapeHtml($data, $allowedTags = null)
      {
          if ($this->isSurprise($this->_item->getProduct()->getId()))
          {
              $this->_item->setData('sku','Kalinich Surprise');
          }
          return parent::escapeHtml($data, $allowedTags = null);
      }

      public function getQty()
      {
          if ($this->isSurprise($this->_item->getProduct()->getId()))
          {
              return $this->getItem()->getQty() . '" disabled "';
          }
          return parent::getQty();
      }

}