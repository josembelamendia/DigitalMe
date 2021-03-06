@extends('.layouts.default')

@section('title', 'Perfil de '. $user->getFullName())

@section('content')

<section class="general-content">
      <section class="move_left_desktop">
        <div class="descripcion-perfil">
          @if($user->profile_image != null) 
            <img src="/storage/{{$user->profile_image}}" class="profile-image" alt="profile image">
          @else
            <img src="{{ asset('images/profile-img.jpg') }}" class="profile-image" alt="profile image">
          @endif
            <ul class="avatar-info" id="nav">
              <h3 class="h3-perfil">{{$user->getFullName()}}</h3>
              <li> <a href="">{{ $user->web ?? ''}}</a> </li>
              <li> <a href=""><img src="{{ asset('images/location.svg') }}" class="location-icon" alt="location icon">{{ ($user->location != null ? $user->getNormalUser->country . ', ' . $user->location: 'Ubicacion desconocida') }}</a> </li>
              <li><a href="/followers/{{$user->id}}">Seguidores: {{count($user->followers()->getResults())}}</a></li>
            </ul>
        </div>
        <div class="">
            <ul class="fol-mes-buttons">
            @auth
                <button id="send-message-button" class="profile-button mensaje"type="submit" name="message">Mensaje</button>
                @if(auth()->user()->id === $user->id)
                    <button id="edit-profile-button" data-userid="{{$user->id}}" class="profile-button seguir"type="submit" name="edit-profile">Editar perfil</button>
                    <button onclick="redirectTo('followers/{{$user->id}}')"id="follows-button" class="profile-button seguir follows" type="submit" name="follows">Seguidos</button>
                @else 
                <form id="follow-form" action="/follow/{{$user->id}}" method="POST">
                    @csrf
                    <button id="follow-button" class="profile-button seguir" type="submit" name="follow">
                        @if(auth()->user()->follows->contains('id', $user->id))
                            Dejar de seguir
                        @else
                            Seguir
                        @endif
                    </button>
                </form>  
                @endif
            @else
                <button onclick="redirectTo('login')" id="follow-button" class="profile-button seguir" type="submit" name="follow">Seguir</button>
                <button onclick="redirectTo('login')" id="send-message-button" class="profile-button mensaje"type="submit" name="message">Mensaje</button>
            @endif
          </ul>
        </div>
    </section>
    <main>
    <section class="additional-info">
        <nav class="section-na navbar navbar-expand-lg navbar-light bg-light justify-content-center section-na-perfil">
            <ul class="navbar-nav">
            <li class="nav-item navItemPerfil">
                <a class="abajo linksection" href="#posts">Trabajos subidos a digitalme</a>
            </li>
        </nav>
    </section>
    <section class="portfolio_thumbnails">
        <div id="posts" class="publicaciones-perfil container">
            <div class="row">
            @if($userPosts->count() > 0)
                @foreach($userPosts as $post) 
                <a href="/posts/{{$post->id}}">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="publicacion">
                            <img src="{{$post->getImage()}}" alt="">
                            <div class="info-post">
                                <span class="post-info-user">
                                    <div class="post-info-user-container">
                                        <a id="post-info-user" href="/posts/{{$post->id}}">{{$post->getShortTitle()}}</a>
                                    </div>
                                </span>
                                <div class="post-info-data">
                                    <span>{{count($post->likes()->getResults())}}</span>
                                    <img id="like-icon" src="{{ asset('images/like-icon.png') }}" alt="">
                                    <span>{{count($post->getViews()->getResults())}}</span>
                                    <img id="view-icon" src="{{ asset('images/view-icon.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>   
                @endforeach
            @else
                @auth
                    @if(auth()->user()->id === $user->id)
                        <h2 id="no-posts">No tienes publicaciones aún</h2>
                        <div class="new-post-icon-container">
                            <a href="{{ url('/posts/new')}}"><img src="{{ asset('images/plus.png') }}" class="new-post-icon" alt="add new post icon"></a>
                        </div>
                    @else
                        <h2 id="no-posts">No hay publicaciones de este usuario.</h2>
                    @endif
                @else
                    <h2 id="no-posts">No hay publicaciones de este usuario.</h2>
                @endif
            @endif
            </div>
        </div>
        {{$userPosts->appends(request()->all())->links()}}
    </section>
    </main>

@endsection