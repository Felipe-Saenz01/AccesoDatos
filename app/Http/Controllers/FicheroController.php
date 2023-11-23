<?php

namespace App\Http\Controllers;

use App\Models\Fichero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FicheroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ficheros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'nombre' => 'required',
            'extension' => 'required',  
        ]);

        $fichero = $request->input('extension')."/".$request->input('nombre').".".$request->input('extension');
        Storage::put($fichero, '');

        Fichero::create([
            'nombre' => $request->input('nombre'),
            'extension' => $request->input('extension'),
            'ruta' => $fichero,
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fichero $fichero)
    {

        $rutaArchivo = storage_path("app/{$fichero->ruta}");

        if (file_exists($rutaArchivo)) {
            $contenido = file_get_contents($rutaArchivo);

            return view('ficheros.show', [
                'contenido' => $contenido,
                'fichero' => $fichero
            ]);
        }

    return abort(404);

        // return view('ficheros.show' , [
        //     'fichero' => $fichero
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fichero $fichero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fichero $fichero)
    {
        //return nl2br($request->contenido);

        $rutaArchivo = storage_path("app/{$fichero->ruta}");

        if (file_exists($rutaArchivo)) {
            $nuevoContenido = $request->input('contenido');
            // $nuevoContenido = strip_tags($nuevoContenido);

            // $nuevoContenido = str_replace('<p/>','<p/><br>' , $nuevoContenido);
            // $nuevoContenido = str_replace('<br />', PHP_EOL, $nuevoContenido);
            
            // Guardar el nuevo contenido en el archivo
            file_put_contents($rutaArchivo, $nuevoContenido);

            return redirect()->route('dashboard');
        }

        return abort(404); // Archivo no encontrado

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fichero $fichero)
    {
        //
    }
}
