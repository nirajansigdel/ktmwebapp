<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->date('date')->index();
            $table->string('category')->index(); // Parcel Income, Service Charge, etc.
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('amount', 12, 2);
            $table->decimal('amount_received', 12, 2)->nullable();
            $table->decimal('pending_amount', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};


