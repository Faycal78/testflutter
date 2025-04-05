<x-filament::page>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Modifier la Catégorie</h1>
        <!-- Le formulaire d'édition est également géré par le composant Livewire -->
        <form wire:submit.prevent="update">
            <div class="space-y-4">
                <div>
                    <x-filament::input.label for="name" value="Nom de la catégorie" />
                    <x-filament::input.text wire:model.defer="data.name" id="name" placeholder="Entrez le nom" required />
                </div>
                <div>
                    <x-filament::input.label for="slug" value="Slug" />
                    <x-filament::input.text wire:model.defer="data.slug" id="slug" placeholder="Entrez le slug" required />
                </div>
                <div>
                    <x-filament::input.label for="description" value="Description" />
                    <textarea wire:model.defer="data.description" id="description" class="w-full border-gray-300 rounded-md shadow-sm" rows="3" placeholder="Entrez la description"></textarea>
                </div>
            </div>
            <div class="mt-6">
                <x-filament::button type="submit">
                    Enregistrer les Modifications
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament::page>
