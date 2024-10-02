<div>
    <h4 class="text-primary fw-bold mb-3">II - TENUE GLOBALE DU POSTE</h4>

    <p class="text-secondary mb-4">
        Veuillez choisir au minimum 02 DCR dans la liste déroulante et leur attribuer une note comprise
        entre 0 et 1,25.
        (La rubrique permet d’apprécier les autres Domaines Clés de Résultat (DCR) non pris en compte dans
        les objectifs.
        Les DCR à évaluer dans ce cas doivent inclure des aspects sur lesquels les performances ont été
        bonnes et des aspects sur lesquels les performances n’ont pas été satisfaisantes pour des soucis d’équilibre.)
    </p>

    <div class="table-responsive">
        <table class="table table-borderless rounded-3 shadow-sm align-middle">
            <thead class="bg-primary text-white rounded-top">
                <tr>
                    <th scope="col" class="py-3">Domaines Clés de Résultats</th>
                    <th scope="col" class="py-3">Note</th>
                    <th scope="col" class="py-3">Observations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keyResults as $index => $result)
                    <tr>
                        <td>
                            <input type="text" wire:model.live="keyResults.{{ $index }}.domain"
                                class="form-control rounded-pill" {{ $editable }} >
                        </td>
                        <td>
                            <input type="text" wire:model.live="keyResults.{{ $index }}.note"
                                class="form-control rounded-pill" {{ $editable }} >
                        </td>
                        <td>
                            <input type="text" wire:model.live="keyResults.{{ $index }}.observations"
                                class="form-control rounded-pill" {{ $editable }} >
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-center text-muted fw-bold fs-5">
                        Note globale: {{ number_format($globalScore ?? 0, 2) }} /5
                </tr>
            </tfoot>
        </table>
    </div>
</div>
