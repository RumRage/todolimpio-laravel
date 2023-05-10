<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Models\Combo;

/**
 * Class AgendaController
 * @package App\Http\Controllers
 */
class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::where('estado', 'Pendiente')->paginate();

        return view('agenda.index', compact('agendas'))
            ->with('i', (request()->input('page', 1) - 1) * $agendas->perPage());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agenda = new Agenda();
        $combos = Combo::pluck('nombre', 'id');
        $precio = [];
        foreach ($combos as $id => $nombre) {
            $precio[$id] = Combo::find($id)->precio;
        }
        $agenda->combos = $agenda->combos ?? collect(); // Inicializar la propiedad combos si es nula
        return view('agenda.create', compact('agenda', 'combos', 'precio'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'combo_ids' => 'nullable|array',
        ]);

        $total = 0;
        $combos = Combo::whereIn('id', $request->input('combo_ids', []))->get();
        foreach ($combos as $combo) {
            $total += $combo->precio;
        }

        $descuento = $request->input('descuento', 0);
        $precio_final = $total - $total * ($descuento / 100);

        $agenda = Agenda::create([
            'nombre' => $request->input('nombre'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'precio' => $total,
            'descuento' => $descuento,
            'precio_final' => $precio_final,
            'metodo_pago' => $request->input('metodo_pago'),
            'fecha_hora' => $request->input('fecha_hora'),
        ]);

    $agenda->combo()->sync($request->input('combo_ids', []));

    return redirect()->route('agendas.index')
        ->with('success', 'Nuevo Servicio agendado creado correctamente.');
}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = Agenda::with('combo')->findOrFail($id);
        return view('agenda.show', compact('agenda'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agenda = Agenda::find($id);
        $combos = Combo::pluck('nombre', 'id');
        $precio = [];
        foreach ($combos as $id => $nombre) {
            $precio[$id] = Combo::find($id)->precio;
        }
        return view('agenda.edit', compact('agenda', 'combos', 'precio'));
    }
   
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {   
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'combo_ids' => 'nullable|array',
        ]);

        $total = 0;
        $combos = Combo::whereIn('id', $request->input('combo_ids', []))->get();
        foreach ($combos as $combo) {
            $total += $combo->precio;
        }

        $descuento = $request->input('descuento', 0);
        $precio_final = $total - $total * ($descuento / 100);

        $agenda->nombre = $request->input('nombre');
        $agenda->telefono = $request->input('telefono');
        $agenda->direccion = $request->input('direccion');
        $agenda->precio = $total;
        $agenda->descuento = $descuento;
        $agenda->precio_final = $precio_final;
        $agenda->metodo_pago = $request->input('metodo_pago');
        $agenda->fecha_hora = $request->input('fecha_hora');
        $agenda->save();

        $agenda->combo()->sync($request->input('combo_ids', []));

        return redirect()->route('agendas.index')
            ->with('success', 'Agenda actualizada correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $agenda = Agenda::find($id);

        // Eliminar los registros relacionados en la tabla intermedia agenda_combo
        $agenda->combo()->detach();

        // Eliminar el servicio agendado
        $agenda->delete();

        return redirect()->route('agendas.index')
               ->with('success', 'Servicio eliminado satisfactoriamente.');
    }
/**
 * Update the state of the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request $request
 * @param  int $id
 * @param  int $estado
 * @return \Illuminate\Http\Response
 */
public function marcarComoHecho($id)
{
    $agenda = Agenda::find($id);
    $agenda->estado = 'Hecho';
    $agenda->save();

    return redirect()->route('historiales.index')
        ->with('success', 'El servicio fue completado exitosamente.');
}

public function marcarComoCancelado($id)
{
    $agenda = Agenda::find($id);
    $agenda->estado = 'Cancelado';
    $agenda->save();

    return redirect()->route('cancelados.index')
        ->with('success', 'El servicio fue cancelado exitosamente.');
}

public function historiales()
{
    $agendas = Agenda::where('estado', 'Hecho')->paginate();
    return view('agenda.historiales', compact('agendas'))
        ->with('i', (request()->input('page', 1) - 1) * $agendas->perPage());
}

public function cancelados()
{
    $agendas = Agenda::where('estado', 'Cancelado')->paginate();
    return view('agenda.cancelados', compact('agendas'))
        ->with('i', (request()->input('page', 1) - 1) * $agendas->perPage());
}

}
