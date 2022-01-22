<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisiMisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visi_misis', function (Blueprint $table) {
            $table->id();
            $table->string('no_urut');
            $table->longText('visi');
            $table->longText('misi');
            $table->string('ketua');
            $table->string('nimketua');
            $table->string('jurusanketua');
            $table->string('angkatanketua');
            $table->string('wakil');
            $table->string('nimwakil');
            $table->string('jurusanwakil');
            $table->string('angkatanwakil');
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
        Schema::dropIfExists('visi_misis');
    }
}
