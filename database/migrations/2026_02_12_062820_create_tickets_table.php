<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('distribution_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('token', 64)->unique();
            $table->enum('status', ['issued', 'used', 'expired'])->default('issued');
            $table->string('qr_code_path', 255)->nullable();
            $table->timestamp('issued_at')->useCurrent();
            $table->timestamp('used_at')->nullable();
            $table->foreignId('used_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->timestamps();

            // Index untuk performance
            $table->index(['status', 'distribution_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
