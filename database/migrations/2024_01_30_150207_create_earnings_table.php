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
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->uniqid();
            $table->integer('user_id');
            $table->integer('deposit_id');
            $table->float('working_capital', 10, 2);
            $table->json('wc_increments')->nullable();
            $table->float('interest_earnings', 10, 2)->nullable();
            $table->json('ie_increments')->nullable();
            $table->timestamp('month');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earnings');
    }
};
