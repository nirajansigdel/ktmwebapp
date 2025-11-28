<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 12, 2)->nullable();
            $table->string('depreciation_method')->nullable(); // Straight Line | Reducing Balance
            $table->decimal('depreciation_rate', 8, 2)->nullable();
            $table->unsignedInteger('useful_life_years')->nullable();
            $table->decimal('accumulated_depreciation', 12, 2)->nullable();
            $table->decimal('current_value', 12, 2)->nullable();

            // Stock
            $table->integer('opening_stock')->default(0);
            $table->integer('quantity_added')->default(0);
            $table->integer('quantity_used')->default(0);
            $table->integer('current_stock')->default(0);
            $table->integer('reorder_level')->default(0);
            $table->integer('min_order_qty')->nullable();

            // Media & notes
            $table->string('photo')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};


