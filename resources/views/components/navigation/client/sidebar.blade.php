@inject('request', 'Illuminate\Http\Request')
<div class="sidebar d-flex flex-column">
    <div class="text-center mb-4">
        <img src="https://via.placeholder.com/70" alt="Avatar" class="avatar mb-3">
        <h5>{{ auth()->user()->name }}</h5>
    </div>
    <ul class="nav flex-column mb-4">
        <li class="nav-item">
            <a class="nav-link {{ $request->routeIs('client.dashboard') ? 'active' : '' }}"
                href="{{ route('client.dashboard') }}" wire:navigate><i class="bi bi-house-door-fill me-2"></i><span
                    data-translate="dashboard">Tableau de Bord</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $request->routeIs('client.evaluations.index') ? 'active' : '' }}"
                href="{{ route('client.evaluations.index') }}" wire:navigate><i class="bi bi-bar-chart me-2"></i><span
                    data-translate="evaluation">Évaluations</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('client.evaluators.index') ? 'active' : '' }}"
                href="{{ route('client.evaluators.index') }}" wire:navigate>
                <i class="bi bi-person-circle me-2"></i>
                <span data-translate="evaluators">Évaluateurs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-gear me-2"></i><span
                    data-translate="settings">Paramètre</span></a>
        </li>
    </ul>

    <!-- Logout Button in Sidebar -->
    <div class="mt-auto">
        <a href="{{ route('logout') }}" class="btn btn-primary w-100 mb-4" data-translate="logout"><i
                class="bi bi-box-arrow-left me-2"></i><span data-translate="logout">Se Déconnecter</span></a>
        <div class="d-flex justify-content-center my-2">
            <img src="/img/logo.png" alt="Logo Icon">
        </div>
    </div>
</div>
