@extends('filament::layouts.app')

@section('content')
    <x-filament::page class="dashboard-page bg-gradient-to-br from-gray-50 to-gray-100">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                    Tableau de Bord
                </h1>
                <p class="mt-2 text-sm text-gray-600">
                    Aperçu global de votre activité
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</span>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 mb-8">
            @foreach([
                ['title' => 'Clients', 'value' => $totalClients, 'icon' => 'heroicon-o-users', 'trend' => 'up', 'change' => '12%'],
                ['title' => 'Demandes', 'value' => $totalRequests, 'icon' => 'heroicon-o-inbox', 'trend' => 'up', 'change' => '24%'],
                ['title' => 'Revenus', 'value' => '$' . number_format($totalRevenue, 2), 'icon' => 'heroicon-o-currency-dollar', 'trend' => 'up', 'change' => '18%'],
                ['title' => 'Satisfaction', 'value' => '98%', 'icon' => 'heroicon-o-star', 'trend' => 'steady'],
            ] as $stat)
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">{{ $stat['title'] }}</p>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $stat['value'] }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-{{ $stat['trend'] === 'up' ? 'green' : 'blue' }}-50">
                            <x-dynamic-component :component="$stat['icon']" class="w-6 h-6 text-{{ $stat['trend'] === 'up' ? 'green' : 'blue' }}-600" />
                        </div>
                    </div>
                    @isset($stat['change'])
                        <div class="mt-4 flex items-center text-sm text-{{ $stat['trend'] === 'up' ? 'green' : 'blue' }}-600">
                            @if($stat['trend'] === 'up')
                                <x-heroicon-s-arrow-trending-up class="w-4 h-4 mr-1" />
                            @else
                                <x-heroicon-s-arrow-trending-down class="w-4 h-4 mr-1" />
                            @endif
                            <span>{{ $stat['change'] }} vs mois dernier</span>
                        </div>
                    @endisset
                </div>
            @endforeach
        </div>

        {{-- Charts Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            {{-- Line Chart --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Activité récente</h2>
                <canvas id="activityChart" height="300"></canvas>
            </div>

            {{-- Pie Chart --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Répartition des demandes</h2>
                <canvas id="requestsChart" height="300"></canvas>
            </div>
        </div>

        {{-- Recent Requests --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-medium text-gray-900">Dernières demandes</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentRequests as $request)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $request->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->client->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $request->category === 'urgent' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $request->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $request->status === 'completed' ? 'bg-green-100 text-green-800' :
                                       ($request->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $request->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">
                <a href="{{ route('filament.admin.resources.service-requests.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                    Voir toutes les demandes →
                </a>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Line Chart
                const activityCtx = document.getElementById('activityChart').getContext('2d');
                new Chart(activityCtx, {
                    type: 'line',
                    data: {
                        labels: @json($activityLabels),
                        datasets: [{
                            label: 'Demandes',
                            data: @json($activityData),
                            borderColor: '#6366f1',
                            backgroundColor: 'rgba(99, 102, 241, 0.1)',
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Pie Chart
                const requestsCtx = document.getElementById('requestsChart').getContext('2d');
                new Chart(requestsCtx, {
                    type: 'pie',
                    data: {
                        labels: @json($categoriesLabels),
                        datasets: [{
                            data: @json($categoriesData),
                            backgroundColor: [
                                '#6366f1',
                                '#ec4899',
                                '#f59e0b',
                                '#10b981'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                            }
                        }
                    }
                });
            </script>
        @endpush
    </x-filament::page>
@endsection
