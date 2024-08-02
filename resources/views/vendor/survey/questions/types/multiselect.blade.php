@component('survey::questions.base', compact('question'))
@foreach ($question->options as $option)
<div class="form-check">
    <input type="checkbox" name="{{ $question->key }}[]" id="{{ $question->key . '-' . Str::slug($option) }}" value="{{ $option }}" class="form-check-input" {{ ($value ?? old($question->key)) == $option ? 'checked' : '' }} {{ ($disabled ?? false) ? 'disabled' : '' }}>
    <label class="form-check-label" for="{{ $question->key . '-' . Str::slug($option) }}">{{ $option }}
    </label>
</div>
@endforeach
@endcomponent