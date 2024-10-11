<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableaux des Évaluations</title>

    <!-- Importation de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">

    <style>
        /* Réinitialisation des marges par défaut */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 40px;
            position: relative;
        }

        h1 {
            font-family: 'Lora', serif;
            text-align: center;
            color: #2c3e50;
            font-size: 2em;
            margin-bottom: 30px;
            font-weight: 700;
        }

        h2 {
            font-family: 'Roboto', sans-serif;
            font-size: 1.8em;
            color: #34495e;
            margin-bottom: 15px;
            border-left: 4px solid #3498db;
            padding-left: 10px;
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table thead {
            background-color: #3498db;
            color: white;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
        }

        table th {
            font-weight: 500;
            font-size: 1.1em;
            letter-spacing: 0.5px;
        }

        table td {
            font-size: 0.95em;
            color: #2c3e50;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #ecf0f1;
            transition: background-color 0.3s ease-in;
        }

        /* Style pour les tables sans données */
        table tbody tr td {
            opacity: 0.8;
        }

        /* Style des observations */
        .observations {
            font-style: italic;
            color: #7f8c8d;
        }

        /* Footer des tableaux pour afficher le total */
        table tfoot {
            background-color: #ecf0f1;
            font-weight: bold;
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4em;
            color: rgba(52, 152, 219, 0.1);
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
            z-index: -1;
        }

        /* Section Information Évalué */
        /* Section Information Évalué */
        .info-section {
            background-color: #ecf0f1;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 15px;
            font-size: 0.9em;
        }

        .info-item {
            flex: 1 1 auto;
            margin: 0 10px;
        }

        .info-label {
            font-weight: bold;
            color: #2c3e50;
        }

        .info-value {
            color: #34495e;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <!-- Watermark -->
    <div class="watermark">Produit par la FEVP</div>

    <h1>Évaluations de Performance {{ $evaluation->code }} </h1>

    <!-- Section Information sur l'évalué -->
    <div class="info-section">
        <div class="info-item">
            <span class="info-label">Matricule :</span>
            <span class="info-value">{{ $response->user->matricule }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Nom :</span>
            <span class="info-value">{{ $response->user->name }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Poste :</span>
            <span class="info-value">{{ $response->user->occupation }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Direction :</span>
            <span class="info-value">{{ $response->user->direction->name }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Site :</span>
            <span class="info-value">{{ $response->user->site->name }}</span>
        </div>
    </div>


    <!-- Bilan Résultat -->
    <h2>BILAN DES RESULTATS</h2>
    <table>
        <thead>
            <tr>
                <th>Objectif</th>
                <th>Indicateur</th>
                <th>Coefficient</th>
                <th>Cible %</th>
                <th>Cible Nb</th>
                <th>Résultat %</th>
                <th>Résultat Nb</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response->bilan_resultat as $item)
                <tr>
                    <td>{{ $item['objectif'] }}</td>
                    <td>{{ $item['indicateur'] }}</td>
                    <td>{{ $item['coef'] }}</td>
                    <td>{{ $item['cible_pct'] }}</td>
                    <td>{{ $item['cible_nb'] }}</td>
                    <td>{{ $item['resultat_pct'] }}</td>
                    <td>{{ $item['resultat_nb'] }}</td>
                    <td>{{ $item['note'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">Note Obtenu</td>
                <td>15</td>
            </tr>
        </tfoot>
    </table>

    <!-- Tenue Global -->
    <h2>TENUE GLOBALE DU POSTE</h2>
    <table>
        <thead>
            <tr>
                <th>Domaine</th>
                <th>Note</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response->tenue_global as $item)
                <tr>
                    <td>{{ $item['domain'] }}</td>
                    <td>{{ $item['note'] }}</td>
                    <td class="observations">{{ $item['observations'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Note Obtenu</td>
                <td>15</td>
            </tr>
        </tfoot>
    </table>

    <!-- Managerial Quality -->
    <h2>QUALITE MANAGERIALES</h2>
    <table>
        <thead>
            <tr>
                <th>Qualité</th>
                <th>Cible</th>
                <th>Réalisation</th>
                <th>Observations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response->manegerial_quality as $item)
                <tr>
                    <td>{{ $item['quality'] }}</td>
                    <td>{{ $item['target'] }}</td>
                    <td>{{ $item['realization'] }}</td>
                    <td class="observations">{{ $item['observations'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Note Obtenu</td>
                <td>15</td>
            </tr>
        </tfoot>
    </table>

    <!-- Compliance Corporate -->
    <h2>CONFORMITE A LA CULTURE D'ENTREPRISE</h2>
    <table>
        <thead>
            <tr>
                <th>Critères</th>
                <th>Score Sélectionné</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response->compliance_corporate as $item)
                <tr>
                    <td>{{ $item['criteria'] }}</td>
                    <td>{{ $item['selectedScore'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Note Obtenu</td>
                <td>15</td>
            </tr>
        </tfoot>
    </table>

    <!-- Bonus Malus -->
    <h2>BONUS ET MALUS</h2>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response->bonus_malus as $item)
                <tr>
                    <td>{{ $item['description'] }}</td>
                    <td>{{ $item['note'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Note Obtenu</td>
                <td>15</td>
            </tr>
        </tfoot>
    </table>

    <!-- Sanction -->
    <h2>SANCTIONS</h2>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Nombre</th>
                <th>Sanction</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response->sanction as $item)
                <tr>
                    <td>{{ $item['type'] }}</td>
                    <td>{{ $item['number'] }}</td>
                    <td>{{ $item['sanction'] }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Note Obtenu</td>
                <td>15</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
