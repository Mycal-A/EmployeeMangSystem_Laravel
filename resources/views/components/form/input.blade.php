@props(['name', 'placeholder' => null,'type'])

<input type="{{ $type ?? 'text' }}" name="{{ ($name) }}" class="form-control" value="{{ old($name) }}" placeholder="{{ $placeholder }}" required>
