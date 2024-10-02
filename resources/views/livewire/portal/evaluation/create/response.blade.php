<!-- Modal Structure -->
<div wire:ignore.self class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel">Détails de l'évaluation : {{ $evaluation ? $evaluation->title : '' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Informations de l'évaluation -->
                @if ($evaluation)
                    <div class="evaluation-info mb-4">
                        <p><strong>Code :</strong> {{ $evaluation->code }}</p>
                        <p><strong>Dates :</strong> Du {{ $evaluation->start_date->format('d/m/Y') }} au
                            {{ $evaluation->end_date->format('d/m/Y') }}</p>
                        <p><strong>Créée par :</strong> {{ $evaluation->user->name }}</p>
                    </div>
                @endif

                <!-- Réponses -->
                <div class="responses">
                    @if(empty($responses))
                        <p class="text-center text-warning">Aucune réponse pour cette évaluation pour le moment.</p>
                    @else
                        @foreach ($responses as $response)
                            <div class="response-item mb-3 p-3 rounded">
                                <div class="response-header">
                                    <h6><strong>Réponse de :</strong> {{ $response->user->name }}</h6>
                                    <span
                                        class="badge badge-info">{{ $response->status ? 'Finalisée' : 'En attente' }}</span>
                                    <small class="text-muted">Soumise le :
                                        {{ $response->date ? $response->date->format('d/m/Y') : 'N/A' }}</small>
                                </div>
                                <div class="response-body mt-2">
                                    <div class="response-section">
                                        <h6>Bilan Résultat</h6>
                                        <p>{{ json_encode($response->bilan_resultat) }}</p>
                                        <p class="text-muted"><strong>Note:</strong>
                                            {{ $response->note_bilan_resultat }}/10</p>
                                    </div>

                                    <div class="response-section">
                                        <h6>Tenue Globale</h6>
                                        <p>{{ json_encode($response->tenue_global) }}</p>
                                        <p class="text-muted"><strong>Note:</strong>
                                            {{ $response->note_tenue_global }}/10</p>
                                    </div>

                                    <div class="response-section">
                                        <h6>Qualité Managériale</h6>
                                        <p>{{ json_encode($response->manegerial_quality) }}</p>
                                        <p class="text-muted"><strong>Note:</strong>
                                            {{ $response->note_mangeriale_quality }}/10</p>
                                    </div>

                                    <!-- Ajoute ici d'autres sections selon les détails de l'évaluation -->
                                </div>

                                <div class="response-footer mt-3">
                                    <h6>Commentaires</h6>
                                    <p><strong>Commentaire N1 :</strong> {{ $response->comment_n1 }}</p>
                                    <p><strong>Commentaire N2 :</strong> {{ $response->comment_n2 }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>

    <style>
        /* Style minimaliste pour la modal */
        .modal-content {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .modal-header,
        .modal-footer {
            border: none;
            background-color: #ffffff;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .modal-body {
            font-size: 1rem;
            line-height: 1.6;
            color: #333;
        }

        /* Style pour les informations générales de l'évaluation */
        .evaluation-info p {
            margin-bottom: 8px;
        }

        /* Style des réponses */
        .response-item {
            background-color: #fff;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
        }

        .response-header h6 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .response-section h6 {
            margin-top: 10px;
            font-size: 1rem;
            font-weight: 500;
            color: #007bff;
        }

        .response-section p {
            font-size: 0.95rem;
            margin: 0;
            color: #555;
        }

        .response-footer p {
            font-size: 0.9rem;
            color: #666;
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
    </style>

</div>
