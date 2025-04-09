<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHakisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hakis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->unsigned()->constrained()->cascadeOnUpdate();
            $table->foreignId('major_id')->unsigned()->constrained()->cascadeOnUpdate();
            $table->string('team');
            $table->string('register_number');
            $table->enum('type', ['hak cipta', 'paten', 'merek']);
            $table->string('isbn');
            $table->text('file');
            $table->text('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hakis');
    }
}
