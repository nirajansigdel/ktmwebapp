<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->date('payment_date')->index();
            $table->decimal('amount_paid', 12, 2);
            $table->string('proof_path')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('pending')->index(); // pending | verified | unverified
            $table->timestamp('verified_at')->nullable();
            $table->text('unverified_reason')->nullable();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_payments');
    }
};


