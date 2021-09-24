<?php

use Phpmig\Migration\Migration;

class UserCreateExipire extends Migration
{
    private string $table = 'users';
    /**
     * Do the migration
     */
    public function up()
    {
        $db = $this->getContainer()['db'];
        $schema = $db->schema();
        $db->getConnection()->table($this->table)->truncate();
        $schema->table(
            $this->table,
            function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->timestamp('expire')->nullable();
                $table->text('refresh')->nullable();
            }
        );
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $db = $this->getContainer()['db'];
        $schema = $db->schema();
        $schema->table(
            $this->table,
            function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->dropColumn('expire');
                $table->dropColumn('refresh');
            }
        );

    }
}
