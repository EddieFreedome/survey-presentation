<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotCorrectTotWrongToSavesessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('savesessions', function (Blueprint $table) {
            $table->integer('tot_correct')->default(0);
            $table->integer('tot_wrong')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('savesessions', function (Blueprint $table) {
            $table->dropColumn('tot_correct');
            $table->dropColumn('tot_wrong');
        });
    }
}