import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

export function listenToTopic(topicId, onPostCreated, onPostDeleted) {
    window.Echo.channel(`topic-${topicId}`)
        .listen('PostCreated', (event) => {
            console.log('New post created:', event);
                onPostCreated(event);
        })
        .listen('PostDeleted', (event) => {
            console.log('Post deleted:', event);
            onPostDeleted(event.postId);
        });
}
