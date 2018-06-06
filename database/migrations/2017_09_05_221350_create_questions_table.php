<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question');
            $table->integer('supervision_category_id')->unsigned();
            $table->foreign('supervision_category_id')->references('id')->on('supervision_categories')->onDelete('cascade');
            $table->integer('supervision_area_id')->nullable()->unsigned();
            $table->foreign('supervision_area_id')->references('id')->on('supervision_areas')->onDelete('cascade');
            $table->integer('question_type_id')->unsigned();
            $table->foreign('question_type_id')->references('id')->on('question_types')->onDelete('cascade');
            $table->integer('parent_id')->index()->nullable();
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
        Schema::dropIfExists('questions');
    }
}
