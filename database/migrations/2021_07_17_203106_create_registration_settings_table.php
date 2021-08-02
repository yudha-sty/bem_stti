<?php

use App\Models\RegistrationSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('academic_year')->default(now()->year);
            $table->boolean('visibility')->default(1);
            $table->timestamps();
        });

        RegistrationSetting::create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_settings');
    }
}
