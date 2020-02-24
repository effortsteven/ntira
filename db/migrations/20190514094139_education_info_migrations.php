<?php

use Phinx\Migration\AbstractMigration;

class EducationInfoMigrations extends AbstractMigration
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
        $table = $this->table("EducationInfo");
        $table->addColumn("application_id","integer")
            ->addForeignKey("application_id","Application","id",["delete"=>"CASCADE"])
            ->addColumn("education_type","integer")
            ->addColumn("name","string",["limit"=>50])
            ->addColumn("finish_year","integer")
            ->addColumn("exam_passed","string",["limit"=>200])
            ->addColumn("pass_by","string",["limit"=>10])
            ->create();
    }
}
