<div>
    <div class="table-responsive mt-4">
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-danger text-white rounded-top">
                <tr>
                    <th colspan="3" class="text-center py-3">
                        En cas de sanction, veuillez saisir le nombre correspondant
                    </th>
                </tr>
                <tr class="">
                    <th class="py-3">Type de Sanction</th>
                    <th class="py-3">Nbre(s)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sanctions as $index => $sanction)
                    <tr>
                        <td class="align-middle">
                            {{ $sanction['type'] }}
                        </td>
                        <td class="align-middle">
                            <input type="number" wire:model.live="sanctions.{{ $index }}.number"
                                class="form-control rounded-pill" min="0" {{ $editable }}>
                        </td>
                        {{-- <td class="align-middle">
                            <input type="text" wire:model.live="sanctions.{{ $index }}.sanction"
                                class="form-control rounded-pill" disabled value="{{ number_format($sanction['sanction'], 2) }}">
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-center text-muted fw-bold fs-5">
                        Le Total Sanctions est {{ number_format($totalSanctionScore, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Note Explicative -->
    <div class="mt-4 p-3 bg-light rounded-3 shadow-sm">
        <h5 class="text-primary">Règles de Calcul des Sanctions</h5>
        <p class="text-muted mb-0">
            Les sanctions sont calculées selon les critères suivants :
        <ul class="list-unstyled">
            <li><strong>Nombre d'avertissements (s)</strong> : -2.5 points par avertissement.</li>
            <li><strong>Nombre de blâmes (s)</strong> : -5 points par blâme.</li>
            <li><strong>Nombre de mises à pied de 1 à 3 jours</strong> : -7.5 points par mise à pied.</li>
            <li><strong>Nombre de mises à pied de 4 à 5 jours</strong> : -10 points par mise à pied.</li>
            <li><strong>Nombre de mises à pied de 6 à 8 jours</strong> : -12.5 points par mise à pied.</li>
        </ul>
        </p>
    </div>
</div>
