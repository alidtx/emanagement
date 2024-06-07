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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('designation_id')->nullable();
            $table->tinyInteger('amount')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('type')->nullable();
            $table->string('event_unique_code')->nullable();
            $table->string('telegram_id')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
