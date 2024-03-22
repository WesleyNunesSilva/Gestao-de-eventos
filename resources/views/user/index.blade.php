@extends('layouts.app')
@section('content')

<div class="py-4 px-6 ">
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap font-light table-auto border-b border-neutral-200 ">
            <thead class="bg-gray-600 text-gray-300">
                <tr >
                    <th scope="col" class="p-2">ID</th>
                    <th scope="col" class="p-2">Nome</th>
                    <th scope="col" class="p-2">Email</th>
                    <th scope="col" class="p-2">Tipo</th>
                    <th scope="col" class="p-2">criado</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($users as $user)
                    <tr class="border-b border-neutral-300">
                        <td class="py-3 px-6 whitespace-nowrap font-medium">{{ $user->id}}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $user->type }}</td>
                        <td class="py-3 px-6 whitespace-nowrap">{{ $user->created_at }}</td>
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection