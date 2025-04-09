<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->unsigned()->constrained()->cascadeOnUpdate();
            $table->foreignId('major_id')->unsigned()->constrained()->cascadeOnUpdate();
            $table->string('team');
            $table->string('title');
            $table->string('name');
            $table->string('organizer');
            $table->string('location');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('isbn');
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
        Schema::dropIfExists('conferences');
    }
}
