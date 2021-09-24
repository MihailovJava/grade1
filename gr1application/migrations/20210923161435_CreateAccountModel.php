<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Phpmig\Migration\Migration;

class CreateAccountModel extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Manager::schema()->create(
            'accounts',
            static function (Blueprint $table) {
                $table
                    ->char('uuid', 36)
                    ->primary();
                $table
                    ->timestamp('created_at')
                    ->useCurrent();
                $table
                    ->timestamp('updated_at')
                    ->default(new Expression('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
                $table
                    ->text('subdomain')
                    ->nullable();
                $table
                    ->text('name')
                    ->nullable();

            }
        );

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Manager::schema()->dropIfExists('accounts');
    }
}
