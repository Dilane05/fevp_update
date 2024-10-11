<div class="container mx-2">
    <nav class="nav mb-4" aria-label="Navigation des étapes">
        @foreach ($steps as $step)
            <div class="nav-link d-inline-flex align-items-center justify-content-center position-relative py-2 px-3 rounded {{ $step->isCurrent() ? 'bg-success text-white shadow-lg' : 'bg-light text-muted' }} fw-bold text-sm mx-1"
                style="transition: all 0.3s ease-in-out; cursor: pointer;"
                @if ($step->isPrevious()) wire:click="{{ $step->show() }}" @endif
                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.2)';"
                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                {{ $step->label }}
                @if (!$loop->last)
                    <i class="bi bi-chevron-right mx-2"></i>
                @endif
            </div>
        @endforeach
    </nav>
</div>
