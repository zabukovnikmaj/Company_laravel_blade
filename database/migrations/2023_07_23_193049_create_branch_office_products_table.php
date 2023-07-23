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
        Schema::create('branch_office_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('branch_office_id');
            $table->uuid('product_id');
            $table->timestamps();

            $table->foreign('branch_office_id')
                ->references('id')
                ->on('branch_offices')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_office_products');
    }
};
