<x-app-layout>
    <div class="flex flex-col h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-gray-200 p-4 shadow">
            <h1 class="text-lg font-semibold">Chat Room: {{ $chatRoom->room_name }}</h1>
        </header>

        <!-- Chat Messages -->
        <div id="chat-container" class="flex-1 overflow-y-auto p-4 space-y-4 bg-white">
            @foreach ($messages->take(4)->reverse() as $message)
                <div class="flex {{ $message->user->id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <!-- Chat Bubble -->
                    <div
                        style="max-width: 75%; padding: 12px 16px; border-radius: 16px; color: white; font-size: 14px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); background-color: {{ $message->user->id === auth()->id() ? '#25D366' : '#34B7F1' }};">
                        <strong>{{ $message->user->id === auth()->id() ? 'You' : $message->user->name }}</strong>
                        <p class="mt-1">{{ $message->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer (Message Input) -->
        <footer class="bg-gray-200 p-4">
            <form action="{{ route('chat.storeMessage') }}" method="POST" class="flex items-center">
                @csrf
                <textarea name="content" rows="1" placeholder="Type a message..." required
                    class="flex-1 resize-none border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 px-3 py-2"></textarea>
                <button type="submit"
                    class="ml-2 px-4 py-2 bg-green-500 text-white font-semibold rounded-lg">Send</button>
            </form>
        </footer>
    </div>

    <style>
        /* Adjusting bubble sizes */
        #chat-container div {
            margin-bottom: 10px;
        }

        /* Custom scrollbar for chat container */
        #chat-container {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 transparent;
        }

        #chat-container::-webkit-scrollbar {
            width: 8px;
        }

        #chat-container::-webkit-scrollbar-thumb {
            background-color: #cbd5e0;
            border-radius: 4px;
        }

        #chat-container::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</x-app-layout>
