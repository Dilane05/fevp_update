<div class="container mt-5">
    {{-- <h2>LEGENDE DES COULEURS</h2>
    <table class="table table-bordered">
        <tr>
            <td>
                <div class="rounded-pill" style="background: red; width:20px;"> d  </div>
            </td>
            <td>Performance 80%</td>
        </tr>
        <tr>
            <td>89%</td>
            <td>Performance = [80% ; 96%]</td>
        </tr>
        <tr>
            <td>95%</td>
            <td>Performance= [96% ; 110%]</td>
        </tr>
    </table> --}}
    <h6> <span class="fs-3"> Tbord : </span> <span class="text-primary"> {{ $tbord->code }} </span> </h6>

    <div style="overflow-x: scroll ">

        <table class="table table-bordered outer-table">
            <thead>
                <tr>
                    <th>Objectifs</th>
                    <th>Indicateurs</th>
                    <th>Cible</th>
                    <th>Coef / 70</th>
                    <th>
                        performance
                        {{-- <table class="table table-bordered outer-table">
                            <th> performance </th>
                            @foreach (['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                <th>{{ ucfirst($month) }}-23</th>
                            @endforeach
                        </table> --}}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($performances as $performance)
                    <tr>
                        <td>{{ $performance['objectif'] }}</td>
                        <td>{{ $performance['indicateur'] }}</td>
                        <td>{{ $performance['cible'] }}</td>
                        <td>{{ $performance['coef'] }}</td>
                        <td colspan="14">
                            <table class="table table-bordered inner-table">
                                <thead>
                                    <tr>
                                        <th>Performance Globale / 70</th>
                                        @foreach (['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                            <th>{{ ucfirst($month) }}-23</th>
                                        @endforeach
                                        <th>Année 2023</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nb actions réalisées</td>
                                        @foreach (['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                            <td>
                                                <input type="number"
                                                    wire:model="performances[{{ $loop->parent->index }}]['performance']['Nb actions réalisées']['{{ $month }}']"
                                                    class="form-control rounded-pill form-control rounded-pill-lg"
                                                    value="{{ $performance['performance']['Nb actions réalisées'][$month] ?? '' }}">
                                            </td>
                                        @endforeach
                                        <td>{{ array_sum($performance['performance']['Nb actions réalisées'] ?? []) }}
                                        </td>
                                        <td>{{ $performance['note'] ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nb actions réalisées dans délais</td>
                                        @foreach (['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                            <td>
                                                <input type="number"
                                                    wire:model="performances[{{ $loop->parent->index }}]['performance']['Nb actions réalisées dans délais']['{{ $month }}']"
                                                    class="form-control rounded-pill form-control rounded-pill-lg"
                                                    value="{{ $performance['performance']['Nb actions réalisées dans délais'][$month] ?? '' }}">
                                            </td>
                                        @endforeach
                                        <td>{{ array_sum($performance['performance']['Nb actions réalisées dans délais'] ?? []) }}
                                        </td>
                                        <td>{{ $performance['note'] ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nb actions planifiées</td>
                                        @foreach (['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                            <td>
                                                <input type="number"
                                                    wire:model="performances[{{ $loop->parent->index }}]['performance']['Nb actions planifiées']['{{ $month }}']"
                                                    class="form-control rounded-pill form-control rounded-pill-lg"
                                                    value="{{ $performance['performance']['Nb actions planifiées'][$month] ?? '' }}">
                                            </td>
                                        @endforeach
                                        <td>{{ array_sum($performance['performance']['Nb actions planifiées'] ?? []) }}
                                        </td>
                                        <td>{{ $performance['note'] ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>% Mise en œuvre</td>
                                        @foreach (['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                            <td>
                                                <input type="text"
                                                    class="form-control rounded-pill form-control rounded-pill-lg"
                                                    value="{{ $performance['performance']['% Mise en œuvre'][$month] ?? '0' }}%"
                                                    readonly>
                                            </td>
                                        @endforeach
                                        <td>{{ array_sum($performance['performance']['% Mise en œuvre'] ?? []) / 12 }}
                                            %</td>
                                        <td>{{ $performance['note'] ?? 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <style>
        .inner-table input[type="number"] {
            width: 60px;
            /* Ajuster selon la taille souhaitée */
        }

        .inner-table input[type="text"] {
            width: 60px;
            /* Ajuster selon la taille souhaitée */
        }
    </style>
</div>
