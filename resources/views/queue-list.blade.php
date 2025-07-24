<html lang="en"><head>
  <meta charset="UTF-8">
  <title>Queues List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/svg+xml" href="https://headsup.trevinosauto.com/favicon.svg">
  <style>
    @font-face {
      font-family: 'Digital';
      src: url('https://fonts.cdnfonts.com/s/15077/Digital7-rg1mL.ttf') format('truetype');
    }
    html, body {
      margin: 0;
      padding: 0;
      font-family: 'Digital', monospace;
      color: #fff;
      height: 100vh;
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
      width: 90%;
      max-width: 1600px;
      margin: auto;
      padding: 1rem 0;
      height: 100vh;
      display: flex;
      gap: 1.5rem;
    }
    section {
      background-color: #0d0d0d;
      border-radius: 1.5rem;
      border: 4px solid #ccc;
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      height: 100%;
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
    .scrollable {
      overflow-y: auto;
      max-height: calc(100vh - 10rem);
      width: 100%;
      scrollbar-width: none;
    }
    .scrollable::-webkit-scrollbar { display: none; }
    .token-heading,
    .active-token-row {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      align-items: center;
      font-weight: 700;
      gap: 1rem;
      text-align: center;
      margin-bottom: 1rem;
      padding: 0.5rem 0;
      border-bottom: 1px solid #333;
    }
    .token-heading {
      font-size: 1.75rem;
      color: #ff4444;
      border-bottom: 2px solid #555;
    }
    .active-token-row div {
      font-size: 1.5rem;
    }
    .active-token-row div:nth-child(2) {
      font-size: 1.25rem;
    }
    .status-badge {
      background-color: #444;
      border-radius: 0.5rem;
      padding: 0.25rem 0.75rem;
      display: inline-block;
      margin: 0.25rem;
      font-size: 1rem;
    }
    .checkin-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 1.25rem;
      padding: 0.5rem 0;
      border-bottom: 1px solid #444;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .checkin-name {
      flex: 1;
      overflow: hidden;
      text-overflow: ellipsis;
      padding-right: 1rem;
      font-size: 1.25rem;
    }
    .checkin-time {
      white-space: nowrap;
      font-size: 0.9rem;
    }
    .highlight-turn {
      background-color: #222d44 !important;
      font-weight: bold;
      box-shadow: 0 0 15px #44f;
    }
    
  </style>
<style>*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }/* ! tailwindcss v3.4.16 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;letter-spacing:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}button,input:where([type=button]),input:where([type=reset]),input:where([type=submit]){-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]:where(:not([hidden=until-found])){display:none}.mt-1{margin-top:0.25rem}.inline-block{display:inline-block}.flex{display:flex}.w-\[25\%\]{width:25%}.w-full{width:100%}.flex-1{flex:1 1 0%}.flex-col{flex-direction:column}.overflow-hidden{overflow:hidden}.truncate{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.whitespace-nowrap{white-space:nowrap}.px-4{padding-left:1rem;padding-right:1rem}.text-center{text-align:center}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-base{font-size:1rem;line-height:1.5rem}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}</style></head>
<body>
    <div id="container">
        {{-- <section class="flex-1">
          <!-- T/O buttons here -->
          {{-- @foreach($customers as $customer)
            <button type="button"
                    class="toBtn"
                    data-salesperson="{{ $customer->salesperson->name }}"
                    data-customer="{{ $customer->name }}"
                    data-time="{{ now()->format('h:i A') }}"
                    data-salesperson-id="{{ $customer->salesperson->id }}">
              T/O
            </button>
          @endforeach --}}
  
    
        <section class="w-[25%]">
          <div id="checkin-info" class="hidden">
            <p><strong>Salesperson:</strong> <span id="checkin-salesperson">-</span></p>
            <p><strong>Customer:</strong> <span id="checkin-customer">-</span></p>
            <p><strong>Check-in Time:</strong> <span id="checkin-time">-</span></p>
          </div>
      
          <!-- Salesperson Forms -->
          @foreach($allSalespeople as $salesperson)

            <div class="sales-form hidden" data-salesperson-id="{{ $salesperson->id }}">
              <!-- Include form here -->
            </div>
          @endforeach
        </section>
      </div>
      




      <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toBtns = document.querySelectorAll('.toBtn');
            const checkinInfo = document.getElementById('checkin-info');
        
            toBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const salesperson = this.dataset.salesperson;
                    const customer = this.dataset.customer;
                    const time = this.dataset.time;
                    const salespersonId = this.dataset.salespersonId;
        
                    // Fill right-side panel
                    document.getElementById('checkin-salesperson').textContent = salesperson;
                    document.getElementById('checkin-customer').textContent = customer;
                    document.getElementById('checkin-time').textContent = time;
                    checkinInfo.classList.remove('hidden');
        
                    // Hide all forms
                    document.querySelectorAll('.sales-form').forEach(form => form.classList.add('hidden'));
        
                    // Show current salesperson's form
                    const currentForm = document.querySelector(`.sales-form[data-salesperson-id="${salespersonId}"]`);
                    if (currentForm) currentForm.classList.remove('hidden');
                });
            });
        });
        </script>
        
    

</body>
</html>