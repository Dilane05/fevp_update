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

        <div class="col-md-6">
            <canvas id="evaluationChart"></canvas>
        </div>

    </div>

    <script>
        alert('k')
        document.addEventListener('livewire:load', function() {
            var ctx = document.getElementById('evaluationChart').getContext('2d');

            var evaluationChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: [
                        'Bilan Résultat',
                        'Tenue globale du poste',
                        'Qualité Managériale',
                        'Conformité à la culture d\'entreprise',
                        'Bonus Malus',
                        'Sanctions'
                    ],
                    datasets: [{
                        label: 'Résultat évalué',
                        data: [
                            {{ $note_bilan_resultat }},
                            {{ $note_tenue_global_poste }},
                            {{ $note_quality_managerial }},
                            {{ $note_compliance_corporate }},
                            {{ $note_bonus_malus }},
                            {{ $note_sanction }}
                        ],
                        backgroundColor: 'rgba(255, 193, 7, 0.2)', // Doux et léger
                        borderColor: 'rgba(255, 193, 7, 1)',
                        borderWidth: 2
                    }, {
                        label: 'Minimum - 50%',
                        data: [10, 10, 5, 7.5, 0, 0], // valeurs minimums
                        backgroundColor: 'rgba(220, 53, 69, 0.2)',
                        borderColor: 'rgba(220, 53, 69, 1)',
                        borderWidth: 2
                    }, {
                        label: 'Note Max - 100%',
                        data: [
                            {{ $total_bilan_resultat }},
                            {{ $total_tenue_global_poste }},
                            {{ $total_quality_managerial }},
                            {{ $total_compliance_corporate }},
                            5, // Note max pour Bonus
                            5 // Note max pour Sanctions
                        ],
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            max: 20
                        }
                    }
                }
            });
        });
    </script>
</div>
