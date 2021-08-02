<?php

use App\Models\HomepageSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('header_title')->default('BEM STTI');
            $table->integer('header_title_font_size')->default(80);
            $table->string('header_subtitle')->default('2021');
            $table->integer('header_subtitle_font_size')->default(40);
            $table->string('header_cover')->nullable();

            $table->string('section_cabinet_title')->default('AKSI MUDA');
            $table->integer('section_cabinet_title_font_size')->default(96);
            $table->string('section_cabinet_subtitle')->default('Kabinet');
            $table->integer('section_cabinet_subtitle_font_size')->default(32);
            $table->string('section_cabinet_logo')->nullable();

            $table->timestamps();
        });

        HomepageSetting::create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homepage_settings');
    }
}
