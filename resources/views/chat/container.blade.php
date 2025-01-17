<x-app-layout>
    <div class="flex flex-col h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-gray-200 p-4 shadow">
            <h1 class="text-lg font-semibold">Chat Room: {{ $chatRoom->room_name }}</h1>
        </header>

        <!-- Chat Messages -->
        <div id="chat-container" class="flex-1 overflow-y-auto p-4 space-y-4 bg-white">
            @foreach ($messages->reverse() as $message)
                <div class="flex {{ $message->user->id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <!-- Chat Bubble -->
                    <div
                        style="max-width: 75%; padding: 12px 16px; border-radius: 16px; color: white; font-size: 14px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); background-color: {{ $message->user->id === auth()->id() ? '#25D366' : '#34B7F1' }};">
                        <strong>{{ $message->user->id === auth()->id() ? 'You' : $message->user->name }}</strong>
                        <p class="mt-1">{{ $message->content }}</p>
                        <span style="font-size: 12px; color: #ccc;">{{ $message->created_at }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer (Message Input) -->
        <footer class="bg-gray-200 p-4">
            <form id="message-form" action="{{ route('chat.storeMessage') }}" method="POST" class="flex items-center">
                @csrf
                <textarea id="message-input" name="content" rows="1" placeholder="Type a message..." required
                    class="flex-1 resize-none border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 px-3 py-2"></textarea>
                <button id="send-button" type="button"
                    class="ml-2 px-4 py-2 bg-green-500 text-white font-semibold rounded-lg">Send</button>
            </form>
        </footer>
    </div>

    <script>
        const chatContainer = document.getElementById('chat-container');
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');

        document.addEventListener('DOMContentLoaded', function() {
            console.log(window.Echo); // Check if Echo is available
            if (window.Echo) {
                window.Echo.channel(`chat-room.{{ $chatRoom->id }}`)
                    .listen('MessageSent', (event) => {
                        const isOwnMessage = event.user.id === {{ auth()->id() }};
                        const messageHtml = `
                        <div class="flex ${isOwnMessage ? 'justify-end' : 'justify-start'}">
                            <div style="max-width: 75%; padding: 12px 16px; border-radius: 16px; color: white; font-size: 14px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); background-color: ${isOwnMessage ? '#25D366' : '#34B7F1'};">
                                <strong>${isOwnMessage ? 'You' : event.user.name}</strong>
                                <p class="mt-1">${event.content}</p>
                                <span style="font-size: 12px; color: #ccc;">${event.created_at}</span>
                            </div>
                        </div>
                    `;
                        chatContainer.insertAdjacentHTML('beforeend', messageHtml);
                        scrollToBottom();
                    });
            } else {
                console.error("window.Echo is not defined");
            }
        });

        // Scroll to the bottom of the chat container
        const scrollToBottom = () => {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        };

        // Handle form submission with Enter key
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                messageForm.submit();
            }
        });

        // Auto-scroll on page load
        scrollToBottom();
    </script>


</x-app-layout>
