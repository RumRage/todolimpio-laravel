<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Combo;
/**
 * Class Agenda
 *
 * @property $id
 * @property $combo_ids
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
        'nombre' => 'required',
        'telefono' => 'required',
        'direccion' => 'required',
        'fecha_hora' => 'required',
        'combo_ids' => 'required|array',
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
    protected $fillable = ['nombre', 'telefono', 'direccion', 'fecha_hora', 'combo_ids', 'precio', 'descuento', 'precio_final', 'metodo_pago', 'estado'];

    /**
     * Get the combo for the agenda.
     */
    public function combos()
{
    return $this->belongsToMany(Combo::class, 'agenda_combo', 'agenda_id', 'combo_id');
}
}