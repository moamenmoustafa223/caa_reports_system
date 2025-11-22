<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline - CAA Reporting System</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #262761 0%, #3a3b8a 100%);
            color: white;
        }
        .offline-container {
            text-align: center;
            padding: 40px;
        }
        .offline-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 16px;
        }
        p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 24px;
        }
        .retry-btn {
            padding: 12px 24px;
            background: white;
            color: #262761;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .retry-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div class="offline-container">
        <div class="offline-icon">📡</div>
        <h1>You're Offline</h1>
        <p>Please check your internet connection and try again.</p>
        <button class="retry-btn" onclick="window.location.reload()">
            Retry Connection
        </button>
    </div>
</body>
</html>
