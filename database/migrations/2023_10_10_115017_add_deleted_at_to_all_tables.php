<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     protected const TABLES = [
        
        'users',
        'roles',
        'personal_access_tokens',
        'permissions',
    ];

    public function up()
    {
        foreach (self::TABLES as $tableName) {
            $this->addSoftDeletesIfNotExists($tableName);
        }
    }

    public function down()
    {
        foreach (self::TABLES as $tableName) {
            $this->dropSoftDeletesIfExists($tableName);
        }
    }

    private function addSoftDeletesIfNotExists($tableName)
    {
        if (!Schema::hasColumn($tableName, 'deleted_at')) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    private function dropSoftDeletesIfExists($tableName)
    {
        if (Schema::hasColumn($tableName, 'deleted_at')) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('deleted_at');
            });
        }
    }   


};
