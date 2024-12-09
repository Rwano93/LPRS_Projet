@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Accès non autorisé') }}</div>

                <div class="card-body">
                    <p>{{ __('Désolé, vous n\'avez pas les permissions nécessaires pour accéder à cette page.') }}</p>
                    <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Retour à l\'accueil') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

