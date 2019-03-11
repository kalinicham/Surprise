<?php

class Kalinich_Surprise_Block_Adminhtml_Catalog_Product_Tab_Product extends Mage_Adminhtml_Block_Widget_Grid
  //  implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('product');
        $this->setDefaultSort('id');
        $this->setUseAjax(true);
       /* if ($this->getCurrentAction() && $this->getCurrentAction()->getId()) {
            $this->setDefaultFilter(array('in_category' => 1));
        }*/
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/kalinichsurprisegrid', array('_current' => true));
    }

    protected function getCurrentAction() {
        return Mage::registry('surprise_block');
    }

  /*  protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == 'in_category') {
            $productIds = $this->getSelectedCategory();
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $productIds));
            } else {
                if($productIds) {
                    $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $productIds));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }*/

    public function _prepareCollection() {
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $this->addColumn('in_product', array(
            'header_css_class'  => 'a-center',
            'type'              => 'checkbox',
            'name'              => 'in_products',
            'values'            => $this->getSelectedProduct(),
            'align'             => 'center',
            'index'             => 'entity_id'
        ));
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('kalinich_surprise')->__('ID'),
            'align'     => 'left',
            'index'     => 'entity_id',
            'width'     => '10'
        ));
        $this->addColumn('nameProduct', array(
            'header'    => Mage::helper('kalinich_surprise')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
            'width'     => '255'
        ));

        $this->addColumn('typeProduct', array(
            'header'    => Mage::helper('kalinich_surprise')->__('Type'),
            'align'     => 'left',
            'index'     => 'type_id',
            'width'     => '255'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('kalinich_surprise')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku',
            'width'     => '255'
        ));

        $this->addColumn('visibility', array(
            'header'    => Mage::helper('kalinich_surprise')->__('Visibility'),
            'align'     => 'left',
            'index'     => 'visibility',
            'width'     => '255',
            'type'      => 'options',
            'options'   => array(
                1       => Mage::helper('cms')->__('NOT_VISIBLE'),
                2       => Mage::helper('cms')->__('IN_CATALOG'),
                3       => Mage::helper('cms')->__('IN_SEARCH'),
                4       => Mage::helper('cms')->__('BOTH'),
            ),
        ));


        $this->addColumn('price', array(
            'header'    => Mage::helper('kalinich_surprise')->__('Price'),
            'align'     => 'left',
            'index'     => 'price',
            'width'     => '250px',
            'type'      => 'price',
            'currency_code' => Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'editable'  => true
        ));
        return parent::_prepareColumns();
    }

    public function getSelectedProduct()
    {
        $surpriseIds = Mage::app()->getRequest()->getParam('product_ids_reload',null);
            if (is_null($surpriseIds) || !is_array($surpriseIds)) {

                /* @var $model  Kalinich_Surprise_Model_Surprise */

                $model = Mage::getModel('kalinich_surprise/surprise');
                $productId = Mage::registry('surprise_block');


                $surpriseIds = $model->getProductColletion($productId);
            }
        return $surpriseIds;
    }

 /*   public function getTabLabel()
    {
        return $this->__('Products');
    }

    public function getTabTitle()
    {
        return $this->__('Products');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }*/
}