<div>
    @include('livewire.client.dashboard.partials.client-feedback-modal')
    <div class='container pt-3 pt-lg-4 pb-7 pb-lg-9 text-white'>
        <div class='d-flex flex-wrap-reverse align-items-top  justify-content-md-between '>
            <div class='d-flex flex-wrap align-items-center gap-3'>
                <div class='d-none d-md-block d-lg-block'>
                    <div
                        class="avatar-xl d-flex align-items-center justify-content-center fw-bold rounded border-warn  mr-5">
                        <span class="p-2 display-2 text-success">{{ auth()->user()->initials }}</span>
                    </div>
                </div>
                <div class=''>
                    <div class='fw-bold display-4 text-gray-600'>{{ __('Hi') }}, {{ auth()->user()->first_name }}
                    </div>
                    <div class='d-flex align-items-center justify-content-start '>
                        <div class='leading text-gray-400 '>{{ auth()->user()->occupation }} |
                            {{ auth()->user()->enterprise->name }}</div>
                    </div>
                    <div class='mt-4 d-flex flex-wrap align-items-center gap-2'>
                        @if (auth()->user()->evaluations)
                            <a href="{{ route('client.evaluations.index') }}" wire:navigate
                                class="btn btn-success mr-lg-2 ">
                                <svg class="icon icon-sm me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" strokelinejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                                {{ __('Evaluations') }}
                            </a>
                        @else
                            <a href="{{ route('client.evaluations.index') }}" wire:navigate
                                class="btn btn-success mr-lg-2 ">
                                <svg class="icon icon-sm me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" strokelinejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                                {{ __('Evaluations') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <x-navigation.client-nav />
            </div>
        </div>

        <div class='my-5'>
            <div class=''>
                <x-alert />
                @include('flash::message')
            </div>
        </div>

        @if ($evaluation)
            <div class="row mb-5 border-bottom border-secondary pb-5 shadow py-2">
                <div class="col-md-5">
                    <a href="#
                    {{-- {{ route('client.evaluation.details', $event->id) }} --}}
                     " class="text-decoration-none">
                        <img class="img-fluid rounded img-star" src="{{ asset('img/evaluation.jpg') }}"
                            alt="{{ $evaluation->title }}">
                    </a>
                </div>
                <div class="col-md-7">
                    <h3 class="mb-2" style="color: black"> {{ $evaluation->title }} </h3>
                    <p class="card-text my-2"> {!! Str::limit($evaluation->description, 520) !!} </p>
                    <span class="" style="color: black"> {{ \Carbon\Carbon::parse($evaluation->start_date)->format('d/m/Y') }}
                    </span>

                    <div id="countdown" class="d-flex justify-content-start mt-3">
                        <div class="countdown-block me-2">
                            <span id="days" class="countdown-time"></span>
                            <div class="countdown-label">Days</div>
                        </div>
                        <div class="countdown-block me-2">
                            <span id="hours" class="countdown-time"></span>
                            <div class="countdown-label">Hours</div>
                        </div>
                        <div class="countdown-block me-2">
                            <span id="minutes" class="countdown-time"></span>
                            <div class="countdown-label">Minutes</div>
                        </div>
                        <div class="countdown-block me-2">
                            <span id="seconds" class="countdown-time"></span>
                            <div class="countdown-label">Seconds</div>
                        </div>
                    </div>

                </div>
            </div>
        @endif

        <div class='mt-5'>
            <div class='d-flex justify-content-between align-items-end mx-2'>
                <h5 class="h5 text-gray-600">{{ __('Lastest Audit logs') }}</h5>
                <div>
                    <a href='{{ route('client.auditlogs') }}' wire:navigate
                        class='btn btn-success'>{{ __('View all') }}</a>
                </div>
            </div>
            <div class="card mt-2">
                <div class="table-responsive text-gray-700">
                    <table class="table client-table table-hover align-items-center ">
                        <thead>
                            <tr>
                                <!-- <th class="border-bottom">{{ __('client') }}</th> -->
                                <th class="border-bottom">{{ __('Action Type') }}</th>
                                <th class="border-bottom">{{ __('Action Performed') }}</th>
                                <th class="border-bottom">{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <!-- <td>
                                    <a href="#" class="d-flex align-items-center">
                                        <div class="avatar d-flex align-items-center justify-content-center fw-bold rounded bg-success me-3"><span class="text-white">{{ initials($log->user) }}</span></div>
                                        <div class="d-block"><span class="fw-bold">{{ $log->user }}</span>
                                            <div class="small text-gray">{{ $log->user }}</div>
                                        </div>
                                    </a>
                                </td> -->
                                    <td>
                                        <span
                                            class="fw-normal badge super-badge badge-lg bg-{{ $log->style }} rounded">{{ $log->action_type }}</span>
                                    </td>
                                    <td>
                                        <span class="fs-normal">{!! $log->action_perform !!}</span>
                                    </td>
                                    <td>
                                        <span class="fw-normal">{{ $log->created_at }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="text-center text-gray-800 mt-2">
                                            <h4 class="fs-4 fw-bold">{{ __('Opps nothing here') }} &#128540;</h4>
                                            <p>{{ __('No Record Found..!') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @if (request()->is('my/dashboard'))
        <style>
            .event-card {
                border: none;
                border-radius: 8px;
                overflow: hidden;
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .event-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

            .event-card .card-img-top {
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
                transition: transform 0.3s;
                height: 15em;
            }

            .img-star {
                width: 100%;
                height: 21em;
            }

            .event-card:hover .card-img-top {
                transform: scale(1.1);
            }

            .card-title {
                font-size: 1.25rem;
                font-weight: 600;
            }

            .card-subtitle {
                font-size: 1rem;
                color: #6c757d;
            }

            .card-text {
                font-size: 0.875rem;
                color: #6c757d;
            }

            .shadow-sm {
                box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
            }

            .text-decoration-none {
                text-decoration: none;
            }

            .countdown-block {
                text-align: center;
                padding: 15px;
                border: 2px solid #007bff;
                border-radius: 8px;
                min-width: 50px;
                background-color: #f8f9fa;
                box-shadow: 0 0 15px rgba(0, 123, 255, 0.3);
                transition: all 0.3s ease;
            }

            .countdown-time {
                font-size: 32px;
                font-weight: bold;
                color: #007bff;
                display: block;
                margin-bottom: 5px;
            }

            .countdown-label {
                font-size: 14px;
                color: #007bff;
            }

            .countdown-block:hover {
                transform: scale(1.05);
                box-shadow: 0 0 20px rgba(0, 123, 255, 0.5);
            }
        </style>


        <script>
            // Set the date we're counting down to
            var countDownDate = new Date("{{ \Carbon\Carbon::parse($evaluation->end_date)->format('Y-m-d H:i:s') }}").getTime();

            // alert(countDownDate)

            // Update the count down every 1 second
            var countdownFunction = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the elements with corresponding IDs
                document.getElementById("days").innerHTML = days;
                document.getElementById("hours").innerHTML = hours;
                document.getElementById("minutes").innerHTML = minutes;
                document.getElementById("seconds").innerHTML = seconds;

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(countdownFunction);
                    document.getElementById("countdown").innerHTML = "L'événement a commencé!";
                }
            }, 1000);
        </script>

        <script>
            document.addEventListener('livewire:load', function() {
                var searchInput = document.getElementById('searchInput');

                searchInput.addEventListener('input', function() {
                    Livewire.emit('searchUpdated', searchInput.value);
                });
            });
        </script>
    @endif

</div>

