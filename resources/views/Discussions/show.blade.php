@extends('layouts.app')

@section('title', $discussion->title)

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="discussion-header text-center mb-4">
            <h2>{{ $discussion->title }}</h2>
            <p class="text-muted">Créé par <strong>{{ $discussion->user->name }}</strong> le {{ $discussion->created_at->format('d M Y à H:i') }}</p>
        </div>

        <div class="discussion-content card mb-4">
            <div class="card-body text-center">
                <h5 class="card-title">Contenu de la Discussion</h5>
                <p class="card-text">{{ $discussion->content }}</p>
            </div>
        </div>

        <h3 class="mt-4 text-center">Réponses</h3>
        @if ($discussion->replies->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                Aucune réponse pour cette discussion.
            </div>
        @else
            <ul class="list-group mb-4">
                @foreach ($discussion->replies as $reply)
                    <li class="list-group-item">
                        <strong>{{ $reply->user->name }}</strong> a dit :
                        <p class="text-center mb-0">{{ $reply->content }}</p> <!-- Close spacing for neatness -->
                        <small class="text-muted d-block text-center mt-1">Répondu le {{ $reply->created_at->format('d M Y à H:i') }}</small>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="reply-form mb-4">
            <h4 class="text-center">Laisser une Réponse</h4>
            <form action="{{ route('replies.store', $discussion->id) }}" method="POST">
                @csrf
                <input type="hidden" name="discussion_id" value="{{ $discussion->id }}">
                <div class="form-group">
                    <label for="content">Contenu de la Réponse</label>
                    <textarea class="form-control" id="content" name="contenu" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto">Répondre</button>
            </form>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('forum.index') }}" class="btn btn-link">Retour au Forum</a>
        </div>
    </div>
@endsection

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
