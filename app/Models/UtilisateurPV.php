<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilisateurPV extends Model
{ protected $table = 'utilisateurpv';

    /**
     * @var array $fillable
     */
protected $id;
protected $idutilisateur;
protected $idpointvente;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'idutilisateur',
        'idpointvente'
    ];
    use HasFactory;

}
