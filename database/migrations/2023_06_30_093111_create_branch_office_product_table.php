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
            $table->string('branch_office_uuid');
            $table->string('product_uuid');
            $table->timestamps();

            $table->foreign('branch_office_uuid')
                ->references('uuid')
                ->on('BranchOffice')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('product_uuid')
                ->references('uuid')
                ->on('Products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
