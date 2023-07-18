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
        Schema::create('Employees', function (Blueprint $table) {
            $table->string('uuid')->primary();
            $table->string('branch_office');
            $table->string('name');
            $table->string('position');
            $table->integer('age');
            $table->string('sex');
            $table->string('email');
            $table->timestamps();

            $table->foreign('branch_office')
                ->references('uuid')
                ->on('BranchOffice')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Employees');
    }
};
