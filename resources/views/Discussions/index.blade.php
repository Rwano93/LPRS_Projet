<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Forum de Discussions</h1>

        <div class="mb-4 text-center">
            <a href="{{ route('discussions.create') }}" class="btn btn-primary">Créer une Nouvelle Discussion</a>
        </div>

        @if($discussions->isEmpty())
            <div class="alert alert-info text-center">
                Aucune discussion disponible pour le moment.
            </div>
        @else
            <div class="list-group">
                @foreach ($discussions as $discussion)
                    <div class="list-group-item mb-3">
                        <h1 class="font-weight-bold">
                           <u><big><strong><em>{{ $discussion->title }}</em></strong></big></u>
                        </h1>
                        <p class="mb-1">{{ Str::limit($discussion->content, 150) }}</p>
                        <small class="text-muted">Créé par <strong>{{ $discussion->user->name }}</strong> le {{ $discussion->created_at->format('d M Y à H:i') }}</small>
                        <div class="text-end">
                            <a href="{{ route('discussions.show', $discussion->id) }}" class="btn btn-link">Voir Discussion</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4 text-center">
            {{ $discussions->links() }} <!-- Liens de pagination -->
        </div>
    </div>

</x-app-layout>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
