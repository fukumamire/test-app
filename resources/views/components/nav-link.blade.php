@props(['active'])

@php
$classes = ($active ?? false)
  ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-xl font-medium leading-5 text-teal-900 focus:outline-none focus:border-indigo-700  transition duration-150 ease-in-out'
  : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-xl font-medium leading-5 text-gray-500 hover:text-teal-600 hover:border-gray-300 focus:outline-none focus:text-teal-900 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>
