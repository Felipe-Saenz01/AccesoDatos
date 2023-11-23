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
                    <h1 class="m-3">Lista de Ficheros</h1>

                    <div>
                        <table class=" border-collapse border border-slate-500 min-w-full text-left text-sm font-light table-fixed">
                            <thead>
                              <tr>
                                <th class="border border-slate-600 p-2" >Nombre</th>
                                <th class="border border-slate-600 p-2" >Extensión</th>
                                <th class="border border-slate-600 p-2" >Ruta</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($ficheros as $fichero)
                                <tr>
                                  <td class="border border-slate-700 p-2" > {{ $fichero->nombre }} </td>
                                  <td class="border border-slate-700 p-2" > {{ $fichero->extension}} </td>
                                  <td class="border border-slate-700 p-2" > {{ $fichero->ruta }} </td>
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
