<?php

use Phinx\Migration\AbstractMigration;

class ApplicationMigrations extends AbstractMigration
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
        $table = $this->table("Application");
        $table->addColumn("career_id","integer")
            ->addColumn("full_name","string",["limit"=>200])
            ->addColumn("dob","date")
            ->addColumn("postal_address","string",["limit"=>200])
            ->addColumn("place_birth","string",["limit"=>50])
            ->addColumn("nationality","string",["limit"=>100])
            ->addColumn("marital_status","integer")
            ->addColumn("phone","string",["limit"=>25])
            ->addColumn("others","text")
            ->addColumn("created_at","datetime")
            ->addColumn("updated_at","datetime")
            ->create();
    }
}
