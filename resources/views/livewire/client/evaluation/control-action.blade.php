@php
if (auth()->user()->id === $response->user_id && $response->is_send) {
    $action = 'disabled';
} elseif (auth()->user()->id === $response->responsable_n1 && $response->in_n1) {
    $action = 'disabled';
}
elseif ($response->is_n2) {
    $action = 'disabled';
} elseif (auth()->user()->id === $response->user_id && $response->my_comment) {
    $action = 'disabled';
}
@endphp
