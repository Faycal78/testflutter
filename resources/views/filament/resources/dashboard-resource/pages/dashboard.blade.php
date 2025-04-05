<x-filament::page>
    <div class="space-y-4">
        <h1 class="text-2xl font-bold">Tableau de bord</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-lg font-semibold">Total des demandes de service</h2>
                <p class="text-3xl">{{ $totalRequests }}</p>
            </div>
            <div class="bg-white shadow rounded p-6">
                <h2 class="text-lg font-semibold">Total des offres</h2>
                <p class="text-3xl">{{ $totalOffers }}</p>
            </div>
        </div>
    </div>
</x-filament::page>
