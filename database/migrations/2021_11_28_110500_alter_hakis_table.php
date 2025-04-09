<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHakisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hakis', function (Blueprint $table) {
            $table->dropColumn('isbn');
            $table->string('title')->after('team');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hakis', function (Blueprint $table) {
            $table->string('isbn')->after('type');
            $table->dropColumn('title');
        });
    }
}
