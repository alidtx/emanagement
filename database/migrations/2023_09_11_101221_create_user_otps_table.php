<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_otps', function (Blueprint $table) {
            $table->id();
            $table->string('code');  
            $table->integer('user_id')->nullable(); 
            $table->string('phone'); 
            $table->string('type')->nullable();
            $table->integer('is_verify')->default(0);
            $table->string('token')->nullable();
            $table->time('expire_at')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_otps');
    }
};
