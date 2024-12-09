<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="p-6 sm:p-10">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">Candidatures pour l'offre : {{ $offre->titre }}</h1>

                    @if($candidatures->count() > 0)
                        <div class="space-y-6">
                            @foreach($candidatures as $candidature)
                                <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h2 class="text-xl font-semibold text-gray-800">{{ $candidature->user->name }}</h2>
                                            <p class="text-gray-600">{{ $candidature->user->email }}</p>
                                            <p class="text-sm text-gray-500 mt-2">Candidature soumise le : {{ $candidature->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('candidatures.show', $candidature->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                                                Voir détails
                                            </a>
                                            @if(!$candidature->hidden)
                                                <button onclick="confirmHide({{ $candidature->id }})" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                                                    Refuser
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-center">Aucune candidature n'a été soumise pour cette offre.</p>
                    @endif

                    <div class="mt-8">
                        <a href="{{ route('offres.show', $offre->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                            Retour à l'offre
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($candidatures as $candidature)
        <form id="hide-form-{{ $candidature->id }}" action="{{ route('candidatures.hide', $candidature->id) }}" method="POST" style="display: none;">
            @csrf
            @method('PUT')
        </form>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmHide(candidatureId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Voulez-vous vraiment refuser cette candidature ? Un email sera envoyé au candidat.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, refuser',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('hide-form-' + candidatureId).submit();
                }
            });
        }
    </script>
</x-app-layout>

