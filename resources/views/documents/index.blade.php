<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Documents
        </h2>
    </x-slot>

    <div class="py-12">
 
        {{-- <x-document-table :documents="$documents" /> --}}
        <livewire:documents /> 
        
    </div>
</x-app-layout>