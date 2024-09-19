<div>
    <h2>Tableau des Objectifs</h2>

    <!-- Boucle sur les objectifs -->
    @foreach($objectifs as $index => $objectif)
        <div class="objectif">
            <h3>Objectif {{ $index + 1 }}</h3>

            <!-- Bouton pour supprimer un objectif -->
            <button wire:click="removeObjectif({{ $index }})" type="button">Supprimer l'objectif</button>

            <!-- Tableau des indicateurs -->
            <table border="1" style="width:100%; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th>Cible</th>
                        <th>Coef</th>
                        <th>Fréquence d'Évaluation</th>
                        <th>Mode de Calcul</th>
                        <th>Observations</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle sur les indicateurs -->
                    @foreach($objectif['indicateurs'] as $indicateurIndex => $indicateur)
                        <tr>
                            <td>
                                <input type="text" wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.cible">
                            </td>
                            <td>
                                <input type="text" wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.coef">
                            </td>
                            <td>
                                <input type="text" wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.frequence">
                            </td>
                            <td>
                                <input type="text" wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.mode_calcul">
                            </td>
                            <td>
                                <input type="text" wire:model="objectifs.{{ $index }}.indicateurs.{{ $indicateurIndex }}.observations">
                            </td>
                            <td>
                                <button wire:click="removeIndicateur({{ $index }}, {{ $indicateurIndex }})" type="button">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Bouton pour ajouter un indicateur -->
            <button wire:click="addIndicateur({{ $index }})" type="button">Ajouter un indicateur</button>
        </div>
    @endforeach

    <!-- Bouton pour ajouter un objectif -->
    <button wire:click="addObjectif" type="button">Ajouter un objectif</button>
</div>
