<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Manejo de Ficheros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative p-3 min-h-screen bg-dots-darker bg-center bg-white-900 selection:bg-red-500 selection:text-white">
                    <div class="relative h-6 mb-5">
                        <h1 class="m-5">Lista de Ficheros</h1>
                        <a href="{{route('ficheros.create')}}" class="bg-green-500 hover:bg-green-700 dark:text-gray-200 py-2 px-4 font-bold rounded-md absolute top-0 right-0 mr-5">
                            Crear
                        </a>
                    </div>

                    <div class="mt-4">
                        <table class=" border-collapse border border-slate-500 min-w-full text-left text-sm font-light table-fixed">
                            <thead>
                              <tr>
                                <th class="border border-slate-600 p-2 bg-gray-800 text-white" >Nombre</th>
                                <th class="border border-slate-600 p-2 bg-gray-800 text-white" >Extensión</th>
                                <th class="border border-slate-600 p-2 bg-gray-800 text-white" >Ruta</th>
                                <th class="border border-slate-600 p-2 bg-gray-800 text-white" >Editar</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($ficheros as $fichero)
                                <tr>
                                    <td class="border border-slate-700 p-2" > {{ $fichero->nombre }} </td>
                                    <td class="border border-slate-700 p-2" > {{ $fichero->extension}} </td>
                                    <td class="border border-slate-700 p-2" > {{ $fichero->ruta }} </td>
                                    <td class="border border-slate-700 p-2" >
                                        <a href="{{ route('ficheros.show', $fichero) }}" class="inline-flex items-center px-3 py-2 my-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Editar
                                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                        <div class="my-10 mx-5">
                            {{$ficheros->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
