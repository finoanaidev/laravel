<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('sexe');
            $table->string('telephone');
            $table->string('niveau');
            $table->text('profession_pere');
            $table->text('profession_mere');
            $table->string('date_naissance');
            $table->string('etablissement_origine');
            $table->string('nom_entreprise')->nullable();
            $table->string('duree')->nullable();
            $table->string('abandon')->nullable();
            $table->string('filiere')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('etudiants');
    }
}
