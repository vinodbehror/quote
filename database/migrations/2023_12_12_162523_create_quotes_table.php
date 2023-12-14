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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['B2B', 'B2C'])->default('B2B');
            $table->foreignId('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('agency_name');
            $table->integer('no_of_persons');
            $table->integer('no_of_adults');
            $table->integer('no_of_children');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->integer('no_of_nights_stay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
