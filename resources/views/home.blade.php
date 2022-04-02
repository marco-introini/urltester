@extends('layout')

@section('titolo-pagina','Esempi in Laravel')

@section('contenuto-pagina')
    <div class="flex-col">

        <div class="text-3xl">Funzioni di esempio</div>

        <div class="my-4"><a href="{{route('modale-alpine')}}">Modale usando AlpineJs</a></div>
        <div class="my-4"><a href="{{route('livewire-utenti')}}">Gestione utenti con livewire</a></div>
        <div class="my-4"><a href="{{route('recapcha')}}">ReCapcha</a></div>

    </div>
@endsection