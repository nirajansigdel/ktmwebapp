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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            
            // Customer Information
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            
            // Parcel Destination Details
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->text('street_address')->nullable();
            $table->string('postal_code', 20)->nullable();
            
            // Parcel Details
            $table->string('box_number')->nullable()->comment('DHL / FedEx / etc.');
            $table->date('sending_date')->nullable();
            $table->decimal('weight', 10, 2)->nullable()->comment('Weight in kg');
            $table->text('description')->nullable();
            $table->date('estimated_delivery_date')->nullable();
            $table->string('dimensions')->nullable()->comment('e.g. 10x5x3 cm');
            $table->enum('package_type', ['Box', 'Envelope', 'Fragile', 'Heavy', 'Liquid'])->default('Box');
            
            // Value & Charges
            $table->decimal('declared_value_rate', 10, 2)->nullable();
            $table->decimal('shipping_charge', 10, 2)->nullable();
            $table->decimal('extra_charge', 10, 2)->nullable();
            
            // Photo or Document
            $table->json('documents')->nullable()->comment('Array of file paths');
            
            // Tracking
            $table->string('tracking_number')->unique()->nullable();
            $table->enum('status', ['In Transit', 'Delivered', 'Pending'])->default('Pending');
            
            // Notes
            $table->text('notes')->nullable()->comment('Internal Notes / Special Instructions');
            
            $table->timestamps();
            
            // Foreign Keys
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('receiver_id')->references('id')->on('receivers')->onDelete('set null');
            
            // Indexes
            $table->index('tracking_number');
            $table->index('status');
            $table->index('customer_id');
            $table->index('receiver_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
