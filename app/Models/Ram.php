<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{ protected $table = 'ram';

    /**
     * @var array $fillable
     */
protected $id;
protected $idtype;
protected $capacite;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'idtype',
        'capacite'
    ];
    use HasFactory;

    public static function lastid(){
        $tab = Laptop::fromQuery("select * from ram order by id desc limit 1");
        return $tab[0]['id'];
    }
}
