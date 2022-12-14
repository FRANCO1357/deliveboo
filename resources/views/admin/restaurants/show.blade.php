@extends('layouts.app')

@section('content')
<div class="container">

    <header>
        <h1>Nome ristorante: {{ $restaurant_details->name }}</h1>
    </header>
    <div class="d-flex flex-column">
        <div class="my-3">
            <p>
            <h3> Partita iva: </h3> {{ $restaurant_details->p_iva }} </p>
        </div>
        <div class="my-3">
            <h3> Indirizzo: </h3>
            {{$restaurant_details->address}}
        </div>
        @if($restaurant_details->image)
        <figure>
            <p>
            <h3> Immagine ristorante: </h3>
            </p>
            <img src=" {{ asset('storage/' . $restaurant_details->image) }}" alt="{{ $restaurant_details->name }}">
        </figure>
        @endif
        <div class="my-3">
            <h3> Categoria ristorante: </h3>

            @foreach($restaurant_details->categories as $category)
            {{ $category->label }} @if ($loop->last) . @else , @endif
            @endforeach

        </div>
        <div class="my-3">
            <h3> Creato il: </h3> <time> {{ $restaurant_details->created_at }}</time>
        </div>
    </div>
    <footer class="d-flex align-items-center justify-content-between mt-5">

        <a href="{{ route('admin.home' , $restaurant_details) }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-circle-left"> </i> Torna alla home
        </a>
        <div class="d-flex">

            <a href="{{ route('admin.restaurants.edit', $restaurant_details) }}"
                class="btn btn-sm btn-outline-secondary p-2">
                <i class="fa-solid fa-file-pen"></i> Modifica
            </a>
            <form action="{{ route('admin.restaurants.destroy', $restaurant_details->id )}}" method="POST"
                class="delete-form mx-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fa-solid fa-trash-can"></i> Elimina!
                </button>

            </form>
        </div>
    </footer>
</div>
@endsection