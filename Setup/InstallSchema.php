<?php


namespace SuttonSilver\Testimonials\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_suttonsilver_testimonials_testimonial = $setup->getConnection()->newTable($setup->getTable('suttonsilver_testimonials_testimonial'));

        
        $table_suttonsilver_testimonials_testimonial->addColumn(
            'testimonial_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_suttonsilver_testimonials_testimonial->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            512,
            [],
            'name'
        );
        

        
        $table_suttonsilver_testimonials_testimonial->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'email'
        );
        

        
        $table_suttonsilver_testimonials_testimonial->addColumn(
            'testimonial',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'testimonial'
        );
        

        
        $table_suttonsilver_testimonials_testimonial->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [],
            'store_id'
        );
        

        
        $table_suttonsilver_testimonials_testimonial->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
            null,
            [],
            'created_at'
        );
        

        
        $table_suttonsilver_testimonials_testimonial->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
            null,
            [],
            'updated_at'
        );
        

        $setup->getConnection()->createTable($table_suttonsilver_testimonials_testimonial);

        $setup->endSetup();
    }
}
