<div>
    <div class='pb-3'>
        <div class="d-flex justify-content-between w-100 flex-wrap mb-0 align-items-center">
            <div class="mb-lg-0">

                <h1 class="h4 mt-n2 d-flex justify-content-start align-items-end">
                    {{__('Bienvenue')}}, {{auth()->user()->name}}
                </h1>
                <p class="mt-n2">{{__('Fevp : votre portail en ligne de remplissage des fiches d\'évaluation')}} &#128524;</p>
            </div>
            <div class="d-flex justify-content-between">

            </div>
        </div>

    </div>

<div class='mt-5'>
    <div class='d-flex justify-content-between align-items-end mx-2'>
        <h5 class="h5">{{__("Derniers Journaux d'audits")}}</h5>
        <div>
            <a href='{{route("portal.auditlogs.index")}}' class='btn btn-info'>{{__("Voir tous")}}</a>
        </div>
    </div>
    <div class="card mt-2">
        <div class="table-responsive text-gray-700">
            <table class="table employee-table table-hover align-items-center ">
                <thead>
                    <tr>
                        <th class="border-bottom">{{__('Employee')}}</th>
                        <th class="border-bottom">{{__('Type D\'Action')}}</th>
                        <th class="border-bottom">{{__('Action Faites')}}</th>
                        <th class="border-bottom">{{__('Date Création')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td>
                            <a href="#" class="d-flex align-items-center">
                                <div class="avatar d-flex align-items-center justify-content-center fw-bold rounded bg-success me-3"><span class="text-white">{{initials($log->user)}}</span></div>
                                <div class="d-block"><span class="fw-bold">{{$log->user}}</span>
                                    <div class="small text-gray">{{$log->user}}</div>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span class="fw-normal badge super-badge badge-lg bg-{{$log->style}} rounded">{{$log->action_type}}</span>
                        </td>
                        <td>
                            <span class="fs-normal">{!! $log->action_perform !!}</span>
                        </td>
                        <td>
                            <span class="fw-normal">{{$log->created_at->format('Y-m-d')}}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="text-center text-gray-800 mt-2">
                                <h4 class="fs-4 fw-bold">{{__('Opps Rien ici')}} &#128540;</h4>
                                <p>{{__('Aucun Enregistrement..!')}}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

@push('scripts')

@endpush
</div>
