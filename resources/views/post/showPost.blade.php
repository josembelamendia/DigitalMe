@extends('.layouts.default')

@section('title', 'Post especifico')

@section('content')
<main>
    <div class="container-fluid flex">
        <div class="post-image-container">
            <a href="/posts/{{$post->id}}">
                <img id="post-main-image" src="{{$post->getImage()}}" alt="">
            </a>
        </div>
        <div class="detalle-post">
            <span>{{count($post->likes()->getResults())}}</span>
            <form id="like-form" style="display: inline"action="/posts/{{$post->id}}/like" method="POST">
                @csrf
                <a id="like-click" href="">
                    @if(Auth::check() && auth()->user()->likes->contains('id', $post->id))
                        <img id="like-icon" src="{{ asset('images/like.png') }}" alt="">                    
                    @else
                        <img id="like-icon" src="{{ asset('images/heart.png') }}" alt="">
                    @endif
                </a>
            </form>
            <span>{{count($post->getViews()->getResults())}}</span>
            <img id="view-icon" src="{{ asset('images/view-icon.png') }}" alt="">
        </div>  
        <div class="post-title-container">
            <h2 id="post-title">
            {{ $post->title }}
            </h2>
        </div>
        <div class="post-subtitle-container">
            <h3 id="post-subtitle">
            {{ $post->subtitle }}
            </h3>
        </div>
        <div class="buttons-container">
            <div class="modal-container button-cnt">
                <button id="modal-content-button" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Ver el contenido</button>
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" data-content="{{ $post->content }}">
                        </div>
                    </div>
                </div>         
            </div>  
            @if(Auth::check() && auth()->user()->id === $post->user->id)
                <form class="hide-form" action="/posts/{{$post->id}}/edit" method="GET">
                    @csrf
                    <div class="edit-container button-cnt">
                        <button id="edit-post" class="btn btn-warning"type="submit" name="edit-post">Editar post</button>
                    </div>
                </form>
                <form class="hide-form" action="/posts/{{$post->id}}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="delete-container button-cnt">
                        <button id="delete-post" class="btn btn-danger"type="submit" name="delete-post">Eliminar post</button>
                    </div>
                </form>
            @endif
        </div>
</main>
@endsection
