<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->string('item_name')->nullable();
            $table->decimal('weight_or_quantity', 12, 3)->nullable();
            $table->decimal('rate', 12, 2)->nullable();
            $table->decimal('total_amount', 12, 2)->nullable();
            $table->decimal('extra_charge', 12, 2)->nullable();
            $table->date('shipping_date')->nullable();
            $table->date('flight_date')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('submitted')->default(false);
            $table->boolean('approved')->default(false);
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_items');
    }
};


