<?php

require_once './../shema/Scema.php';

class UserMigration
{
    public function run(Schema $table)
    {
        $table->string('kode');
    }
}
    