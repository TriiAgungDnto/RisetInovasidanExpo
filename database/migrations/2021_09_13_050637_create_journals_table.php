<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->unsigned()->constrained()->cascadeOnUpdate();
            $table->foreignId('major_id')->unsigned()->constrained()->cascadeOnUpdate();
            $table->string('team');
            $table->string('title');
            $table->string('name');
            $table->string('volume');
            $table->string('page');
            $table->integer('year');
            $table->string('p_issn')->nullable();
            $table->string('e_issn');
            $table->enum('type', ["internasional", "nasional"]);
            $table->text('url');
            $table->text('file');
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
        Schema::dropIfExists('journals');
    }
}
