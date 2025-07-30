import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'ee0474359811a43b4d47',
    cluster: 'ap2',
    forceTLS: true
});

document.addEventListener('DOMContentLoaded', function() {
    const currentUserInput = document.getElementById('currentUserId');
    if (!currentUserInput) {
        console.warn('currentUserId input not found in DOM');
        return;
    }

    const currentUserId = currentUserInput.value;
    console.log('Listening for Check-ins for User ID:', currentUserId);

    window.Echo.channel('sales-checkins')
        .listen('SalespersonCheckedIn', (e) => {
            console.log('Event Received:', e);

            if (parseInt(currentUserId) === parseInt(e.salespersonId)) {
                console.log('It\'s me! Speaking now...');
                const utterance = new SpeechSynthesisUtterance(`${e.salespersonName}, you are checked in`);
                utterance.lang = 'en-US';
                speechSynthesis.speak(utterance);
            }
        });
});
