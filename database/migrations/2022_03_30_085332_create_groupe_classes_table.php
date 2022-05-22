<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupeClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_groupe');
            $table->integer('niveau');
            $table->string('code_groupe');
            $table->string('ecole');
            $table->string('departement');
            $table->string('parcours');
            $table->string('cours');
            $table->string('langue');
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
        Schema::dropIfExists('groupe_classes');
    }
}
