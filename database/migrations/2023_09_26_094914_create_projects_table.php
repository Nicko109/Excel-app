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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->index()->constrained('types');
            $table->string('title');
            $table->date('created_at_time');
            $table->date('contracted_at');

            $table->date('deadline')->nullable();

            $table->boolean('is_chain')->nullable();
            $table->boolean('is_on_time')->nullable();
            $table->boolean('has_outsource')->nullable();
            $table->boolean('has_investors')->nullable();

            $table->integer('worker_count')->nullable();
            $table->integer('service_count')->nullable();

            $table->integer('payment_first_step')->nullable();
            $table->integer('payment_second_step')->nullable();
            $table->integer('payment_third_step')->nullable();
            $table->integer('payment_fourth_step')->nullable();

            $table->text('comment')->nullable();

            $table->decimal('effective_value', 13, 20)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
