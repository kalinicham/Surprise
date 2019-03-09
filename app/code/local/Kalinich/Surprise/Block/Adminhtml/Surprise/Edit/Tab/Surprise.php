<?php

class Kalinich_Action_Block_Adminhtml_Action_Edit_Tab_Category extends Mage_Adminhtml_Block_Widget_Grid
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('category');
        $this->setDefaultSort('id');
        $this->setUseAjax(true);
        if ($this->getCurrentAction() && $this->getCurrentAction()->getId()) {
            $this->setDefaultFilter(array('in_category' => 1));
        }
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/categorygrid', array('_current' => true));
    }

    protected function getCurrentAction() {
        return Mage::registry('action_block');
    }

    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == 'in_category') {
            $categoryIds = $this->getSelectedCategory();
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $categoryIds));
            } else {
                if($categoryIds) {
                    $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $categoryIds));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    public function _prepareCollection() {
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $this->addColumn('in_category', array(
            'header_css_class'  => 'a-center',
            'type'              => 'checkbox',
            'name'              => 'in_products',
            'values'            => $this->getSelectedCategory(),
            'align'             => 'center',
            'index'             => 'entity_id'
        ));
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('kalinich_action')->__('ID'),
            'align'     => 'left',
            'index'     => 'entity_id',
            'width'     => '10'
        ));
        $this->addColumn('nameProduct', array(
            'header'    => Mage::helper('kalinich_action')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
            'width'     => '255'
        ));

        $this->addColumn('typeProduct', array(
            'header'    => Mage::helper('kalinich_action')->__('Type'),
            'align'     => 'left',
            'index'     => 'type_id',
            'width'     => '255'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('kalinich_action')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku',
            'width'     => '255'
        ));

        $this->addColumn('visibility', array(
            'header'    => Mage::helper('kalinich_action')->__('Visibility'),
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
            'header'    => Mage::helper('kalinich_action')->__('Price'),
            'align'     => 'left',
            'index'     => 'price',
            'width'     => '250px',
            'type'      => 'price',
            'currency_code' => Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'editable'  => true
        ));
        return parent::_prepareColumns();
    }

    public function getSelectedCategory()
    {
        $categoryIds = Mage::app()->getRequest()->getParam('category_ids_reload',null);
        if (is_null($categoryIds) || !is_array($categoryIds)) {
            $product = Mage::registry('action_block');
            $categoryIds = $product->getProductColletion();
        }
        return $categoryIds;
    }

    public function getTabLabel()
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
    }
}