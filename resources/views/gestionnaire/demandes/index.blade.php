<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des demandes') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-lg overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-teal-100 via-blue-50 to-teal-100 border-b border-gray-200">
                    <h3 class="text-3xl font-semibold text-gray-800 mb-6">Demandes en attente</h3>

                    <!-- Barre de recherche et filtre par statut -->
                    <div class="mb-6 flex items-center justify-between space-x-6">
                        <!-- Barre de recherche -->
                        <div class="relative w-1/2 max-w-sm">
                            <input type="text" id="search" class="block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Rechercher par nom, rôle, date..." oninput="searchTable()">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16a7 7 0 1 0 0-14 7 7 0 0 0 0 14zM21 21l-4.35-4.35"></path>
                                </svg>
                            </div>
                        </div>
                        <!-- Menu déroulant pour filtrer par statut -->
                        <div class="relative w-2/5 max-w-xs">
                            <select id="statusFilter" class="block w-full pl-6 pr-4 py-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 appearance-none text-left" onchange="filterByStatus()">
                                <option value="">Filtrer par statut</option>
                                <option value="en_attente">En attente</option>
                                <option value="approuve">Approuvé</option>
                                <option value="refuse">Refusé</option>
                            </select>
                        </div>
                    </div>
                    <!-- Tableau -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 table-auto" id="demandeTable">
                            <thead class="sticky top-0 bg-black text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Utilisateur</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Statut demandé</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Statut actuel</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($demandes as $demande)
                                    <tr class="hover:bg-gray-50 transition duration-200 ease-in-out">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($demande->user)
                                                <span class="text-gray-800 font-semibold">{{ $demande->user->nom }}</span>
                                            @else
                                                <span class="text-gray-500 italic">Utilisateur inconnu</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            @if($demande->role)
                                                {{ $demande->role->libelle }}
                                            @else
                                                <span class="text-gray-500 italic">Rôle non défini</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                            {{ $demande->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($demande->statut == 'en_attente') bg-yellow-200 text-yellow-800
                                                @elseif($demande->statut == 'approuve') bg-green-200 text-green-800
                                                @else bg-red-200 text-red-800 @endif">
                                                {{ ucfirst($demande->statut) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <a href="{{ route('gestionnaire.demandes.show', $demande) }}" 
                                               class="text-teal-600 hover:text-teal-800 hover:underline transition ease-in-out duration-200">
                                                Voir
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Aucune demande -->
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            <p>Aucune demande enregistrée.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Nouvelle Pagination -->
                    <div class="flex justify-center items-center space-x-2 mt-8">
                        @if ($demandes->onFirstPage())
                            <span class="p-2 rounded-full bg-black text-white cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $demandes->previousPageUrl() }}" class="p-2 rounded-full bg-black text-white hover:bg-gray-800 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif

                        @foreach ($demandes->getUrlRange(1, $demandes->lastPage()) as $page => $url)
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-medium transition-colors duration-200 {{ $page == $demandes->currentPage() ? 'bg-blue-500 text-white' : 'bg-black text-white hover:bg-gray-800' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if ($demandes->hasMorePages())
                            <a href="{{ $demandes->nextPageUrl() }}" class="p-2 rounded-full bg-black text-white hover:bg-gray-800 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <span class="p-2 rounded-full bg-black text-white cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts personnalisés -->
    <script>
        // Fonction de recherche dans le tableau
        function searchTable() {
            const input = document.getElementById('search');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('demandeTable');
            const trs = table.getElementsByTagName('tr');

            for (let i = 1; i < trs.length; i++) {
                let tdName = trs[i].getElementsByTagName('td')[0];
                let tdRole = trs[i].getElementsByTagName('td')[1];
                let tdDate = trs[i].getElementsByTagName('td')[2];
                let tdStatus = trs[i].getElementsByTagName('td')[3];

                if (tdName && tdRole && tdDate && tdStatus) {
                    let txtName = tdName.textContent || tdName.innerText;
                    let txtRole = tdRole.textContent || tdRole.innerText;
                    let txtDate = tdDate.textContent || tdDate.innerText;
                    let txtStatus = tdStatus.textContent || tdStatus.innerText;

                    if (
                        txtName.toLowerCase().includes(filter) ||
                        txtRole.toLowerCase().includes(filter) ||
                        txtDate.toLowerCase().includes(filter) ||
                        txtStatus.toLowerCase().includes(filter)
                    ) {
                        trs[i].style.display = "";
                    } else {
                        trs[i].style.display = "none";
                    }
                }
            }
        }

        // Fonction de filtrage par statut
        function filterByStatus() {
            const select = document.getElementById('statusFilter');
            const filter = select.value.toLowerCase();
            const table = document.getElementById('demandeTable');
            const trs = table.getElementsByTagName('tr');

            for (let i = 1; i < trs.length; i++) {
                let tdStatus = trs[i].getElementsByTagName('td')[3];
                if (tdStatus) {
                    let txtStatus = tdStatus.textContent || tdStatus.innerText;
                    if (filter === "" || txtStatus.toLowerCase().includes(filter)) {
                        trs[i].style.display = "";
                    } else {
                        trs[i].style.display = "none";
                    }
                }
            }
        }

        // Pagination interactive
        document.addEventListener('DOMContentLoaded', function() {
            const paginationLinks = document.querySelectorAll('.flex.justify-center.items-center.space-x-2.mt-8 a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetch(this.href)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newContent = doc.querySelector('.py-12.bg-gray-50');
                            const currentContent = document.querySelector('.py-12.bg-gray-50');
                            currentContent.innerHTML = newContent.innerHTML;
                            window.history.pushState({}, '', this.href);
                        });
                });
            });
        });
    </script>

    <!-- Styles personnalisés -->
    <style>
        body {
            background-color: #f9fafb;
        }

        /* Fixation de l'en-tête du tableau */
        .table-auto thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table-auto th {
            letter-spacing: 0.05em;
            padding: 18px;
            text-transform: uppercase;
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
            background-color: #000000;
        }

        .table-auto td {
            padding: 15px 20px;
            font-size: 0.875rem;
        }

        .table-auto tr:hover {
            background-color: #f3f4f6;
            transform: scale(1.02);
        }

        .table-auto td a {
            transition: color 0.2s ease-in-out;
        }

        .table-auto td a:hover {
            color: #2c7a7b;
        }

        /* Retirer la flèche du select */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        /* Augmenter la taille et le padding du select */
        select {
            padding-left: 1.5rem;
            padding-right: 1rem;
            font-size: 1rem;
        }

        /* Mobile responsive styles */
        @media (max-width: 640px) {
            .table-auto th, .table-auto td {
                padding: 12px;
            }

            .table-auto thead {
                display: none;
            }

            .table-auto tr {
                display: block;
                margin-bottom: 10px;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 10px;
            }

            .table-auto td {
                display: block;
                text-align: right;
                font-size: 14px;
            }

            .table-auto td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
                color: #6b7280;
            }
        }
    </style>
</x-app-layout>

