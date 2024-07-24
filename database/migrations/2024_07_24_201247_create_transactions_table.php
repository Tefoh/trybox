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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Order::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->decimal('price', 15, 2);
            $table->text('description')->nullable();
            $table->unsignedInteger('status');
            $table->decimal('total', 15, 2);
            $table->string('transaction_number')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->text('error')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};