@extends('.layouts.default')

@section('title', 'Crear Post')

@section('content')

@push('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endpush

<div class="container">
    <form class="register-form" action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        <div class="form-row">
            <div class="col">
                <label class="labels" for="post_image">Cambiar imagen principal</label>
                <input id="post_image" type="file" class="form-control" name="post_image">
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label class="labels" for="title">Titulo</label>
                <input id="title-edit" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}">
                @error('title')
                    <div class="error-title">
                        <strong style="color: red">{{ $message }}</strong>
                    </div>   
                @enderror
            </div>
            <div class="col">
                <label class="labels" for="subtitle">Subtitulo</label>
                <input id="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ $post->subtitle }}">
                    @error('subtitle')
                        <div class="error-subtitle">
                            <strong style="color: red">{{ $message }}</strong>
                        </div>
                    @enderror
            </div>
        </div>
    
        <div class="form-row">
            <div class="col">
                <label class="labels" for="content">Contenido</label>
                <textarea id="summernote" class="form-control" value="{{$post->content}}" name="content"></textarea>
                @error('content')
                    <div class="error-content">
                        <strong style="color: red">{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <button type="submit" class="save btn btn-success">Guardar cambios</button>
            </div>
        </div>
    </form>
</div>  
@endsection