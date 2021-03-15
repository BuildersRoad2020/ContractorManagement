<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contractors_id')->references('id')->on('contractors')->cacascadeOnDelete();  
            $table->foreignId('documents_id')->references('id')->on('documents')->cacascadeOnDelete();    
            $table->string('file_path')->nullable();                      
            $table->boolean('status')->default(0);            
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
        Schema::dropIfExists('contractor_documents');
    }
}
