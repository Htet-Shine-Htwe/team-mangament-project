@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-red-600 ']) }}>
        {{ $status }}
        <a class="text-blue-900 underline" href="/register">Sign up</a>
    </div>
@endif
