<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Agenda
 *
 * @property $id
 * @property $combo_id
 * @property $nombre
 * @property $telefono
 * @property $direccion
 * @property $precio
 * @property $descuento
 * @property $precio_final
 * @property $metodo_pago
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Combo $combo
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Agenda extends Model
{
    
    static $rules = [
		'combo_id' => 'required',
		'nombre' => 'required',
		'telefono' => 'required',
		'direccion' => 'required',
		'precio' => 'required',
		'descuento' => 'required',
		'precio_final' => 'required',
		'metodo_pago' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['combo_id','nombre','telefono','direccion','precio','descuento','precio_final','metodo_pago','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function combo()
    {
        return $this->hasOne('App\Models\Combo', 'id', 'combo_id');
    }
    

}
