
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<x-app-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Créer une Nouvelle Discussion</h1>

        <form action="{{ route('discussions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titre de la Discussion</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu de la Discussion</label>
                <textarea name="content" id="contenu" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Catégorie</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="text-center">
                <button type="submit" class="btn btn-primary">Créer la Discussion</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('forum.index') }}" class="btn btn-link">Retour au Forum</a>
        </div>
    </div>
</x-app-layout>>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
