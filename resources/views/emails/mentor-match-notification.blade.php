<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You've Been Matched with a Mentee!</title>
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
        .mentee-card {
            background-color: #f9fafb;
            border: 1px solid #edefef;
            padding: 25px;
            margin: 30px 0;
        }
        .mentee-name {
            color: #1e3737;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .mentee-info {
            color: #6e7a7a;
            margin-bottom: 10px;
        }
        .mentee-info strong {
            color: #1e3737;
        }
        .request-section {
            background-color: #fff7ed;
            border: 2px solid #fe7f4c;
            padding: 20px;
            margin: 30px 0;
        }
        .request-section h3 {
            color: #1e3737;
            margin: 0 0 15px 0;
            font-size: 18px;
        }
        .help-description {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #fe7f4c;
            margin: 15px 0;
            font-style: italic;
            color: #6e7a7a;
        }
        .notification-section {
            background-color: #f0f9ff;
            border: 2px solid #07847f;
            padding: 20px;
            margin: 30px 0;
        }
        .notification-section h3 {
            color: #1e3737;
            margin: 0 0 15px 0;
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
        .highlight {
            background-color: #8fe1de;
            padding: 2px 6px;
            color: #1e3737;
            font-weight: 600;
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
            <h1>You've Been Matched with a Mentee!</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $mentor->name }},
            </div>

            <div class="message">
                Great news! We've found a perfect match for your mentoring expertise. A young person is looking for guidance in your area of specialization, and we believe you can make a real difference in their journey.
            </div>

            <div class="success-box">
                <h2>New Mentee Match</h2>
                <p>Based on your expertise and availability, we've matched you with a mentee who needs guidance in areas where you excel. This is an opportunity to share your knowledge and help shape someone's future.</p>
            </div>

            <div class="mentee-card">
                <div class="mentee-name">{{ $mentorshipRequest->mentee_name }}</div>
                <div class="mentee-info"><strong>Email:</strong> {{ $mentorshipRequest->mentee_email }}</div>
                @if($mentorshipRequest->mentee_phone)
                    <div class="mentee-info"><strong>Phone:</strong> {{ $mentorshipRequest->mentee_phone }}</div>
                @endif
                <div class="mentee-info"><strong>Request Date:</strong> {{ $mentorshipRequest->created_at->format('F j, Y') }}</div>
            </div>

            <div class="request-section">
                <h3>What They're Looking For</h3>
                <div class="help-description">
                    {{ $mentorshipRequest->help_description }}
                </div>

                @if(count($requestedExpertise) > 0)
                    <p><strong>Requested Areas of Expertise:</strong></p>
                    <div class="expertise-list">
                        @foreach($requestedExpertise as $area)
                            <span class="expertise-item">{{ $area }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            @if($hasBookingLink)
                <div class="notification-section">
                    <h3>What We've Sent to Your Mentee</h3>
                    <p>We've sent {{ $mentorshipRequest->mentee_name }} an email with <span class="highlight">your booking calendar link</span> so they can schedule a session directly with you.</p>

                    <p><strong>Your booking link:</strong><br>
                    <a href="{{ $mentor->booking_calendar_link }}" target="_blank">{{ $mentor->booking_calendar_link }}</a></p>

                    <p>They should be able to book a convenient time slot from your available times. You'll receive notifications through your calendar system when they book a session.</p>
                </div>
            @else
                <div class="notification-section">
                    <h3>What We've Sent to Your Mentee</h3>
                    <p>Since you don't have a booking calendar link set up, we've sent {{ $mentorshipRequest->mentee_name }} <span class="highlight">your contact information</span> and instructions to reach out to you directly.</p>

                    <p><strong>Contact details shared:</strong></p>
                    <ul>
                        <li>Email: {{ $mentor->email }}</li>
                        @if($mentor->phone)
                            <li>Phone: {{ $mentor->phone }}</li>
                        @endif
                    </ul>

                    <p>They've been instructed to introduce themselves, mention they were matched through GeTu, and propose some time slots that work for them.</p>
                </div>
            @endif

            <div class="section">
                <div class="section-title">Next Steps for You</div>
                <ul>
                    <li><strong>{{ $hasBookingLink ? 'Monitor your calendar' : 'Watch for their message' }}:</strong> {{ $hasBookingLink ? 'Your mentee will book directly through your calendar system.' : 'Expect to hear from your mentee within the next few days.' }}</li>
                    <li><strong>Prepare for your first session:</strong> Review their request and think about how you can best help them achieve their goals.</li>
                    <li><strong>Be welcoming:</strong> Remember that reaching out for mentorship takes courage. Make them feel comfortable and supported.</li>
                    <li><strong>Set expectations:</strong> Discuss how often you'll meet, communication preferences, and what success looks like.</li>
                    <li><strong>Share your experience:</strong> Your insights and journey can provide valuable perspective and inspiration.</li>
                </ul>
            </div>

            <div class="section">
                <div class="section-title">Making Your Mentorship Impactful</div>
                <ul>
                    <li><strong>Listen actively:</strong> Understand their challenges, goals, and what they hope to achieve.</li>
                    <li><strong>Ask thoughtful questions:</strong> Help them think through problems and discover solutions themselves.</li>
                    <li><strong>Share practical advice:</strong> Offer concrete steps and resources they can use.</li>
                    <li><strong>Be patient and encouraging:</strong> Growth takes time, and your support makes all the difference.</li>
                    <li><strong>Follow up:</strong> Check in on their progress and celebrate their achievements.</li>
                </ul>
            </div>

            <div class="divider"></div>

            <div class="note-box">
                <strong>Need support or have questions?</strong><br>
                If you need any assistance with your mentorship or have questions about this match, please contact us at <a href="mailto:admin@getu-prospects.de">admin@getu-prospects.de</a>. We're here to support you in making this mentorship successful.
            </div>

            <div class="message">
                Thank you for being part of the GeTu Mentorship Program. Your willingness to share your knowledge and guide others is making a real difference in helping young people build their futures in Germany.
            </div>

            <div class="message">
                We're excited to see the positive impact you'll have on {{ $mentorshipRequest->mentee_name }}'s journey!
            </div>

            <div class="message">
                With appreciation,<br>
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