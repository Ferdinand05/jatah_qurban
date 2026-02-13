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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kk', 20)->unique();
            $table->string('kepala_keluarga', 100);
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('no_hp', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('households');
    }
};
