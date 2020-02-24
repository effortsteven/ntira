<?php


namespace Config\Core;

use Phinx\Migration\AbstractMigration;

class DataMigrations extends AbstractMigration
{
    /**
     * @return array
     */
    public function getTables()
    {
        return $this->tables;
    }
}