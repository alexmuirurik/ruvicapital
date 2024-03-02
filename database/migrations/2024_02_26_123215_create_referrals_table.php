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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('referrer_id');
            $table->string('deposit_status');
            $table->float('deposit_amount', 10, 2)->nullable();
            $table->float('referrer_commission', 10, 2)->nullable();
            $table->string('referrer_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
