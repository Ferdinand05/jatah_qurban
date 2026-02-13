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
        Schema::create('scan_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamp('scanned_at')->useCurrent();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->enum('result', ['success', 'failed']);
            $table->string('message', 255)->nullable();
            $table->timestamps();

            // Index untuk pencarian
            $table->index(['scanned_at', 'result']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('scan_logs');
    }
};
