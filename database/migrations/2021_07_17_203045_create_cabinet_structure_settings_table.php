<?php

use App\Models\CabinetStructureSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabinetStructureSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabinet_structure_settings', function (Blueprint $table) {
            $table->id();
            $table->longText('content')->nullable();
            $table->timestamps();
        });

        CabinetStructureSetting::create([
            'content' => '<p style="text-align: center;"><img alt="" src="' . url('/') . '/asset/images/contoh1.png" style="height:100%; width:100%" /></p>'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabinet_structure_settings');
    }
}
