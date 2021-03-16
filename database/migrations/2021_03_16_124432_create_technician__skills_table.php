<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicianSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician__skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technicians_id')->references('id')->on('technicians')->cacascadeOnDelete();   
            $table->foreignId('skills_id')->references('id')->on('skills')->cacascadeOnDelete();   
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
        Schema::dropIfExists('technician__skills');
    }
}
