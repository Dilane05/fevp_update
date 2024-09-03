<div>

    <nav aria-label="breadcrumb" class="py-3">
        <ol class="breadcrumb bg-white px-3 py-2 rounded-pill shadow-lg">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none text-secondary d-flex align-items-center">
                    <i class="bi bi-house-door-fill me-2"></i>
                    <span class="fw-semibold">Accueil</span>
                </a>
            </li>
            <li class="breadcrumb-item active text-primary d-flex align-items-center" aria-current="page">
                <i class="bi bi-journal-text me-2"></i>
                <span class="fw-bold">Évaluation : {{ $evaluation->code }}</span>

                <!-- Affichage du statut de l'évaluation -->
                @php
                    $userResponse = \App\Models\ResponseEvaluation::where('evaluation_id', $evaluation->id)
                        ->where('user_id', auth()->id())
                        ->first();
                @endphp

                @if (!$userResponse)
                    <span class="badge bg-secondary ms-3 d-flex align-items-center">
                        <i class="bi bi-hourglass-split me-1"></i> Non commencé
                    </span>
                @elseif($userResponse->status === 0)
                    <span class="badge bg-warning text-dark ms-3 d-flex align-items-center">
                        <i class="bi bi-hourglass-split me-1"></i> Brouillon
                    </span>
                @elseif($userResponse->status === 1)
                    <span class="badge bg-success ms-3 d-flex align-items-center">
                        <i class="bi bi-check-circle me-1"></i> Terminée
                    </span>
                @endif
            </li>
        </ol>
    </nav>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <livewire:checkout-evaluation-wizard show-step="create-evaluation-personal_info" :evaluation_id="$evaluation->id" />
    {{-- Success is as dangerous as failure. --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('show-error-modal', event => {
                var evaluationReminderModal = new bootstrap.Modal(document.getElementById(
                    'errorModal'));
                evaluationReminderModal.show();
            });
        });
    </script>
    <!-- Inclure le script Bootstrap pour les tooltips -->
    <script>
        // Activer les tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltips.forEach(function(tooltip) {
                new bootstrap.Tooltip(tooltip);
            });
        });
    </script>



</div>
