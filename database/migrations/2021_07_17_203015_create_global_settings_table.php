<?php

use App\Models\GlobalSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();
            $table->string('navbar_logo')->nullable();
            $table->string('navbar_title')->default('Badan Eksekutif Mahasiswa');
            $table->string('primary_color')->default('#0984e3');
            $table->string('secondary_color')->default('#74b9ff');
            $table->string('primary_text_color')->default('#2d3436');
            $table->string('secondary_text_color')->default('#FFFFFF');
            $table->string('page_banner')->nullable();
            $table->timestamps();
        });

        GlobalSetting::create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_settings');
    }
}
