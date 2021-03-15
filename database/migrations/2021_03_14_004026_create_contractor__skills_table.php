<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor__skills', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('contractors_id')->references('id')->on('contractors')->cacascadeOnDelete();   
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
        Schema::dropIfExists('contractor__skills');
    }
}
