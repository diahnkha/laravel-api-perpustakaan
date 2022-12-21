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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("judul", 50);
            $table->text("foto");
            $table->string("penerbit");
            $table->string("kota");
            $table->string("bahasa");
            $table->string("isbn");
            $table->bigInteger("pengarang");
            $table->text("deskripsi");
            $table->string("tahun");
            $table->bigInteger("kategori");
            $table->integer("stok");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
