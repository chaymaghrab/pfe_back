<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupeCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_certifications', function (Blueprint $table) {
            $table->id();
            $table->string('nom_groupe_certif');
            $table->string('date')->nullable();
            $table->string('heuredeb')->nullable();
            $table->string('heurefin')->nullable();
            $table->string('langue');
            $table->string('cours');
            $table->integer('effectif');
            $table->unsignedBigInteger('certification_id')->nullable();
            $table->foreign('certification_id')->references('id')->on('certifications');
            $table->unsignedBigInteger('local_id')->nullable();
            $table->foreign('local_id')->references('id')->on('locals');
            $table->unsignedBigInteger('surv1_id')->nullable();
            $table->foreign('surv1_id')->references('id')->on('formateurs');
            $table->unsignedBigInteger('surv2_id')->nullable();
            $table->foreign('surv2_id')->references('id')->on('formateurs');
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
        Schema::dropIfExists('groupe_certifications');
    }
}
