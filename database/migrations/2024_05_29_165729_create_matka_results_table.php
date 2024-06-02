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
        Schema::create('matka_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('market_id')->nullable(true);
            $table->string('market_name')->nullable(true);
            $table->date('aankdo_date')->nullable(true);
            $table->string('aankdo_open')->nullable(true);
            $table->string('aankdo_close')->nullable(true);
            $table->string('figure_open')->nullable(true);
            $table->string('figure_close')->nullable(true);
            $table->string('jodi')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matka_results');
    }
};
