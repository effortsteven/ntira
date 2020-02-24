<?php

use Phinx\Migration\AbstractMigration;

class TenderMigrations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table("Tender");
        $table->addColumn("tender_number","string",["limit"=>100])
            ->addColumn("tender_category","string",["limit"=>50])
            ->addColumn("tender_description","text",["default"=>null])
            ->addColumn("eligible_firm", "integer",["default"=>1])
            ->addColumn("bid_document_price","integer",["default"=>0])
            ->addColumn("method_of_procurement","integer",["default"=>1])
            ->addColumn("file_name","string",["limit"=>500])
            ->addColumn("deadline","datetime")
            ->addColumn("date_of_publish","datetime")
            ->create();
    }
}
