<x-filament::page>
    <!-- Insertion des CDN pour FontAwesome et Chart.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-HHsOCNeS0LMUuY+2/c5VdUKz0Te6zmsiX8TRp/UMCj9WD6czZ5Tf+yF1S0+tG+2Y5RjsXdxK5q+k3c7EtY/3xg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Styles personnalisés pour un dashboard ultra riche */
        body { font-family: 'Inter', sans-serif; }
        .header-banner {
            background: linear-gradient(135deg, #4F46E5, #9333EA);
            color: #fff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            margin-bottom: 2rem;
        }
        .custom-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.15);
        }
        .stat-title { font-size: 1.5rem; font-weight: 600; color: #4a5568; }
        .stat-value { font-size: 3rem; font-weight: 800; }
        .progress-bar-bg {
            background-color: #e2e8f0;
            border-radius: 9999px;
            overflow: hidden;
            height: 1rem;
        }
        .progress-bar-fill {
            background: linear-gradient(90deg, #4F46E5, #9333EA);
            height: 100%;
            transition: width 0.5s ease;
        }
        .activity-item {
            transition: background-color 0.3s;
        }
        .activity-item:hover { background-color: #f7fafc; }
    </style>

    <div class="min-h-screen bg-gray-50 p-8">
        <!-- Header Banner -->
        <header class="header-banner flex flex-col sm:flex-row items-center justify-between">
            <div>
                <h1 class="text-5xl font-extrabold">Dashboard</h1>
                <p class="mt-2 text-xl">Votre centre de contrôle avec des données en temps réel.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <x-filament::button tag="a" href="{{ route('filament.auth.logout') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>Se déconnecter
                </x-filament::button>
            </div>
        </header>

        <!-- Statistiques Globales -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
            <!-- Carte : Demandes de Service -->
            <div class="custom-card p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="stat-title">Demandes de Service</h2>
                        <p class="stat-value text-indigo-600">{{ $totalRequests }}</p>
                    </div>
                    <div class="text-indigo-500">
                        <i class="fa-regular fa-file-lines fa-3x"></i>
                    </div>
                </div>
                <p class="mt-4 text-gray-500">Total des demandes enregistrées</p>
            </div>

            <!-- Carte : Offres -->
            <div class="custom-card p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="stat-title">Offres</h2>
                        <p class="stat-value text-green-500">{{ $totalOffers }}</p>
                    </div>
                    <div class="text-green-500">
                        <i class="fa-solid fa-dollar-sign fa-3x"></i>
                    </div>
                </div>
                <p class="mt-4 text-gray-500">Total des offres soumises</p>
            </div>

        <!-- Carte : Catégories -->
<div class="custom-card p-8">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="stat-title">Catégories</h2>
            <p class="stat-value text-blue-500">{{ $totalCategories }}</p>
        </div>
        <div class="text-blue-500">
            <i class="fa-solid fa-tags fa-3x"></i>
        </div>
    </div>
    <p class="mt-4 text-gray-500">Total des catégories créées</p>
</div>


        <!-- Graphiques Avancés -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <!-- Graphique de Performance Hebdomadaire (Demandes) -->
            <div class="custom-card p-8">
                <h2 class="stat-title mb-4">Performance Hebdomadaire - Demandes</h2>
                <canvas id="performanceChart" class="w-full h-64"></canvas>
                <p class="mt-4 text-gray-500">Évolution quotidienne des demandes</p>
            </div>

            <!-- Graphique Comparatif (Offres vs Demandes) -->
            <div class="custom-card p-8">
                <h2 class="stat-title mb-4">Comparaison Offres vs Demandes</h2>
                <canvas id="comparisonChart" class="w-full h-64"></canvas>
                <p class="mt-4 text-gray-500">Comparaison sur une période donnée</p>
            </div>
        </section>

        <!-- Section Activités Récentes -->
        <section class="custom-card p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Activités Récentes</h2>
            <div class="divide-y divide-gray-200">
                <!-- Activité 1 -->
                <div class="activity-item py-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-circle-check fa-xl text-green-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700 font-medium">Nouvelle demande de service créée</p>
                        <p class="text-gray-500 text-sm">Il y a 5 minutes</p>
                    </div>
                </div>
                <!-- Activité 2 -->
                <div class="activity-item py-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-triangle-exclamation fa-xl text-yellow-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700 font-medium">Offre soumise par un prestataire</p>
                        <p class="text-gray-500 text-sm">Il y a 20 minutes</p>
                    </div>
                </div>
                <!-- Activité 3 -->
                <div class="activity-item py-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-chart-line fa-xl text-blue-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700 font-medium">Statistiques mises à jour automatiquement</p>
                        <p class="text-gray-500 text-sm">Il y a 1 heure</p>
                    </div>
                </div>
                <!-- Activité 4 -->
                <div class="activity-item py-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-user-plus fa-xl text-purple-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-700 font-medium">Nouvel utilisateur enregistré</p>
                        <p class="text-gray-500 text-sm">Il y a 2 heures</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Scripts Chart.js avec données réelles -->
    <script>
        // Conversion des données issues du backend en objets JavaScript
        const dailyRequestsData = @json($dailyRequests ?? []);
        const dailyOffersData = @json($dailyOffers ?? []);

        // Graphique de Performance Hebdomadaire (Demandes)
        const requestLabels = dailyRequestsData.map(item => item.date);
        const requestCounts = dailyRequestsData.map(item => item.count);
        const ctxPerformance = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctxPerformance, {
            type: 'line',
            data: {
                labels: requestLabels,
                datasets: [{
                    label: 'Demandes',
                    data: requestCounts,
                    backgroundColor: 'rgba(79,70,229,0.2)',
                    borderColor: 'rgba(79,70,229,1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Graphique Comparatif (Offres vs Demandes)
        const comparisonLabels = dailyRequestsData.map(item => item.date);
        const offerCounts = dailyOffersData.map(item => item.count);
        const ctxComparison = document.getElementById('comparisonChart').getContext('2d');
        new Chart(ctxComparison, {
            type: 'bar',
            data: {
                labels: comparisonLabels,
                datasets: [
                    {
                        label: 'Demandes',
                        data: requestCounts,
                        backgroundColor: 'rgba(93, 173, 226, 0.6)',
                        borderColor: 'rgba(93, 173, 226, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Offres',
                        data: offerCounts,
                        backgroundColor: 'rgba(88, 214, 141, 0.6)',
                        borderColor: 'rgba(88, 214, 141, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</x-filament::page>
