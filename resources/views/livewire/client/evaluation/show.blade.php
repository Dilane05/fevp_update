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
            </li>
        </ol>
    </nav>

    <livewire:checkout-evaluation-wizard show-step="create-evaluation-personal_info"  />
    {{-- Success is as dangerous as failure. --}}
</div>
