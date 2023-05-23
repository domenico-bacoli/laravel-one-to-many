@extends('layouts/admin')

@section('content')
    
    <main class="home-container d-flex flex-column align-items-center py-5">
        <h1 class="mb-5">Inserisci un nuovo Progetto</h1>
        <form class="w-50" action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title">Titolo</label>
                                                                                    {{-- con il metodo old() facciamo in modo che il dato rimanga anche se l'utente ha inviato il form senza compilare tutti i campi --}}
                <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title')}}">
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="thumb">Url Anteprima</label>
                <input class="form-control @error('thumb') is-invalid @enderror" type="text" id="thumb" name="thumb" value="{{old('thumb')}}">
                @error('thumb')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="link">github link</label>
                <input class="form-control @error('link') is-invalid @enderror" type="text" id="price" name="link" value="{{old('link')}}">
                @error('link')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror    
            </div>
            <div class="mb-3">
                <label for="languages">Languages</label>
                <input class="form-control @error('languages') is-invalid @enderror" type="text" id="languages" name="languages" value="{{old('languages')}}">
                @error('languages')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror    
            </div>
            <div class="mb-3">
                <label for="description">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description">{{old('description')}}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Aggiungi</button>
        </form>

    </main>
@endsection