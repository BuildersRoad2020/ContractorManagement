<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicianDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technicians_id')->references('id')->on('technicians')->cacascadeOnDelete();  
            $table->foreignId('documents_id')->references('id')->on('documents')->cacascadeOnDelete();    
            $table->string('file_path')->nullable();     
            $table->date('expiration')->nullable();                 
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
        Schema::dropIfExists('technician_documents');
    }
}
