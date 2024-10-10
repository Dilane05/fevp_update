<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4">Moyenne Globale</h1>
                <h2 class="display-2 text-primary">{{ number_format($global_average, 2) }}/20</h2>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h4>Moyenne par Rubrique</h4>
                <ul class="list-group">
                    <li class="list-group-item">Bilan Résultat:
                        {{ number_format($note_bilan_resultat, 2) }}/{{ $total_bilan_resultat }}</li>
                    <li class="list-group-item">Tenue globale du poste:
                        {{ number_format($note_tenue_global_poste, 2) }}/{{ $total_tenue_global_poste }}</li>
                    <li class="list-group-item">Qualité Managériale:
                        {{ number_format($note_quality_managerial, 2) }}/{{ $total_quality_managerial }}</li>
                    <li class="list-group-item">Conformité à la culture d'entreprise:
                        {{ number_format($note_compliance_corporate, 2) }}/{{ $total_compliance_corporate }}</li>
                    <li class="list-group-item">Bonus Malus:
                        {{ number_format($note_bonus_malus, 2) }}</li>
                    <li class="list-group-item">Sanctions:
                        {{ number_format($note_sanction, 2) }}</li>
                </ul>
            </div>

            <div class="chart-container">
                <!-- Canvas pour le diagramme radar -->
                <canvas id="notesRadarChart"></canvas>
            </div>

        </div>
    </div>

    @if (auth()->user()->id == $response->user->responsable_n1 || auth()->user()->id == $response->user->responsable_n2)
        @include('livewire.client.evaluation.control-navigation')
    @else
        <div class="d-flex my-2 justify-content-end">
            <a class="btn btn-secondary rounded-pill" wire:click="previousStep">{{ __('Précédent') }}</a>
            <button class="btn btn-primary mx-2" wire:click="save"> {{ __('Sauvegarder') }} </button>
        </div>
    @endif

    <script>
        // Quand le document est chargé, on crée le diagramme radar

        var percentages = [
            ({{ $note_bilan_resultat }} / {{ $total_bilan_resultat }}) * 100,
            ({{ $note_tenue_global_poste }} / {{ $total_tenue_global_poste }}) * 100,
            ({{ $note_quality_managerial }} / {{ $total_quality_managerial }}) * 100,
            ({{ $note_compliance_corporate }} / {{ $total_compliance_corporate }}) * 100,
        ];

        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('notesRadarChart').getContext('2d');
            var radarChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: [
                        'Bilan Résultat',
                        'Tenue globale du poste',
                        'Qualité Managériale',
                        'Conformité à la culture d\'entreprise',
                    ],
                    datasets: [{
                        label: 'Forces et Faiblesses',
                        data: percentages, // Les pourcentages calculés
                        backgroundColor: 'rgba(173, 216, 230, 0.15)', // Bleu très doux et transparent
                        borderColor: 'rgba(0, 123, 255, 0.5)', // Douce couleur bleue
                        borderWidth: 1.5,
                        pointBackgroundColor: 'rgba(0, 123, 255, 0.7)', // Points plus subtils
                        pointBorderColor: '#ffffff',
                        pointHoverBackgroundColor: '#ffffff',
                        pointHoverBorderColor: 'rgba(0, 123, 255, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        r: {
                            angleLines: {
                                color: 'rgba(0, 0, 0, 0.05)' // Lignes douces
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)', // Grille très légère
                            },
                            suggestedMin: 0,
                            suggestedMax: 100 // Les pourcentages vont de 0 à 100
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Masquer la légende pour un design épuré
                        }
                    }
                }
            });
        });

    </script>

</div>
