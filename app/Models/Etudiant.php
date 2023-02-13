<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'email', 'sexe', 'telephone', 'niveau','filiere', 'profession_pere','profession_mere', 'date_naissance', 'etablissement_origine', 'user_id', 'nom_entreprise', 'duree','abandon'
    ];

    protected $with = [
        'user'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
