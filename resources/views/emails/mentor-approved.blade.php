<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GeTu Mentorship Program</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1e3737;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #edefef;
        }
        .header {
            background: linear-gradient(135deg, #1e3737 0%, #07847f 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .logo {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #1e3737;
            margin-bottom: 20px;
        }
        .message {
            color: #6e7a7a;
            margin-bottom: 25px;
        }
        .success-box {
            background-color: #8fe1de;
            border-left: 4px solid #07847f;
            padding: 20px;
            margin: 30px 0;
        }
        .success-box h2 {
            color: #1e3737;
            margin: 0 0 10px 0;
            font-size: 18px;
        }
        .section {
            margin: 30px 0;
            padding: 20px;
            background-color: #f9fafb;
            border: 1px solid #edefef;
        }
        .section-title {
            color: #1e3737;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .section-title::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 20px;
            background-color: #fe7f4c;
            margin-right: 10px;
        }
        .expertise-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .expertise-item {
            background-color: #07847f;
            color: #ffffff;
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            display: inline-block;
        }
        ul {
            color: #6e7a7a;
            padding-left: 20px;
        }
        li {
            margin: 10px 0;
        }
        .note-box {
            background-color: #fff7ed;
            border: 1px solid #fe7f4c;
            padding: 15px;
            margin: 30px 0;
            color: #6e7a7a;
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #edefef;
        }
        .footer p {
            color: #8b9e9e;
            margin: 5px 0;
            font-size: 14px;
        }
        .footer a {
            color: #07847f;
            text-decoration: none;
        }
        .divider {
            height: 1px;
            background-color: #edefef;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to the GeTu Mentorship Program!</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $mentor->name }},
            </div>

            <div class="message">
                Thank you for your willingness to make a difference in the lives of young people from refugee and migrant backgrounds. Your commitment to mentorship is truly valued.
            </div>

            <div class="success-box">
                <h2>✓ Application Approved</h2>
                <p>We are pleased to inform you that your application has been verified and approved. You are now officially part of the GeTu Mentorship Program!</p>
            </div>

            <div class="section">
                <div class="section-title">What Happens Next?</div>
                <ul>
                    <li><strong>Matching Process:</strong> Our system will match you with mentees based on your areas of expertise and calendar availability.</li>
                    <li><strong>Email Notifications:</strong> You will receive an email notification when a mentee needs help in your expertise areas.</li>
                    <li><strong>Calendar Management:</strong> Please ensure your booking calendar link remains updated for smooth scheduling.</li>
                    <li><strong>Making Connections:</strong> Once matched, you'll be able to connect with mentees and begin making a positive impact.</li>
                </ul>
            </div>

            <div class="section">
                <div class="section-title">Your Areas of Expertise</div>
                <p>You've indicated you can help mentees in the following areas:</p>
                <div class="expertise-list">
                    @foreach($expertiseAreas as $area)
                        <span class="expertise-item">{{ $area }}</span>
                    @endforeach
                </div>
            </div>

            <div class="divider"></div>

            <div class="note-box">
                <strong>Need to make changes?</strong><br>
                If you need to update your profile information, expertise areas, or calendar link, please contact our admin team at <a href="mailto:admin@getu-prospects.de">admin@getu-prospects.de</a>.
            </div>

            <div class="message">
                We're excited to have you as part of our mentorship community. Your expertise and guidance will make a real difference in helping young people navigate their educational and career paths in Germany.
            </div>

            <div class="message">
                Thank you once again for joining us in this important mission.
            </div>

            <div class="message">
                Warm regards,<br>
                <strong>The GeTu Prospects Team</strong>
            </div>
        </div>

        <div class="footer">
            <p><strong>GeTu Prospects e.V.</strong></p>
            <p>Supporting refugee and migrant youth in Germany</p>
            <p>
                <a href="https://getu-prospects.de">GeTu Prospects e.V.</a> |
                <a href="mailto:admin@getu-prospects.de">admin@getu-prospects.de</a>
            </p>
        </div>
    </div>
</body>
</html>
