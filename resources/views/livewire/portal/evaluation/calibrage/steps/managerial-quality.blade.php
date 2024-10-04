<div>
    <p class="text-secondary">
        Veuillez renseigner la cible et le taux de réalisation à chaque rubrique. Uniquement pour les "Chefs Service" et
        les "Fonctions spécifiques".
    </p>

    <div class="table-responsive mt-4">
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-primary text-white rounded-top">
                <tr>
                    <th scope="col" rowspan="2" class="align-middle py-3">Qualités Managériales</th>
                    <th scope="col" colspan="3" class="text-center py-3">Niveau de performance (3)</th>
                </tr>
                <tr>
                    <th scope="col" class="py-2">Cible</th>
                    <th scope="col" class="py-2">% Réal</th>
                    <th scope="col" class="py-2">Observations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($qualities as $index => $quality)
                    <tr>
                        <td>
                            <input type="text" wire:model.live="qualities.{{ $index }}.quality"
                                class="form-control rounded-pill" {{ $is_manager }} {{ $editable }}>
                            @if (!empty($qualitiesRes[$index]['quality']))
                                <span
                                    style="color: {{ $quality['quality'] != $qualitiesRes[$index]['quality'] ? 'orange' : 'gray' }}">
                                    Mention initiale: {{ $qualitiesRes[$index]['quality'] }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="number" step="0.01" wire:model.live="qualities.{{ $index }}.target"
                                class="form-control rounded-pill" {{ $is_manager }} {{ $editable }}>
                            @if (!empty($qualitiesRes[$index]['target']))
                                <span
                                    style="color: {{ $quality['target'] != $qualitiesRes[$index]['target'] ? 'orange' : 'gray' }}">
                                    Mention initiale: {{ $qualitiesRes[$index]['target'] }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="number" step="0.01"
                                wire:model.live="qualities.{{ $index }}.realization"
                                class="form-control rounded-pill" {{ $is_manager }} {{ $editable }}>
                            @if (!empty($qualitiesRes[$index]['realization']))
                                <span
                                    style="color: {{ $quality['realization'] != $qualitiesRes[$index]['realization'] ? 'orange' : 'gray' }}">
                                    Mention initiale: {{ $qualitiesRes[$index]['realization'] }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <input type="text" wire:model.live="qualities.{{ $index }}.observations"
                                class="form-control rounded-pill" {{ $editable }}>
                            @if (!empty($qualitiesRes[$index]['observations']))
                                <span
                                    style="color: {{ $quality['observations'] != $qualitiesRes[$index]['observations'] ? 'orange' : 'gray' }}">
                                    Mention initiale: {{ $qualitiesRes[$index]['observations'] }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-center text-muted fw-bold fs-5">
                        Note Globale: <span class="text-primary">
                            {{ number_format($globalScoreMgr, 2) }}
                            {{-- / --}}
                            {{-- {{ $totalNoteMgr }}  --}}
                        </span>
                    </td>
                </tr>
                {{-- <tr>
                    <td colspan="4" class="text-center text-danger fw-bold fs-6">
                        @if ($errorsModalVisible)
                            @foreach ($errorMessages as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        @endif
                    </td>
                </tr> --}}
            </tfoot>
        </table>

    </div>
</div>
