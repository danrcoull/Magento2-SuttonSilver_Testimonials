<?php


namespace SuttonSilver\Testimonials\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), "1.0.1", "<")) {
            $installer = $setup;

            //get current table
            $testTable = $installer->getTable('suttonsilver_testimonials_testimonial');
            // Check if the table already exists
            if ($setup->getConnection()->isTableExists($testTable) == true) {

                $setup->getConnection()->dropColumn($testTable, 'store_id');

                $setup->getConnection()->addColumn($testTable,
                    'profession',
                    [
                        'type' =>\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'size' =>512,
                        'comment'=>'Profession'
                    ]
                );

                $setup->getConnection()->addColumn($testTable,
                    'image',
                    [
                        'type' =>\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'size' =>512,
                        'comment'=>'Image'
                    ]
                );
                $setup->getConnection()->addColumn($testTable,
                        'is_active',
                        [
                            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            'size' =>null,
                            'nullable' => false, 'default' => '1',
                            'comment'=> 'Is Testimonial Active'
                        ]
                );

                $table = $installer->getConnection()->newTable(
                    $installer->getTable('suttonsilver_testimonials_store')
                )->addColumn(
                    'testimonial_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false, 'primary' => true,'unsigned' => true,],
                    'Testimonial ID'
                )->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Store ID'
                )->addIndex(
                    $installer->getIdxName('suttonsilver_testimonials_store', ['store_id']),
                    ['store_id']
                )->addForeignKey(
                    $installer->getFkName('suttonsilver_testimonials_store', 'testimonial_id', 'suttonsilver_testimonials_testimonial', 'testimonial_id'),
                    'testimonial_id',
                    $installer->getTable('suttonsilver_testimonials_testimonial'),
                    'testimonial_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )->addForeignKey(
                    $installer->getFkName('suttonsilver_testimonials_store', 'store_id', 'store', 'store_id'),
                    'store_id',
                    $installer->getTable('store'),
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )->setComment(
                    'Sample To Store Linkage Table'
                );
                $installer->getConnection()->createTable($table);
            }
            
            
            

        }


        if (version_compare($context->getVersion(), "1.0.2", "<")) {
            $installer = $setup;
            $testTable = $installer->getTable('suttonsilver_testimonials_testimonial');
            // Check if the table already exists
            if ($setup->getConnection()->isTableExists($testTable) == true) {
                $setup->getConnection()->modifyColumn($testTable,'created_at',  ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT,'type'=>\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP]);
                $setup->getConnection()->modifyColumn($testTable,'updated_at',  ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE,'type'=>\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP]);
                $setup->getConnection()->addColumn($testTable,
                    'is_verified',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                        'size' =>null,
                        'nullable' => false, 'default' => '1',
                        'comment'=> 'Is Testimonial Verified'
                    ]
                );

                $setup->getConnection()->addColumn($testTable,
                    'customer_id',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                        'size' =>null,
                        'nullable' => false, 'default' => '1',
                        'comment'=> 'Is Testimonial Verified'
                    ]
                );
            }
        }
        $setup->endSetup();
    }
}
