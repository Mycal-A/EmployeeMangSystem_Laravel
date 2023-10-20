@props(['name', 'placeholder' => null,'type'])

<input type="{{ $type ?? 'text' }}" name="{{ ($name) }}" class="form-control" placeholder="{{ $placeholder }}" required>
