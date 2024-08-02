<div class="card">
    <div class="card-header p-3">
        <h4 class="mb-0">{{ $survey->name }}</h4>

        @if(!$eligible)
            {{__('We only accept')}}
            <strong>{{ $survey->limitPerParticipant() }} {{ \Str::plural('entry', $survey->limitPerParticipant()) }}</strong>
            {{__('per client')}}.
        @endif

        @if($lastEntry)
            {{__('You last submitted your answers')}} <strong>{{ $lastEntry->created_at->diffForHumans() }}</strong>.
        @endif

    </div>
    @if(!$survey->acceptsGuestEntries() && auth()->guest())
        <div class="p-5">
            {{__('Please login to join this survey')}}.
        </div>
    @else
        @foreach($survey->sections as $section)
            @include('survey::sections.single')
        @endforeach

        @foreach($survey->questions()->withoutSection()->get() as $question)
            @include('survey::questions.single', $loop)
        @endforeach

        <div class='py-3'>
            @if($eligible)
                <button class="btn btn-primary">{{__('Submit')}}</button>
            @endif
        </div>
    @endif
</div>