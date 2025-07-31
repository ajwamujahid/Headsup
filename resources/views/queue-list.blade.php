<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Queues List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/svg+xml" href="https://headsup.trevinosauto.com/favicon.svg">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>

    <style>
        @font-face {
            font-family: 'Digital';
            src: url('https://fonts.cdnfonts.com/s/15077/Digital7-rg1mL.ttf') format('truetype');
        }
        html, body {
            margin: 0; padding: 0;
            font-family: 'Digital', monospace;
            color: #fff; height: 100vh;
            background: linear-gradient(270deg, #000000, #111111, #1a1a1a);
            background-size: 600% 600%;
            animation: gradientBackground 15s ease infinite;
        }
        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        #container {
            width: 90%; max-width: 1600px; margin: auto;
            padding: 1rem 0; height: 100vh;
            display: flex; gap: 1.5rem;
        }
        section {
            background-color: #0d0d0d;
            border-radius: 1.5rem;
            border: 4px solid #ccc;
            padding: 1.5rem; display: flex;
            flex-direction: column; height: 100%;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            animation: sectionGlow 3s ease-in-out infinite alternate;
        }
        @keyframes sectionGlow {
            0% { box-shadow: 0 0 10px rgba(255, 255, 255, 0.1); }
            100% { box-shadow: 0 0 20px rgba(255, 255, 255, 0.3); }
        }
        h1 {
            user-select: none;
            font-size: 3.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            background: linear-gradient(90deg, #fff, #999, #fff);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            animation: shimmerText 4s infinite linear;
        }
        @keyframes shimmerText {
            0% { background-position: -100% 0; }
            100% { background-position: 100% 0; }
        }
        .scrollable { overflow-y: auto; max-height: calc(100vh - 10rem); width: 100%; scrollbar-width: none; }
        .scrollable::-webkit-scrollbar { display: none; }
        .token-heading,
        .active-token-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
            font-weight: 700; gap: 1rem;
            text-align: center;
            margin-bottom: 1rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid #333;
        }
        .token-heading { font-size: 1.75rem; color: #ff4444; border-bottom: 2px solid #555; }
        .active-token-row div { font-size: 1.5rem; }
        .status-badge {
            background-color: #444;
            border-radius: 0.5rem;
            padding: 0.25rem 0.75rem;
            font-size: 1rem;
        }
        .checkin-row {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 1.25rem; padding: 0.5rem 0;
            border-bottom: 1px solid #444;
        }
        .checkin-name { flex: 1; padding-right: 1rem; font-size: 1.25rem; }
        .highlight-t { background-color: #4455aa !important; box-shadow: 0 0 15px rgb(107, 107, 186); }
    </style>
</head>
<body>
<audio id="dingSound" src="https://freesound.org/data/previews/341/341695_5260877-lq.mp3" preload="auto"></audio>

@php
    $highlightCustomerId = session('highlight_customer_id');
    $customers = collect($customers);
    if ($highlightCustomerId) {
        $highlighted = $customers->firstWhere('id', $highlightCustomerId);
        $customers = $customers->reject(fn($c) => $c->id == $highlightCustomerId);
        $customers = $customers->prepend($highlighted);
    }
@endphp

<div id="container">
    <section class="flex-1">
        <h1>Status</h1>
        <div class="token-heading">
            <div>Salesperson</div>
            <div>Customer</div>
            <div>Status</div>
        </div>
        <div id="tokenList" class="scrollable">
            @foreach ($customers as $c)
            <div id="queue-row-{{ $c->id }}" class="active-token-row cursor-pointer" data-customer-id="{{ $c->id }}" data-salesperson-id="{{ $c->salesperson->id ?? '' }}">

                    <div>{{ $c->salesperson->name ?? 'N/A' }}</div>
                    <div>{{ $c->name }}</div>
                    <div>
                        @php $process = is_string($c->process) ? json_decode($c->process, true) : $c->process; @endphp
                        <span class="status-badge">
                            {{ is_array($process) ? implode(', ', $process) : ($process ?? 'N/A') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="w-[25%]">
        <h1>Check-In</h1>
        <div class="token-heading" style="grid-template-columns: 1fr;">
            <div>Name &amp; Time</div>
        </div>
        <div id="checkinList" class="scrollable">
            @php
            $sortedCheckins = $checkedInSalespeople->sortBy('created_at');
        @endphp
        
        @forelse($sortedCheckins as $checkin)
            <div class="checkin-row" data-salesperson-id="{{ $checkin->salesperson->id }}">
                <div class="flex flex-col w-full overflow-hidden px-4">
                    <strong>{{ $checkin->salesperson->name ?? 'N/A' }}</strong>
                    <span class="text-xs text-muted-foreground" title="{{ $checkin->created_at->format('Y-m-d h:i A') }}">
                        {{ $checkin->created_at->format('Y-m-d h:i A') }}
                    </span>
                </div>
            </div>
        @empty
            <div class="px-4 text-sm text-gray-500">No check-ins for today.</div>
        @endforelse
        
        </div>
    </section>
</div>
<script>
  let isSpeaking = false;
  let voicesLoaded = false;
  let availableVoices = [];

  function loadVoices() {
      availableVoices = speechSynthesis.getVoices();
      if (availableVoices.length > 0) {
          voicesLoaded = true;
      } else {
          // Retry after small delay if voices aren't loaded yet
          setTimeout(loadVoices, 100);
      }
  }

  // Load voices immediately
  loadVoices();
  // Also listen for changes (some browsers delay loading)
  speechSynthesis.onvoiceschanged = loadVoices;

  function speak(text) {
      if (!voicesLoaded) { 
          setTimeout(() => speak(text), 200); // Retry if voices not ready
          return; 
      }
      if (isSpeaking) return;
      speechSynthesis.cancel();
      const utterance = new SpeechSynthesisUtterance(text);
      utterance.lang = 'en-US';
      const preferredVoice = availableVoices.find(voice => voice.name.includes('Google') || voice.lang === 'en-US');
      if (preferredVoice) utterance.voice = preferredVoice;
      utterance.onstart = () => { isSpeaking = true; };
      utterance.onend = () => { isSpeaking = false; };
      speechSynthesis.speak(utterance);
  }

  document.addEventListener('click', () => {
    if (window.audioUnlocked) return;
    const dummy = new SpeechSynthesisUtterance('');
    dummy.onend = () => {
        window.audioUnlocked = true;
        sessionStorage.removeItem('last_called_id'); // <== FORCE RESET
        setTimeout(callTopSalesperson, 500); 
    };
    speechSynthesis.speak(dummy);
}, { once: true });

function callTopSalesperson() {
    const checkinRows = document.querySelectorAll('#checkinList .checkin-row');
    if (!checkinRows.length) return;

    // Collect IDs of salespeople who already have assigned customers
    const assignedSalespersonIds = Array.from(document.querySelectorAll('#tokenList .active-token-row'))
        .map(row => row.getAttribute('data-salesperson-id'))
        .filter(Boolean);

    const availableRows = Array.from(checkinRows).filter(row => {
        const sid = row.getAttribute('data-salesperson-id');
        return !assignedSalespersonIds.includes(sid);
    });

    // Logic: if anyone available (not assigned customer yet), pick first
    // Else, fallback to first check-in again
    const nextRow = availableRows.length ? availableRows[0] : checkinRows[0];
    const salespersonId = nextRow.getAttribute('data-salesperson-id');
    const salespersonName = nextRow.querySelector('strong').innerText;

    if (sessionStorage.getItem('last_called_id') !== salespersonId) {
        sessionStorage.setItem('last_called_id', salespersonId);
        speak(`${salespersonName}, It's your turn`);
    } else {
        console.log(`Already called: ${salespersonName}`);
    }
}



  // Mutation Observer to detect when salesperson row is added
  const checkinList = document.getElementById('checkinList');
  const observer = new MutationObserver((mutationsList) => {
      for (const mutation of mutationsList) {
          if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
              callTopSalesperson();
          }
      }
  });

  observer.observe(checkinList, { childList: true });

  // On page load
  document.addEventListener('DOMContentLoaded', () => {
      callTopSalesperson();

      const data = localStorage.getItem('highlightCustomerTrigger');
      if (data) {
          const { customerId } = JSON.parse(data);
          const row = document.getElementById(`queue-row-${customerId}`);
          if (row) {
              row.scrollIntoView({ behavior: 'smooth', block: 'center' });
              row.classList.add('highlight-t');
              setTimeout(() => {
                  row.classList.remove('highlight-t');
                  localStorage.removeItem('highlightCustomerTrigger');
              }, 10000);

              // After highlighting, call next salesperson after slight delay
              setTimeout(() => {
                  sessionStorage.removeItem('last_called_id');
                  callTopSalesperson();
              }, 1500);
          }
      }
  });
</script>


</body>
</html> 