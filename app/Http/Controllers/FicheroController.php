<?php

namespace App\Http\Controllers;

use App\Models\Fichero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use SimpleXMLElement;

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
    public function show(Fichero $fichero, $extension)
    {

        $rutaArchivo = storage_path("app/{$fichero->ruta}");

        if (file_exists($rutaArchivo)) {

            switch ($extension) {
                case 'txt':
                    $contenido = file_get_contents($rutaArchivo);

                    return view('ficheros.'.$extension , [
                        'contenido' => $contenido,
                        'fichero' => $fichero
                    ]);
                    break;
                case 'doc':
                    if (filesize($rutaArchivo) == 0){
                        $phpword = new PhpWord();

                        $section = $phpword->addSection();

                        // Añadir un texto a la sección
                        $section->addText('Hola, este es un fichero de Word creado con Laravel.');
                        $phpword->save($rutaArchivo);

                        return "Archivo actualizado";

                    }else{
                        return 'archivo no vacio';
                    }

                    $contenido = file_get_contents($rutaArchivo);

                    return view('ficheros.'.$extension , [
                        'contenido' => $contenido,
                        'fichero' => $fichero
                    ]);
                    break;
                case 'xml':
                    
                    if (filesize($rutaArchivo) == 0)
                    {
                        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root></root>');

                        // Agregar elementos y atributos al objeto xml
                        $xml->addChild('elemento1', 'valor1')->addAttribute('atributo1', 'valor1');
                        $xml->addChild('elemento2', 'valor2')->addAttribute('atributo2', 'valor2');

                        // Guardar el objeto xml en el fichero
                        $xml->asXML($rutaArchivo);
                    }
                    $contenido = file_get_contents($rutaArchivo);
                    $xml = simplexml_load_file(storage_path('app/'.$fichero->ruta));

                    dd($xml);

                    return view('ficheros.'.$extension , [
                        'fichero' => $fichero,
                        'xml' => $xml
                    ]);
                    break;
                
                default:
                    # code...
                    break;
            }

            
        }

    return abort(404);
    }

    public function ficherosTxt(Fichero $fichero)
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
        //return $request;

        $rutaArchivo = storage_path("app/{$fichero->ruta}");
        if (file_exists($rutaArchivo)) {

            if($request->nombre != $fichero->nombre){
                return $request;
            }

            $nuevoContenido = $request->input('contenido');
            file_put_contents($rutaArchivo, $nuevoContenido);



            return redirect()->route('dashboard');
        }

        return abort(404); // Archivo no encontrado

    }

    public function xmlUpdate(Request $request, Fichero $fichero)
    {
       // Obtener la ruta del fichero
        $file_path = storage_path("app/{$fichero->ruta}");

        // Crear un nuevo objeto xml
        $contenido = file_get_contents($file_path);
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root></root>');

        // Recorrer los elementos y los atributos del request
        foreach ($request->elements as $index => $element) {
            $child = $xml->addChild($element);
            foreach ($request->get('attributes')[$element] as $key => $value) {
                $child->addAttribute($key, $value);
            }
        }

        // Guardar el objeto xml en el storage
        Storage::put("app/{$fichero->ruta}", $xml->asXML());


        
        // Retornar la vista de éxito con un mensaje
        //return view('dashboard')->with('message', 'El fichero xml ha sido actualizado correctamente.');
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fichero $fichero)
    {
        Storage::delete($fichero->ruta);
        $fichero->delete();

        return redirect()->route('dashboard');
    }
}
