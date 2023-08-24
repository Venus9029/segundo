<?php

namespace App\Http\Controllers;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evento = Evento::paginate(10); 
        return view('Eventos.index')->with('eventos',$evento);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([ 
            'titulo'=>'required|regex:/[A-Z][a-z]+/i',
            'descripcion'=>'required|regex:/[A-Z][a-z]+/i',
            'fecha_inicio'=>'required|numeric|regex:/[0-9]{8}/',
            'fecha_fin'=>'required|numeric|regex:/[0-9]{8}/',
            'contacto_id'=>'required|numeric|regex:/[0-9]/',
            
        ]);

    
        $evento = new Evento();

        $evento->titulo=$request->input('titulo');
        $evento->descripcion=$request->input('descripcion');
        $evento->fecha_inicio=$request->input('fecha_inicio');
        $evento->fecha_fin=$request->input('fecha_fin');
        $evento->contacto_id=$request->input('contacto_id');

       $evento->save();
       
        return redirect()->route('evento.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evento = Evento::findOrfail($id);
        return view('Eventos.show' , compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evento = Evento::findOrfail($id);
        return view('Eventos.edit')->with('evento', $evento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([ 
            'titulo'=>'required|regex:/[A-Z][a-z]+/i',
            'descripcion'=>'required|regex:/[A-Z][a-z]+/i',
            'fecha_inicio'=>'required|numeric|regex:/[0-9]{8}/',
            'fecha_fin'=>'required|numeric|regex:/[0-9]{8}/',
            'contacto_id'=>'required|numeric|regex:/[0-9]/',
            
        ]);

    
        $evento = new Evento();

        $evento->titulo=$request->input('titulo');
        $evento->descripcion=$request->input('descripcion');
        $evento->fecha_inicio=$request->input('fecha_inicio');
        $evento->fecha_fin=$request->input('fecha_fin');
        $evento->contacto_id=$request->input('contacto_id');

       $evento->save();
       
        return redirect()->route('evento.index');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Evento::destroy($id);

        return redirect()->route('evento.index');
    }
}
