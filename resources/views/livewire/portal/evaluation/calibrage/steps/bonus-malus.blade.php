<div>
    <h4 class="text-primary fw-bold mb-3">V - BONUS ET MALUS</h4>
    <div class="table-responsive mt-4">
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-primary text-white rounded-top">
                <tr>
                    <th colspan="2" class="text-center py-3">
                        Mentionner tout fait marquant/tout projet mené au cours de la période évaluée et leur attribuer une note comprise entre -2,5 et 2,5
                    </th>
                    <th class="text-center py-3">[-2,5; 2,5]</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $index => $project)
                    <tr>
                        <td colspan="2" class="align-middle">
                            <input type="text" wire:model.live="projects.{{ $index }}.description"
                                class="form-control rounded-pill"
                                placeholder="Description" {{ $editable }}>
                        </td>
                        <td class="align-middle">
                            <input type="number" wire:model.live="projects.{{ $index }}.note"
                                class="form-control rounded-pill"
                                min="-2.5" max="2.5" step="0.1" placeholder="" {{ $editable }}>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-center text-muted fw-bold fs-5">
                        Le Total Bonus et Malus est <span class="text-primary"> {{ number_format($totalBonusMalus, 2) }} </span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
