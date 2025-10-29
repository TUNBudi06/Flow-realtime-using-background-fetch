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
        Schema::create('tractor_list_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('No');
            $table->string('Model');
            $table->string('Keterangan');
            $table->string('image');
            $table->string('name');
            $table->string('nik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tractor_list_models');
    }
};
