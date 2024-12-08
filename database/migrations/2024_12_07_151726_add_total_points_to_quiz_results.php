<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('quiz_results', function (Blueprint $table) {
        $table->integer('total_points')->default(0)->after('score'); // Set default value to 0
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            $table->dropColumn('total_points');
        });
    }
};
