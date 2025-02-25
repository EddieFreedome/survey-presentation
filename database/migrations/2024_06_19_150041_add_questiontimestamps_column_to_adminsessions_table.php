<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('adminsessions', function (Blueprint $table) {
            // $table->id();
            $table->datetime('second_timestamps');
            $table->datetime('third_timestamps');
            $table->datetime('fourth_timestamps');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adminsessions', function (Blueprint $table) {
            $table->dropColumn('second_timestamps');
            $table->dropColumn('third_timestamps');
            $table->dropColumn('fourth_timestamps');     
        });
    }
};
