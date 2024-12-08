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
        Schema::create('menabung', function (Blueprint $table) {
            $table->id('id_menabung');
            $table->unsignedBigInteger('id_tabungan');
            $table->unsignedBigInteger('id_user');
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal_menabung');
            $table->timestamps();

            $table->foreign('id_tabungan')->references('id_tabungan')->on('tabungan')->onDelete('cascade');
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
        Schema::dropIfExists('menabung');
    }
};
