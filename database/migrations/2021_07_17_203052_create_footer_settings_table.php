<?php

use App\Models\FooterSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('footer_logo')->nullable();
            $table->string('footer_title')->default('STTI Tanjungpinang');
            $table->string('footer_link')->default('http://www.sttindonesia.ac.id/');
            $table->string('footer_address')->default('Jl. Pompa Air, Tj. Pinang Timur, Bukit Bestari, Kota Tanjung Pinang, Kepulauan Riau');
            $table->string('footer_telepon')->default('(0771) 7002638');
            $table->longText('footer_map')->nullable();
            $table->string('footer_copyright')->default('Copyright &copy; 2021 | Web Design And Development By Andrian Winata');
            $table->timestamps();
        });

        FooterSetting::create([
            'footer_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3025504392567!2d104.45194101463868!3d0.9212844630593932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d9730e84709231%3A0xe1f5cba6cf00718b!2sSTTI%20Tanjungpinang!5e0!3m2!1sen!2sid!4v1626603036875!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footer_settings');
    }
}
