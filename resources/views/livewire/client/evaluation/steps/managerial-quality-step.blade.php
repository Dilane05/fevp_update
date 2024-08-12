<div class="p-4 bg-light rounded-4 shadow-sm">
    @include('livewire.client.evaluation.navigation')
    <h4 class="text-primary fw-bold mb-3">III - QUALITÉS MANAGÉRIALES</h4>
    <p class="text-secondary">
        Veuillez renseigner la cible et le taux de réalisation à chaque rubrique. Uniquement pour les "Chefs
        Service" et les "Fonctions spécifiques".
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
                                class="form-control rounded-pill">
                        </td>
                        <td>
                            <input type="text" wire:model.live="qualities.{{ $index }}.target"
                                class="form-control rounded-pill">
                        </td>
                        <td>
                            <input type="text" wire:model.live="qualities.{{ $index }}.realization"
                                class="form-control rounded-pill">
                        </td>
                        <td>
                            <input type="text" wire:model.live="qualities.{{ $index }}.observations"
                                class="form-control rounded-pill">
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-center text-muted fw-bold fs-5">Veuillez remplir le tableau</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @include('livewire.client.evaluation.control-navigation')
</div>
