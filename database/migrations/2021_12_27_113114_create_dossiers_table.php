<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->text('state')->nullable();
            $table->boolean('paid');
            $table->string('provenance');
            $table->string('passport_type');
            $table->string('passport_num');
            $table->string('passport_expiration');
            $table->string('motif');
            $table->string('passport')->nullable();
            $table->string('ticket')->nullable();
            $table->string('accommodation')->nullable();
            $table->string('hotel')->nullable();
            $table->string('work')->nullable();
            $table->string('imposition')->nullable();
            $table->string('mission')->nullable();
            $table->string('validatedFiles')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('visa_id')->nullable();
            $table->date('delivered_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->unsignedBigInteger('type_visa_id');
            $table->foreign('type_visa_id')
                  ->references('id')
                  ->on('type_visas')
                  ->onDelete('cascade');
            $table->string('attestation')->nullable();
            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')
                  ->references('id')
                  ->on('centers')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->integer('rejector_id')->nullable();
            $table->integer('validator_id')->nullable();
            $table->integer('controlor_id')->nullable();
            $table->integer('finalisator_id')->nullable();
            $table->string('token')->nullable();
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
        Schema::dropIfExists('dossiers');
    }
}
