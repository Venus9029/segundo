<?php

namespace App\Http\Controllers;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contacto = Contacto::paginate(15);
        return view()('Contactos.index')->with('contacto',$contacto);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Contactos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre'=>'required|regex:/[A-Z][a-z]+/i', 
            'apellido'=>'required|regex:/[A-Z][a-z]+/i', 
            'correo_electronico'=>'required|Email', 
            'telefono'=>'required|numeric|unique:usuarios|regex:/[0-9]{8}/',
            
        ]);

        $contacto = new Contacto();
        $contacto->nombre=$request->input('nombre');
        $contacto->apellido=$request->input('apellido');
        $contacto->correo_electronico=$request->input('correo_electronico');
        $contacto->telefono=$request->input('telefono');

        $contacto->save();

        return redirect()->route('contacto.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $contactp = Contacto::findOrfail($id);
        return view('Contactos.show' , compact('contacto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $contacto = Contacto::findOrfail($id);
        return view('Contactos.edit' , compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $contacto = Contacto::findOrfail($id);

        $request->validate([
            'nombre'=>'required|regex:/[A-Z][a-z]+/i', 
            'apellido'=>'required|regex:/[A-Z][a-z]+/i', 
            'correo_electronico'=>'required|Email', 
            'telefono'=>'required|numeric|unique:usuarios|regex:/[0-9]{8}/',
            
        ]);

        $contacto->nombre=$request->input('nombre');
        $contacto->apellido=$request->input('apellido');
        $contacto->correo_electronico=$request->input('correo_electronico');
        $contacto->telefono=$request->input('telefono');

        $contacto->save();

        return redirect()->route('contacto.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Contacto::destroy($id);

        return redirect()->route('contacto.index');
    }

    //BUSCAR
    public function buscar(Request $request)
    {
        $query = $request->input('q');
        
        $contactos = Contacto::where('id', 'LIKE', "%$query%")
            ->orWhere('nombre', 'LIKE', "%$query%")
            ->orWhere('apellido', 'LIKE', "%$query%")
            ->orWhere('correo_electronico', 'LIKE', "%$query%")
            ->orWhere('telefono', 'LIKE', "%$query%")
            ->paginate(15);
        
        return view('Contactos.index', compact('contactos'));
    }

}
