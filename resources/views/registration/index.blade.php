@extends('layouts.app')
@section('content')

<div class="py-4 px-6">
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap font-light table-auto border-b border-neutral-200 ">
            <thead class="bg-gray-600 text-gray-300">
                <tr >
                    <th class="p-2">ID</th>
                    <th class="p-2">Nome</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Tipo</th>
                    <th class="p-2">criado</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($registrations as $registration)
                    <tr class="border-b border-neutral-300">
                        <td class="py-3 px-6 whitespace-nowrap font-medium">{{ $registration->id }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $registration->name }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $registration->email }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $registration->type }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $registration->created_at }}</td>
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection