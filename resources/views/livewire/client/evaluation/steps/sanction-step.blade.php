<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')
    <h4 class="text-danger fw-bold mb-3">VI. SANCTIONS</h4>

    <div class="table-responsive mt-4">
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-danger text-white rounded-top">
                <tr>
                    <th colspan="3" class="text-center py-3">
                        En cas de sanction, veuillez saisir le nombre correspondant
                    </th>
                </tr>
                <tr class="text-center">
                    <th class="py-3">Type de Sanction</th>
                    <th class="py-3">Nbre(s)</th>
                    <th class="py-3">Sanction</th>
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
                                class="form-control rounded-pill" min="0">
                        </td>
                        <td class="align-middle">
                            <input type="text" wire:model.live="sanctions.{{ $index }}.sanction"
                                class="form-control rounded-pill" disabled value="{{ number_format($sanction['sanction'], 2) }}">
                        </td>
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
    @include('livewire.client.evaluation.control-navigation')
</div>
