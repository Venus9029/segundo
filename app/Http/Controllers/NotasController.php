<?php

namespace App\Http\Controllers;
use App\Models\Nota;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nota = Nota::paginate(15); 
        return view('Notas.index')->with('notas',$nota);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Notas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'texto'=>'required|regex:/[A-Z][a-z]+/i', 
            'fecha'=>'required|numeric:lib$libros|regex:/[0-9]{6}/', 
            'contacto_id'=>'required|numeric|regex:/[0-9]/',
        ]);
        
        $nota = new Nota();
        $nota->texto=$request->input('texto');
        $nota->fecha=$request->input('fecha');
        $nota->contacto_id=$request->input('contacto_id');

        $nota->save();

        return redirect()->route('nota.index');

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nota = Nota::findOrfail($id);
        return view('notas.show' , compact('nota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nota = Nota::findOrfail($id);
        return view('Notas.edit')->with('nota', $nota);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $nota = Nota::findOrfail($id);
        $request->validate([
            'texto'=>'required|regex:/[A-Z][a-z]+/i', 
            'fecha'=>'required|numeric:lib$libros|regex:/[0-9]{6}/', 
            'contacto_id'=>'required|numeric|regex:/[0-9]/',
        ]);
        
        $nota = new Nota();
        $nota->texto=$request->input('texto');
        $nota->fecha=$request->input('fecha');
        $nota->contacto_id=$request->input('contacto_id');

        $nota->save();

        return redirect()->route('nota.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    
    {
        Nota::destroy($id);

        return redirect()->route('nota.index');

    }

    public function buscar(Request $request)
    {
        $query = $request->input('q');
        
        $notas = Nota::where('texto', 'LIKE', "%$query%")
            ->orWhere('fecha', 'LIKE', "%$query%")
            ->orWhere('contacto_id', 'LIKE', "%$query%")
            ->paginate(10); 
        
        return view('Notas.index', compact('notas'));
    }

}
