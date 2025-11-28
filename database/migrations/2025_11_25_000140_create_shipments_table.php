<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();

            // Destination
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('street_address')->nullable();
            $table->string('postal_code', 12)->nullable();

            // Parcel details
            $table->string('box_number')->nullable();
            $table->date('sending_date')->nullable();
            $table->decimal('weight', 12, 3)->nullable();
            $table->text('description')->nullable();
            $table->date('estimated_delivery_date')->nullable();
            $table->string('dimensions')->nullable(); // formatted "LxWxH"
            $table->string('package_type')->nullable();

            // Value & charges
            $table->decimal('declared_value_rate', 12, 2)->nullable();
            $table->decimal('shipping_charge', 12, 2)->nullable();
            $table->decimal('extra_charge', 12, 2)->nullable();

            // Tracking & carrier
            $table->string('tracking_number')->nullable()->index();
            $table->string('status')->nullable()->index(); // e.g., In Transit, Delivered, Pending, etc.
            $table->string('hawb_number')->nullable()->index();
            $table->string('carrier')->nullable();
            $table->date('dispatched_date')->nullable();
            $table->date('flight_date')->nullable();

            // Documents / photos
            $table->text('attachments')->nullable(); // JSON of file paths

            // Notes
            $table->text('internal_notes')->nullable();

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->nullOnDelete();
            $table->foreign('receiver_id')->references('id')->on('receivers')->nullOnDelete();
            $table->foreign('vendor_id')->references('id')->on('vendors')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};


