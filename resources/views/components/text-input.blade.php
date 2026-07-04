@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm']) }}>
