<?php

namespace App\Http\Controllers;

use App\Models\Descartable;
use Illuminate\Http\Request;

/**
 * Class DescartableController
 * @package App\Http\Controllers
 */
class DescartableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descartables = Descartable::paginate();

        return view('descartable.index', compact('descartables'))
            ->with('i', (request()->input('page', 1) - 1) * $descartables->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $descartable = new Descartable();
        return view('descartable.create', compact('descartable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Descartable::$rules);

        $descartable = Descartable::create($request->all());

        return redirect()->route('descartables.index')
            ->with('success', 'Descartable created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $descartable = Descartable::find($id);

        return view('descartable.show', compact('descartable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $descartable = Descartable::find($id);

        return view('descartable.edit', compact('descartable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Descartable $descartable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Descartable $descartable)
    {
        request()->validate(Descartable::$rules);

        $descartable->update($request->all());

        return redirect()->route('descartables.index')
            ->with('success', 'Descartable updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $descartable = Descartable::find($id)->delete();

        return redirect()->route('descartables.index')
            ->with('success', 'Descartable deleted successfully');
    }
}
