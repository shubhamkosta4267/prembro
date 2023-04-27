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
        Schema::create('student_installments', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->date('installment_date')->nullable();
            $table->float('payment', 11, 2)->nullable();
            $table->text('remark')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_installments');
    }
};
