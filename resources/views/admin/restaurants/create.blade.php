@extends('layouts.app')

@section('content')

<div class="container">
    <header>
        <h2> Crea il tuo ristorante </h2>
    </header>
    <div class="alert alert-warning"> <i class="fa-regular fa-triangle-exclamation"></i> N.B.: Una volta compilati i
        campi, non potrai più modificarli in seguito. Scegli con cura tutti i dati che immetterai!
        <i class="fa-regular fa-triangle-exclamation"></i>
    </div>
    <!-- da spostare in include (?) -->
    <form action="{{ route('admin.restaurants.store') }}" method="POST" novalidate>
        @csrf
        <div class="row">

            <!-- Nome ristorante -->
            <div class="mb-3 col-12">
                <label for="restaurant_name" class="form-label"> Nome ristorante </label>
                <input class="form-control  @error('restaurant_name') is-invalid @enderror" type="text"
                    id="restaurant_name" name="restaurant_name" value=" {{ old('restaurant_name')  }} " maxlenght="50">
            </div>
            <!-- partita iva -->
            <div class="mb-3 col-12">
                <label for="p_iva" class="form-label">Numero partita IVA </label>
                <input class="form-control  @error('p_iva') is-invalid @enderror" type="text" id="p_iva" name="p_iva"
                    value=" {{ old('p_iva') }} " maxlenght="13">
            </div>
            <!-- indirizzo-->
            <div class="mb-3 col-12">
                <label for="address" class="form-label">Indirizzo completo </label>
                <input class="form-control  @error('address') is-invalid @enderror" type="text" id="address"
                    name="address" value=" {{ old('address') }} ">
            </div>
            <!-- immagine -->
            <div class="mb-3 col-10">
                <label for="restaurant_image" class="form-label">Immagine </label> <br>
                <input class="@error('restaurant_image') is-invalid @enderror w-100" type="text" id="restaurant_image"
                    name="restaurant_image">
            </div>
            <div class="mb-3 col-2">
                <img class="img-fluid"
                    src="https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg"
                    alt="placeholder" id="preview">
                <!-- to fix w/js preview -->

            </div>

            <!-- multi-checkboxs tipologie ristoranti-->

            <div class="mb-3 col-12">
                <h5> Categorie risotrante</h5>
                <div class="d-flex">

                    @foreach($categories as $category)
                    <div class="form-group form-check m-2">
                        <!-- # getire l'old in caso di errori (?) -->
                        <input type="checkbox" id="{{$category->label}}" name="category_id" value="{{ $category->id }}"
                            class="form-check-input">
                        <label class="form-check-label" for="{{$category->label}}"> {{$category->label}} </label>
                    </div>
                    @endforeach
                </div>
            </div>



        </div>

        <footer class="d-flex justify-content-between align items-center">
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-circle-left"> </i> Indietro ...
            </a>

            <button type="submit" class="btn btn-outline-success">
                <i class="fa-solid fa-floppy-disk"></i> Salva!
            </button>
        </footer>
    </form>
</div>
@endsection