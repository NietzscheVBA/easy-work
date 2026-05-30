@props(['initials', 'small' => false])

<div class="{{ $small ? 'w-8 h-8' : 'w-9 h-9' }} rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-700 font-semibold {{ $small ? 'text-xs' : 'text-sm' }} shadow-inner">
    {{ strtoupper($initials) }}
</div>