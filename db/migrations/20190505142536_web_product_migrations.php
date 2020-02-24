<?php

use Phinx\Migration\AbstractMigration;

class WebProductMigrations extends AbstractMigration
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
        $table = $this->table("WebProduct");
        $table->addColumn("title","string",["limit"=>100])
            ->addColumn("description","text")
            ->addColumn("link","string",["limit"=>500])
            ->addColumn("images","string",["limit"=>500])
            ->addColumn("product_type","integer")
            ->addColumn("has_child","boolean",["default"=>false])
            ->addColumn("is_active","boolean",["default"=>true])
            ->create();
    }
}
