<div class="p-4 border-bottom d-flex flex-row gap-1 align-items-start ">
    <div class="fw-bold " style="padding-top: 1.5px;">
        {{$loop->iteration}}.
    </div>
    <div class='col-11'>
        @include(view()->exists("survey::questions.types.{$question->type}")
        ? "survey::questions.types.{$question->type}"
        : "survey::questions.types.text",[
        'disabled' => !($eligible ?? true),
        'value' => $lastEntry ? $lastEntry->answerFor($question) : null,
        'includeResults' => ($lastEntry ?? null) !== null
        ]
        )
    </div>
</div>