<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="font-semibold text-gray-800 text-lg flex items-center gap-2">
            <i class="fas fa-comment-dots text-primary"></i> Mensagens Recentes
        </h2>
    </div>
    <div class="divide-y divide-gray-100">
        @foreach($recentMessages as $message)
        <div class="p-4 flex gap-3 hover:bg-gray-50">
            <x-ui.user-avatar :initials="$message['avatar']" :small="true" />
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <p class="font-semibold text-gray-800 text-sm">{{ $message['author'] }}</p>
                    <span class="text-xs text-gray-400">{{ $message['date'] }}</span>
                </div>
                <p class="text-gray-600 text-sm mt-0.5 line-clamp-2">{{ $message['text'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>