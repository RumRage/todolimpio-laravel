<?php

namespace App\Models;
use App\Models\Combo;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicio
 *
 * @property $id
 * @property $categoria_id
 * @property $nombre
 * @property $precio
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property Combo[] $combos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Servicio extends Model
{
    
    static $rules = [
		'categoria_id' => 'required',
		'nombre' => 'required',
		'precio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['categoria_id','nombre','precio'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_servicio', 'servicio_id', 'combo_id');
    }
    

}
