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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('tran_id', 25)->unique();
            $table->decimal('amount', 6,2)->default(0);
            $table->integer('event_id');
            $table->integer('employee_id');
            $table->string('status')->nullable()->comment('0=> pending, 1=> canceled, 2=> in progress, 4=> failed, 5=> success');
            $table->text('fail_reason')->nullable()->comment('need based on failed issue. like amount missmatched, hash verification failed etc');
            $table->string('transection_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
