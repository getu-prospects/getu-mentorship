<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You've Been Matched with a Mentor!</title>
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
        .mentor-card {
            background-color: #f9fafb;
            border: 1px solid #edefef;
            padding: 25px;
            margin: 30px 0;
        }
        .mentor-name {
            color: #1e3737;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .mentor-info {
            color: #6e7a7a;
            margin-bottom: 10px;
        }
        .mentor-info strong {
            color: #1e3737;
        }
        .booking-section {
            background-color: #fff7ed;
            border: 2px solid #fe7f4c;
            padding: 20px;
            margin: 30px 0;
            text-align: center;
        }
        .booking-section h3 {
            color: #1e3737;
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        .booking-link {
            display: inline-block;
            background-color: #fe7f4c;
            color: #ffffff;
            padding: 12px 24px;
            text-decoration: none;
            font-weight: 600;
            margin: 15px 0;
        }
        .booking-link:hover {
            background-color: #e06838;
        }
        .contact-section {
            background-color: #f0f9ff;
            border: 2px solid #07847f;
            padding: 20px;
            margin: 30px 0;
        }
        .contact-section h3 {
            color: #1e3737;
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        .contact-info {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #8fe1de;
            margin: 15px 0;
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
            <svg class="logo" viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg">
                <rect width="200" height="80" fill="#ffffff"/>
                <text x="100" y="50" font-family="Arial, sans-serif" font-size="36" font-weight="bold" text-anchor="middle" fill="#1e3737">GeTu</text>
            </svg>
            <h1>Great News! You've Been Matched!</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $mentorshipRequest->mentee_name }},
            </div>

            <div class="message">
                We're excited to inform you that we've found a mentor who can help you with your request. Your journey toward achieving your goals is about to begin!
            </div>

            <div class="success-box">
                <h2>Mentor Match Found</h2>
                <p>Based on your needs and preferences, we've carefully matched you with an experienced mentor who specializes in the areas where you're seeking guidance.</p>
            </div>

            <div class="mentor-card">
                <div class="mentor-name">{{ $mentor->name }}</div>
                @if($mentor->profession)
                    <div class="mentor-info"><strong>Profession:</strong> {{ $mentor->profession }}</div>
                @endif
                @if($mentor->location)
                    <div class="mentor-info"><strong>Location:</strong> {{ $mentor->location }}</div>
                @endif

                @if(count($expertiseAreas) > 0)
                    <div class="section-title" style="margin-top: 20px;">Areas of Expertise</div>
                    <div class="expertise-list">
                        @foreach($expertiseAreas as $area)
                            <span class="expertise-item">{{ $area }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            @if($hasBookingLink)
                <div class="booking-section">
                    <h3>Schedule Your Session</h3>
                    <p>Your mentor has provided a convenient booking calendar. Simply click the link below to choose a time that works best for you:</p>
                    <a href="{{ $mentor->booking_calendar_link }}" class="booking-link" target="_blank">
                        Book Your Mentorship Session
                    </a>
                    <p><small>You'll be redirected to your mentor's calendar where you can select an available time slot.</small></p>
                </div>
            @else
                <div class="contact-section">
                    <h3>Connect with Your Mentor</h3>
                    <p>Please reach out to your mentor directly to schedule your first session:</p>

                    <div class="contact-info">
                        <div class="mentor-info"><strong>Email:</strong> {{ $mentor->email }}</div>
                        @if($mentor->phone)
                            <div class="mentor-info"><strong>Phone:</strong> {{ $mentor->phone }}</div>
                        @endif
                    </div>

                    <p><strong>When contacting your mentor:</strong></p>
                    <ul style="text-align: left; margin: 15px 0;">
                        <li>Introduce yourself and mention you were matched through GeTu</li>
                        <li>Share what you're hoping to achieve in your sessions</li>
                        <li>Propose a few time slots that work for your schedule</li>
                        <li>Ask about their preferred communication method (email, phone, video call)</li>
                    </ul>
                </div>
            @endif

            <div class="section">
                <div class="section-title">Your Original Request</div>
                <p><strong>What you're looking for help with:</strong></p>
                <p style="font-style: italic; color: #6e7a7a;">{{ $mentorshipRequest->help_description }}</p>
            </div>

            <div class="section">
                <div class="section-title">Making the Most of Your Mentorship</div>
                <ul>
                    <li><strong>Come prepared:</strong> Think about specific questions or challenges you'd like to discuss.</li>
                    <li><strong>Be open:</strong> Share your goals, concerns, and what success looks like to you.</li>
                    <li><strong>Take notes:</strong> Keep track of advice and action items from your sessions.</li>
                    <li><strong>Follow up:</strong> Implement suggestions and update your mentor on your progress.</li>
                    <li><strong>Be respectful:</strong> Honor scheduled times and give advance notice if you need to reschedule.</li>
                </ul>
            </div>

            <div class="divider"></div>

            <div class="note-box">
                <strong>Need support?</strong><br>
                If you have any questions about your match or encounter any issues, please don't hesitate to contact us at <a href="mailto:admin@getu-prospects.de">admin@getu-prospects.de</a>.
            </div>

            <div class="message">
                We're thrilled to see you taking this important step in your personal and professional development. Your mentor is excited to work with you and help you succeed.
            </div>

            <div class="message">
                Best of luck with your mentorship journey!
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
                <a href="https://www.getu-prospects.de">www.getu-prospects.de</a> |
                <a href="mailto:admin@getu-prospects.de">admin@getu-prospects.de</a>
            </p>
            <p style="margin-top: 20px; font-size: 12px; color: #b0b0b0;">
                This is an automated message. Please do not reply directly to this email.
            </p>
        </div>
    </div>
</body>
</html>