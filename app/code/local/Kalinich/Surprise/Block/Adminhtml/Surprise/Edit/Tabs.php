<?php

class Kalinich_Surprise_Block_Adminhtml_Surprise_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('kalinich_surprise_tabs');
        $this->setDestElementId('edit_form');
    }

    protected function _beforeToHtml()
    {
        $this->addTab('kalinich_surprise', array(
            'label'     => $this->__('Kalinich_surprise'),
            'title'     => $this->__('Kalinich_surprise'),
            'url'       => $this->getUrl('*/*/kalinichsurprise', array('_current' => true)),
            'class'     => 'ajax'
        ));
        return parent::_beforeToHtml();
    }
}