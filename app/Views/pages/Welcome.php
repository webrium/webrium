
    @section('content')
    
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            /* Subtle animated background gradient */
            background: linear-gradient(-45deg, #121212, #1e1e1e, #0a0a0a, #1a1a1a);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            text-align: center;
            padding: 3rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            width: 90%;
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        /* Logo Icon (Pure CSS) */
        .logo-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #6200ea, #00d4ff);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(98, 0, 234, 0.3);
        }

        .logo-icon span {
            font-size: 40px;
            font-weight: bold;
            color: #fff;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            background: linear-gradient(to right, #fff, #a0a0a0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .version {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            font-size: 0.8rem;
            color: #aaa;
            margin-bottom: 25px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: rgba(0, 230, 118, 0.1);
            border: 1px solid rgba(0, 230, 118, 0.2);
            border-radius: 50px;
            color: #00e676;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #00e676;
            border-radius: 50%;
            box-shadow: 0 0 10px #00e676;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
            100% { opacity: 1; transform: scale(1); }
        }

        p {
            color: #888;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .footer-link {
            display: inline-block;
            padding: 12px 30px;
            background: #fff;
            color: #121212;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            background: #e0e0e0;
            box-shadow: 0 5px 20px rgba(255, 255, 255, 0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            h1 { font-size: 2rem; }
            .container { padding: 2rem; }
        }
    </style>

    <div class="container">
        <!-- CSS Logo Icon -->
        <div class="logo-icon">
            <span>W</span>
        </div>

        <h1>Webrium Framework</h1>

        <div class="status-badge">
            <div class="status-dot"></div>
            Installation Successful
        </div>

        <p>
            Congratulations! You have successfully installed Webrium. 
            You are now ready to build amazing web applications.
        </p>

        <a href="https://github.com/webrium/webrium" class="footer-link">Get Started</a>
    </div>
@endsection