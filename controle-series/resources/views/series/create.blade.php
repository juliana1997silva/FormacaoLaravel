<x-layout title="Cadastro de  Série">
    <x-form :action="route('series.store')" nomeButton="Adicionar" :nome="old('nome')" :update="false"/>
</x-layout>