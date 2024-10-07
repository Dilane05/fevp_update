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
            <div class="chart-container">
                <!-- Canvas pour le diagramme radar -->
                <canvas id="notesRadarChart"></canvas>
            </div>
        </div>

    </div>

</div>
