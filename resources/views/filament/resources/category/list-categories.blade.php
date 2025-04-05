<x-filament::page>
    <div class="max-w-7xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Liste des Catégories</h1>

        <div class="mb-4">
            <a href="{{ route('filament.resources.categories.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                Créer une Nouvelle Catégorie
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Créé le</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($records as $record)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $record->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $record->slug }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($record->description, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $record->created_at ? $record->created_at->format('d/m/Y H:i') : '-' }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('filament.resources.categories.edit', $record) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                <form action="{{ route('filament.resources.categories.destroy', $record) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Aucune catégorie trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
