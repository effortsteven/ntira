<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class NewsFeedMigrations extends AbstractMigration
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
        $table = $this->table("NewsFeedModel");
        $table->addColumn("title","string",["limit"=>100])
            ->addColumn("link","string",["limit"=>500])
            ->addColumn("description","string",['default'=>null])
            ->addColumn("news_type","integer")
            ->addColumn("current_date","date")
            ->addColumn("end_date","date")
            ->addColumn("news_image", "string",["default"=>null])
            ->addColumn("file_name","string",["default"=>null])
            ->create();
    }
}
