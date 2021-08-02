<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('namaLengkap');
            $table->string('tempatLahir');
            $table->string('tanggalLahir');
            $table->string('jenisKelamin');
            $table->integer('nim');
            $table->string('programStudi');
            $table->integer('semester');
            $table->integer('tahunAngkatan');
            $table->string('noTelepon');
            $table->longText('mottoHidup');
            $table->longText('motivasiBEM');
            $table->string('email');
            $table->string('asalSekolah');
            $table->string('foto');
            $table->string('swafoto');
            $table->longText('pengalamanOrganisasi');
            $table->boolean('statusTerima')->nullable();
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
        Schema::dropIfExists('registrations');
    }
}
