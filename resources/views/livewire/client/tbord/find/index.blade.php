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
    <h2>Tbord</h2>

    <div style="overflow-x: scroll ">
        <table class="table table-bordered outer-table">
            <thead>
                <tr>
                    <th>Objectifs</th>
                    <th>Indicateurs</th>
                    <th>Cible</th>
                    <th>Coef / 70</th>
                    <th>Performance Globale</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Développer</td>
                    <td>dddd</td>
                    <td>70</td>
                    <td>46,89</td>
                    <td colspan="14">
                        <table class="table table-bordered inner-table">
                            <thead>
                                <tr>
                                    <th>Performance Globale / 70</th>
                                    <th>janv.-23</th>
                                    <th>févr.-23</th>
                                    <th>mars-23</th>
                                    <th>avr.-23</th>
                                    <th>mai-23</th>
                                    <th>juin-23</th>
                                    <th>juil.-23</th>
                                    <th>août-23</th>
                                    <th>sept.-23</th>
                                    <th>oct.-23</th>
                                    <th>nov.-23</th>
                                    <th>déc.-23</th>
                                    <th>Année 2023</th>
                                    <th>NOTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nb actions réalisées</td>
                                    @foreach(['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                        <td>
                                            <input type="number" wire:model="actions_realisees.{{ $month }}" class="form-control" value="{{ $actions_realisees[$month] ?? '' }}">
                                        </td>
                                    @endforeach
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Nb actions réalisées dans délais</td>
                                    @foreach(['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                        <td>
                                            <input type="number" wire:model="actions_delais.{{ $month }}" class="form-control" value="{{ $actions_delais[$month] ?? '' }}">
                                        </td>
                                    @endforeach
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Nb actions planifiées</td>
                                    @foreach(['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                        <td>
                                            <input type="number" wire:model="actions_planifiees.{{ $month }}" class="form-control" value="{{ $actions_planifiees[$month] ?? '' }}">
                                        </td>
                                    @endforeach
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>% Mise en œuvre</td>
                                    @foreach(['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
                                        <td>
                                            0 %
                                        </td>
                                    @endforeach
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
