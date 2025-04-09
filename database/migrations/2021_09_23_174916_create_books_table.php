<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->unsigned()->constrained()->cascadeOnUpdate();
            $table->foreignId('major_id')->unsigned()->constrained()->cascadeOnUpdate();
            $table->string('team');
            $table->string('title');
            $table->string('publisher');
            $table->string('page');
            $table->string('year');
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
        Schema::dropIfExists('books');
    }
}
