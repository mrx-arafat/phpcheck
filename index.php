<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Environment Hub</title>
    <!-- Modern Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #0f172a;
            --container-bg: rgba(30, 41, 59, 0.7);
            --text-main: #f8fafc;
            --text-muted: #cbd5e1;
            --accent: #38bdf8;
            --border-color: rgba(255, 255, 255, 0.08);
            --table-header: rgba(15, 23, 42, 0.9);
            --table-row-even: rgba(30, 41, 59, 0.4);
            --table-row-odd: rgba(15, 23, 42, 0.4);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 40px 20px;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(99, 102, 241, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 85% 30%, rgba(56, 189, 248, 0.12) 0%, transparent 50%);
            background-attachment: fixed;
            color: var(--text-main);
            line-height: 1.6;
            min-height: 100vh;
        }

        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-section {
            text-align: center;
            margin-bottom: 50px;
            animation: fadeInDown 0.8s ease-out;
            position: relative;
        }

        .header-section::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            border-radius: 4px;
        }

        .header-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #38bdf8 0%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0 0 15px 0;
            letter-spacing: -0.03em;
            text-shadow: 0 0 30px rgba(56, 189, 248, 0.2);
        }

        .header-section p {
            color: var(--text-muted);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            font-weight: 400;
        }

        /* Glassmorphism Container for phpinfo */
        #phpinfo {
            background: var(--container-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 0 0 1px rgba(255,255,255,0.05);
            padding: 40px;
            overflow-x: auto;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        /* Essential Overrides for default phpinfo() styles */
        #phpinfo table {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 40px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        #phpinfo th, #phpinfo .h th, #phpinfo .h td {
            background: var(--table-header) !important;
            color: #fff !important;
            font-weight: 600;
            text-align: left;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 1.05rem;
            letter-spacing: 0.02em;
        }

        /* The very first table contains the PHP logo, version, etc. */
        #phpinfo > table:first-of-type {
            background: transparent !important;
            border: none;
            box-shadow: none;
            margin-bottom: 20px;
        }
        
        #phpinfo > table:first-of-type td, 
        #phpinfo > table:first-of-type th {
            background: transparent !important;
            border: none;
            padding: 10px 0;
        }
        
        #phpinfo > table:first-of-type h1 {
            font-size: 2.5rem;
            margin: 0;
            background: linear-gradient(135deg, #fff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            border: none;
            padding: 0;
        }

        #phpinfo td {
            padding: 14px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            word-break: break-all;
            vertical-align: top;
        }

        #phpinfo tr:last-child td {
            border-bottom: none;
        }

        /* Property names */
        #phpinfo .e {
            background-color: var(--table-row-odd);
            color: #e2e8f0;
            font-weight: 500;
            width: 30%;
            font-family: 'Inter', sans-serif;
            border-right: 1px solid rgba(255, 255, 255, 0.03);
        }

        /* Property values */
        #phpinfo .v {
            background-color: var(--table-row-even);
            color: #94a3b8;
        }

        /* Local vs Master values (second column of values if exists) */
        #phpinfo .v:nth-child(3) {
            border-left: 1px solid rgba(255, 255, 255, 0.03);
            background-color: rgba(30, 41, 59, 0.6);
        }

        #phpinfo .v i {
            color: #64748b;
            font-style: normal;
        }

        /* Hover effects for rows */
        #phpinfo tr:hover td.e, #phpinfo tr:hover td.v {
            background-color: rgba(56, 189, 248, 0.06);
            color: #f8fafc;
            transition: all 0.2s ease;
        }

        /* Section Headings */
        #phpinfo h2 {
            font-size: 1.8rem;
            color: #f8fafc;
            font-weight: 700;
            margin: 50px 0 20px 0;
            display: inline-block;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 8px;
            letter-spacing: -0.01em;
        }

        /* Hide unwanted default elements */
        #phpinfo hr { display: none; }
        
        #phpinfo img {
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.9);
            padding: 6px;
        }

        #phpinfo a {
            color: var(--accent);
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
        }

        #phpinfo a:hover {
            color: #93c5fd;
            text-shadow: 0 0 8px rgba(56, 189, 248, 0.4);
        }
        
        #phpinfo .center table {
            margin: 0 auto;
        }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 5px;
            border: 2px solid #0f172a;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body { padding: 20px 10px; }
            .header-section h1 { font-size: 2.2rem; }
            #phpinfo { padding: 20px; border-radius: 16px; }
            #phpinfo td, #phpinfo th { padding: 12px; }
            #phpinfo .e { width: 40%; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header-section">
            <h1>PHP Environment Hub</h1>
            <p>Advanced System Configuration & Runtime Insights</p>
        </div>
        
        <div id="phpinfo">
            <?php
            // Buffer the output of phpinfo()
            ob_start();
            phpinfo();
            $pinfo = ob_get_clean();
            
            // Extract just the body content to keep our HTML structure clean and valid
            if (preg_match('/<body>(.*?)<\/body>/is', $pinfo, $matches)) {
                $content = $matches[1];
                echo $content;
            } else {
                echo "<p style='text-align:center;'>Error parsing PHP information.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
