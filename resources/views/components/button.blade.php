@props(['class' => 'outline-success', 'type' => 'submit', 'id' => ''])

<button type="{{ $type }}" class="col-4 btn btn-{{ $class }}" id="{{ $id }}">{{ $slot }}</button>