<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Registration basics
            $table->string('user_type')->nullable()->index(); // vendor | user
            $table->string('business_name')->nullable();

            // Contacts
            $table->string('phone', 20)->nullable();
            $table->string('alt_phone', 20)->nullable();

            // Address
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode', 12)->nullable();
            $table->string('country')->nullable();

            // Account
            $table->string('username')->nullable()->unique();

            // Identity & Verification
            $table->string('pan_number', 20)->nullable()->index();
            $table->string('pan_file')->nullable();
            $table->string('aadhar_file')->nullable();
            $table->string('gst_number', 32)->nullable()->index();
            $table->string('gst_file')->nullable();

            // Optional
            $table->string('profile_photo')->nullable();
            $table->string('referral_code', 32)->nullable()->index();
            $table->timestamp('terms_accepted_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'user_type',
                'business_name',
                'phone',
                'alt_phone',
                'street',
                'city',
                'state',
                'pincode',
                'country',
                'username',
                'pan_number',
                'pan_file',
                'aadhar_file',
                'gst_number',
                'gst_file',
                'profile_photo',
                'referral_code',
                'terms_accepted_at',
            ]);
        });
    }
};


