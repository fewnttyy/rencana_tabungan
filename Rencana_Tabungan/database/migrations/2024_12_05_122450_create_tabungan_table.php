<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabungan', function (Blueprint $table) {
            $table->id('id_tabungan');
            $table->unsignedBigInteger('id_user');
            $table->string('judul_tabungan', 100);
            $table->string('foto')->nullable();
            $table->decimal('target_nominal', 15, 2);
            $table->date('target_tanggal');
            $table->enum('status', ['Tercapai', 'Belum Tercapai'])->default('Belum Tercapai');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabungan');
    }
};
