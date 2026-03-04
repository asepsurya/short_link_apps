<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting... – ScrollWebLink</title>
    <!-- Meta-Refresh fallback: redirect after 12s just in case JS fails -->
    <meta http-equiv="refresh" content="12;url={{ $redirectUrl }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0B0B0E;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 1.5rem;
        }

        .container {
            max-width: 500px;
            width: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 3rem;
            color: #fff;
            text-decoration: none;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #9333ea, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .countdown-wrap {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
        }

        .countdown-svg {
            width: 120px;
            height: 120px;
            transform: rotate(-90deg);
        }

        .countdown-track {
            fill: none;
            stroke: #1f2937;
            stroke-width: 6;
        }

        .countdown-progress {
            fill: none;
            stroke: url(#grad);
            stroke-width: 6;
            stroke-linecap: round;
            stroke-dasharray: 314;
            stroke-dashoffset: 0;
            transition: stroke-dashoffset 1s linear;
        }

        .countdown-number {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 800;
            color: #fff;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #f3f4f6;
            margin-bottom: 0.5rem;
        }

        .destination {
            display: block;
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 2rem;
            word-break: break-all;
        }

        .redirect-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.75rem 1.75rem;
            border-radius: 9999px;
            background: linear-gradient(135deg, #9333ea, #4f46e5);
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: transform 0.2s, opacity 0.2s;
        }

        .redirect-btn:hover {
            transform: scale(1.04);
        }

        .skip-note {
            margin-top: 1rem;
            font-size: 0.8rem;
            color: #6b7280;
        }

    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="logo">
            <div class="logo-icon">
                <svg width="18" height="18" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
            </div>
            ScrollWeb<span style="color:#a855f7;">Link</span>
        </a>

        <div class="countdown-wrap">
            <svg class="countdown-svg" viewBox="0 0 120 120">
                <defs>
                    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#9333ea;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#4f46e5;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <circle class="countdown-track" cx="60" cy="60" r="50" />
                <circle class="countdown-progress" id="progress" cx="60" cy="60" r="50" />
            </svg>
            <div class="countdown-number" id="counter">10</div>
        </div>

        <h2>You're being redirected</h2>
        <span class="destination">{{ $redirectUrl }}</span>

        <a href="{{ $redirectUrl }}" class="redirect-btn" id="redirect-now">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
            Continue now
        </a>
        <p class="skip-note">Redirecting automatically in <span id="seconds">10</span> seconds...</p>
    </div>

    <script>
        const TOTAL = 10;
        const circumference = 2 * Math.PI * 50; // 314.16
        const progress = document.getElementById('progress');
        const counter = document.getElementById('counter');
        const secondsEl = document.getElementById('seconds');
        const redirectUrl = @json($redirectUrl);

        progress.style.strokeDasharray = circumference;
        progress.style.strokeDashoffset = 0;

        let remaining = TOTAL;

        function tick() {
            remaining--;
            const offset = circumference * (1 - remaining / TOTAL);
            progress.style.strokeDashoffset = offset;
            counter.textContent = remaining;
            secondsEl.textContent = remaining;

            if (remaining <= 0) {
                window.location.href = redirectUrl;
            } else {
                setTimeout(tick, 1000);
            }
        }

        // Start countdown after first full second
        setTimeout(tick, 1000);

    </script>
</body>
</html>
