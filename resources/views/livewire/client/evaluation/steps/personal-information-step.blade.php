<div>

    @include('livewire.client.evaluation.navigation')

    <div class="container my-5 mx-2">
        <div class="row g-4">
            <!-- Nom complet -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-primary">
                        <i class="bi bi-person-circle display-6"></i>
                    </div>
                    <h5 class="fw-bold">Nom complet</h5>
                    <p class="mb-0">{{ auth()->user()->name }}</p>
                </div>
            </div>

            <!-- Matricule -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-info">
                        <i class="bi bi-card-list display-6"></i>
                    </div>
                    <h5 class="fw-bold">Matricule</h5>
                    <p class="mb-0">{{ auth()->user()->matricule }}</p>
                </div>
            </div>

            <!-- Poste -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-success">
                        <i class="bi bi-briefcase display-6"></i>
                    </div>
                    <h5 class="fw-bold">Poste</h5>
                    <p class="mb-0">{{ auth()->user()->occupation }}</p>
                </div>
            </div>

            <!-- Statut Catégoriel -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-warning">
                        <i class="bi bi-award display-6"></i>
                    </div>
                    <h5 class="fw-bold">Statut Catégoriel</h5>
                    <p class="mb-0">{{ auth()->user()->statut_category ? auth()->user()->statut_category : 'Non Attribué' }}</p>
                </div>
            </div>

            <!-- Ancienneté au poste -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-danger">
                        <i class="bi bi-clock display-6"></i>
                    </div>
                    <h5 class="fw-bold">Ancienneté au poste (en années)</h5>
                    <p class="mb-0">{{ auth()->user()->length_of_service ? auth()->user()->length_of_service : 'Non Connu' }}</p>
                </div>
            </div>

            <!-- Temporaire/Permanent -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-secondary">
                        <i class="bi bi-check2-circle display-6"></i>
                    </div>
                    <h5 class="fw-bold">Temporaire/Permanent</h5>
                    <p class="mb-0">{{ auth()->user()->pemp_temp ? auth()->user()->pemp_temp : '' }}</p>
                </div>
            </div>

            <!-- Date d'embauche -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-muted">
                        <i class="bi bi-calendar-date display-6"></i>
                    </div>
                    <h5 class="fw-bold">Date d'embauche</h5>
                    <p class="mb-0">{{ auth()->user()->hiring_date }}</p>
                </div>
            </div>

            <!-- Responsable N1 -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-dark">
                        <i class="bi bi-person-badge display-6"></i>
                    </div>
                    <h5 class="fw-bold">Responsable N1</h5>
                    <p class="mb-0">{{ auth()->user()->responsable_n1 ? auth()->user()->responsableN1->name : 'Non attribué' }}</p>
                </div>
            </div>

            <!-- Responsable N2 -->
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-primary">
                        <i class="bi bi-person-badge-fill display-6"></i>
                    </div>
                    <h5 class="fw-bold">Responsable N2</h5>
                    <p class="mb-0">{{ auth()->user()->responsable_n2 ? auth()->user()->responsableN2->name : 'Non attribué' }}</p>
                </div>
            </div>

            <!-- Entreprise, Direction, Site -->
            <div class="col-12">
                <div class="p-4 bg-light rounded shadow-sm h-100 d-flex flex-column">
                    <div class="mb-3 text-success">
                        <i class="bi bi-building display-6"></i>
                    </div>
                    <h5 class="fw-bold">Informations d'Entreprise</h5>
                    <p class="mb-0">
                        <span class="fw-bold">Entreprise :</span> {{ auth()->user()->enterprise->name }} |
                        <span class="fw-bold">Direction :</span> {{ auth()->user()->direction->name }} |
                        <span class="fw-bold">Site :</span> {{ auth()->user()->site->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Stop trying to control. --}}
    <button class="btn btn-primary" wire:click="submit">
        {{ __('Next') }}
    </button>
</div>
