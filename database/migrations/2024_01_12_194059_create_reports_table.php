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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('product_sku');
            $table->string('product_name')->nullable(true);
            $table->integer('incoming_product_total')->default(0);
            $table->integer('outgoing_product_total')->default(0);
            $table->integer('incoming_product')->default(0);
            $table->integer('outgoing_product')->default(0);
            $table->string('information')->default('in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
