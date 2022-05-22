<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrpClasseCertifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grp_classe_certifs', function (Blueprint $table) {
            $table->id();
            $table->integer('nbheure');
            $table->integer('semestre');
            $table->unsignedBigInteger('certif_id')->nullable();
            $table->foreign('certif_id')->references('id')->on('certifications')->onDelete('cascade');
            $table->unsignedBigInteger('grp_classe_id')->nullable();
            $table->foreign('grp_classe_id')->references('id')->on('groupe_classes')->onDelete('cascade');
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
        Schema::dropIfExists('grp_classe_certifs');
    }
}
