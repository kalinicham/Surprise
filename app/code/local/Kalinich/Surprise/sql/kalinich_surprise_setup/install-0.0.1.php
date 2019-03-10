<?php

/**
 *  @var Mage_Core_Model_Resource_Setup $installer
 */

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('kalinich_surprise/surprise');
$tableProduct = $installer->getTable('catalog/product');

$table = $installer->getConnection()->newTable($tableName)
    ->addColumn('id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'identity'  =>  true,
        'unsigned'  =>  true,
        'nullable'  =>  false,
        'primary'   =>  true
    ),'ID of row')
    ->addColumn('surprise_id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'nullable'  =>  true,
    ),'id Surprise')
    ->addColumn('product_id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'nullable'  =>  true,
    ),'id Product')
    ->addForeignKey('FK_KALINICH_SURPRISE_SP_CP','surprise_id',$tableProduct,'entity_id',Varien_Db_Ddl_Table::ACTION_CASCADE,Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey('FK_KALINICH_SURPRISE_PP_CP','product_id',$tableProduct,'entity_id',Varien_Db_Ddl_Table::ACTION_CASCADE,Varien_Db_Ddl_Table::ACTION_CASCADE);

$table->addIndex($indexName, array('id'), array(
        'type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    )
);

$installer->getConnection()->createTable($table);

$installer->endSetup();