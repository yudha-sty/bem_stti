<?php

use App\Models\Quote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('author')->nullable();
            $table->longText('quote');
            $table->timestamps();
        });

        Quote::create([
            'author' => 'Ali Bin Abi Thalib RA',
            'quote' => 'Engkau berpikir tentang dirimu sebagai seonggok materi semata, padahal di dalam dirimu tersimpan kekuatan tak terbatas'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
