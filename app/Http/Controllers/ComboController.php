<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use Illuminate\Http\Request;
use App\Models\Servicio;
/**
 * Class ComboController
 * @package App\Http\Controllers
 */
class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combos = Combo::paginate();

        return view('combo.index', compact('combos'))
            ->with('i', (request()->input('page', 1) - 1) * $combos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $combo = new Combo();
        $servicios = Servicio::pluck('nombre', 'id');
        $precio = [];
    
        foreach ($servicios as $id => $nombre) {
            $precio[$id] = Servicio::find($id)->precio;
        }
    
        return view('combo.create', compact('combo', 'servicios', 'precio'));
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
            'servicio_ids' => 'nullable|array',
        ]);

        $total = 0;
        $servicios = Servicio::whereIn('id', $request->input('servicio_ids', []))->get();
        foreach ($servicios as $servicio) {
            $total += $servicio->precio;
        }

        $descuento = $request->input('descuento', 0);
        $precio_final = $total - $total * ($descuento / 100);

        $combo = Combo::create([
            'nombre' => $request->input('nombre'),
            'precio' => $total,
            'descuento' => $descuento,
            'precio_final' => $precio_final,
        ]);
    
    $combo->servicios()->syncWithoutDetaching($request->input('servicio_ids', []));

    return redirect()->route('combos.index')
        ->with('success', 'Combo creado correctamente.');
}

    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $combo = Combo::with('servicios')->findOrFail($id);
        return view('combo.show', compact('combo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $combo = Combo::find($id);
        $servicios = Servicio::pluck('nombre', 'id');
        $precio = [];
        foreach ($servicios as $id => $nombre) {
            $precio[$id] = Servicio::find($id)->precio;
        }
        return view('combo.edit', compact('combo', 'servicios', 'precio'));
        
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Combo $combo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Combo $combo)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'servicio_ids' => 'nullable|array',
        ]);

        $total = 0;
        $servicios = Servicio::whereIn('id', $request->input('servicio_ids', []))->get();
        foreach ($servicios as $servicio) {
            $total += $servicio->precio;
        }

        $descuento = $request->input('descuento', 0);
        $precio_final = $total - $total * ($descuento / 100);

        $combo->nombre = $request->input('nombre');
        $combo->precio = $total;
        $combo->descuento = $descuento;
        $combo->precio_final = $precio_final;
        $combo->save();

        $combo->servicios()->sync($request->input('servicio_ids', []));

        return redirect()->route('combos.index')
            ->with('success', 'Combo actualizado correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
{
    $combo = Combo::find($id);

    // Eliminar los registros relacionados en la tabla intermedia combo_servicio
    $combo->servicios()->detach();

    // Eliminar el combo
    $combo->delete();

    return redirect()->route('combos.index')
        ->with('success', 'Combo deleted successfully');
}
}
