@extends('layouts.app')
@section('content')

<div class="py-4 px-6 ">
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap font-light table-auto border-b border-neutral-200 ">
            <thead class="bg-gray-600 text-gray-300">
                <tr >
                    <th class="p-2">ID</th>
                    <th class="p-2">Titulo</th>
                    <th class="p-2">Descrição</th>
                    <th class="p-2">Data</th>
                    <th class="p-2">Loca</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($events as $event)
                    <tr class="border-b border-neutral-300">
                        <td class="py-3 px-6 whitespace-nowrap font-medium">{{ $event->id }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $event->description }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $event->date }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $event->type }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $event->location }}</td>
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection