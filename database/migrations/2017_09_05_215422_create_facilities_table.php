<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('facility_code')->nullable();
            $table->string('contact_name')->nullable();
            $table->integer('contact_designation_id')->unsigned()->nullable();
            $table->foreign('contact_designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->integer('facility_owner_id')->unsigned();
            $table->foreign('facility_owner_id')->references('id')->on('facility_owners')->onDelete('cascade');
            $table->integer('facility_type_id')->unsigned();
            $table->foreign('facility_type_id')->references('id')->on('facility_types')->onDelete('cascade');
            $table->integer('county_id')->unsigned();
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
            $table->integer('sub_county_id')->unsigned()->nullable();
            $table->foreign('sub_county_id')->references('id')->on('sub_counties')->onDelete('cascade');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
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
        Schema::dropIfExists('facilities');
    }
}
