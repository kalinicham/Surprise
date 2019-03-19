<?php
class Kalinich_Surprise_Model_ObserverCheckOut
{

     /* @param Varien_Event_Observer $observer
     */

    public function upDataSurprise($observer)
    {
        $productCollection = $observer->getEvent()->getQuote()->getItemsCollection();
        foreach ($productCollection as $product) {
            if ($product->getPrice() == 0 ) {
                $product->setName('Kalinich_Surprise');
            };
        }
        return $this;
    }

    public function updateCartPrice($observer)
    {
        if (Mage::registry('add_surprise')) {
            $event = $observer->getEvent();
            $quoteItem = $event->getQuoteItem();
            $quoteItem->setOriginalCustomPrice(0);
            $quoteItem->save();
        }
    }
    public function addSurpriseToCart($observer)
    {
        $helper = Mage::helper('kalinich_surprise/data');
        $addProductId = $observer->getProduct()->getEntityId();
        // Проверяем уловие добавление супрриза в корзину
        // $addPrductId - id добавленого продукта в корзину
        $_surpriseId = $helper->getSurpriseId($addProductId);
        if ($_surpriseId) {
            Mage::register('add_surprise', $_surpriseId);
            /* @var $cart Mage_Checkout_Model_Cart */
            $cart = Mage::getModel('checkout/cart');
            $storeId = Mage::app()->getStore()->getId();
            // задаем модель продукта
            $surprise = Mage::getModel('catalog/product')
                ->setStoreId($storeId)
                ->load($_surpriseId);

            // задаємо параметри для сюрприза згідно задачі
            $params['qty'] = 1;

            $cart->addProduct($surprise, $params);
            $cart->save();

            $session = Mage::getModel('checkout/session');
            $session->setCartWasUpdated(true);
        } else {
            Mage::register('add_surprise', false);
        }
    }
}