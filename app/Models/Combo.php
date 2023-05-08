<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;
use App\Models\Agenda;
/**
 * Class Combo 
 *
 * @property $id
 * @property $servicio_id
 * @property $nombre
 * @property $precio
 * @property $descuento
 * @property $precio_final
 * @property $created_at
 * @property $updated_at
 *
 * @property Servicio $servicio
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Combo extends Model
{
    
    static $rules = [
        'servicio_ids' => 'required|array',
        'nombre' => 'required',
        'precio' => 'required',
        'descuento' => 'nullable',
        'precio_final' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['servicio_ids','nombre','precio','descuento','precio_final'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

        public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'combo_servicio', 'combo_id', 'servicio_id');
    }

        public function agendas()
    {
        return $this->belongsToMany(Agenda::class);
    }

}
