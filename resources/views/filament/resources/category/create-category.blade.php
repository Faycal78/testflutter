<x-filament::page>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Créer une Nouvelle Catégorie</h1>
        <!-- Le formulaire est géré par Livewire -->
        <form wire:submit.prevent="create">
            <div class="space-y-4">
                <div>
                    <x-filament-forms::label for="name" :value="__('Nom de la catégorie')" />
                    <x-filament-forms::input id="name" wire:model.defer="data.name" placeholder="Entrez le nom" required />
                </div>
                <div>
                    <x-filament-forms::label for="slug" :value="__('Slug')" />
                    <x-filament-forms::input id="slug" wire:model.defer="data.slug" placeholder="Entrez le slug" required />
                </div>
                <div>
                    <x-filament-forms::label for="description" :value="__('Description')" />
                    <textarea id="description" wire:model.defer="data.description" class="w-full border-gray-300 rounded-md shadow-sm" rows="3" placeholder="Entrez la description"></textarea>
                </div>
            </div>
            <div class="mt-6">
                <x-filament::button type="submit">
                    Créer la Catégorie
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament::page>
