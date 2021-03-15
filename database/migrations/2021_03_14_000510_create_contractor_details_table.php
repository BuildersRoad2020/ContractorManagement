<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contractors_id')->references('id')->on('contractors')->cacascadeOnDelete();
            $table->longtext('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('abn')->nullable();
            $table->string('name_primarycontact')->nullable();
            $table->string('phone_primary')->nullable();
            $table->string('email_primary')->nullable();
            $table->string('name_secondarycontact')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('email_secondary')->nullable();
            $table->string('terms')->nullable();
            $table->string('currency')->nullable();
            $table->string('bankname')->nullable();
            $table->string('branch')->nullable();
            $table->string('accountname')->nullable();
            $table->string('bsb')->nullable();
            $table->string('accountnumber')->nullable();           
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
        Schema::dropIfExists('contractor_details');
    }
}
