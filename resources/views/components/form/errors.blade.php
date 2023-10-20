@props(['name'])

@error($name)
<p class="text-danger text-xs mt-1">{{ $message}} </p>
@enderror
