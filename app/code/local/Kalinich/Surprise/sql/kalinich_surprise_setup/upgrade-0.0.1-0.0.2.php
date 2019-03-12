<?php
/**
 *  @var Mage_Core_Model_Resource_Setup $installer
 */

$installer = $this;
$installer->startSetup();



$tableName = $installer->getTable("kalinich_surprise/surprise");

$installer->getConnection()
       ->addColumn($tableName,'count_order',array(
            'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
            'nullable' => false,
            'after' => 'surprise_id',
            'default' => '0',
            'comment' => 'Count in oreder'
        ))
        ->addColumn($tableName,'is_active',array(
            'type' => Varien_Db_Ddl_Table::TYPE_BOOLEAN,
            'nullable' => false,
            'after' => 'count_order',
            'default' => false,
            'comment' => 'Activ for product'
        ));

$installer->endSetup();