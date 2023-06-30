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
        Schema::create('BranchOfficeProduct', function (Blueprint $table) {
            $table->string('uuid')->primary();
            $table->string('branchOfficeId');
            $table->string('productId');
            $table->timestamps();

            $table->foreign('branchOfficeId')
                ->references('uuid')
                ->on('BranchOffice');
            $table->foreign('productId')
                ->references('uuid')
                ->on('Products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('BranchOfficeProduct');
    }
};
