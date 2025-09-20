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
            <h1>You've Been Matched with a Mentee!</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $mentor->name }},
            </div>

            <div class="message">
                Great news! We've found a perfect match for your mentoring expertise. A young person is looking for guidance in your area of specialization, and we believe you can make a real difference in their journey.
            </div>

            <div class="message">
                <strong style="color: #1e3737; font-size: 20px; font-weight: 600;">Your Mentee: {{ $mentorshipRequest->mentee_name }}</strong>
            </div>

            <div class="message">
                Based on your expertise and availability, we've matched you with a mentee who needs guidance in areas where you excel. This is an opportunity to share your knowledge and help shape someone's future.

                <br><br><strong>Email:</strong> {{ $mentorshipRequest->mentee_email }}
                @if($mentorshipRequest->mentee_phone)
                    <br><strong>Phone:</strong> {{ $mentorshipRequest->mentee_phone }}
                @endif
                <br><strong>Request Date:</strong> {{ $mentorshipRequest->created_at->format('F j, Y') }}
            </div>

            <div class="message">
                <strong>What they're looking for help with:</strong><br>
                <em style="color: #6e7a7a;">"{{ $mentorshipRequest->help_description }}"</em>

                @if(count($requestedExpertise) > 0)
                    <br><br><strong>Requested expertise areas:</strong>
                    @foreach($requestedExpertise as $area)@if(!$loop->first), @endif{{ $area }}@endforeach
                @endif
            </div>

            @if($hasAssignmentNotes)
                <div class="message">
                    <strong>Special notes from our team:</strong><br>
                    <em style="color: #6e7a7a;">"{{ $mentorshipRequest->assignment_notes }}"</em>
                </div>
            @endif

            <div class="section">
                <div class="section-title">Next Steps</div>
                <ul>
                    <li><strong>1. {{ $hasBookingLink ? 'Monitor your calendar' : 'Watch for their message' }}:</strong>
                        @if($hasBookingLink)
                            Your mentee will book directly through your calendar system using this link: <a href="{{ $mentor->booking_calendar_link }}" target="_blank">{{ $mentor->booking_calendar_link }}</a>
                            <br><small style="color: #8b9e9e;">Calendar link: {{ $mentor->booking_calendar_link }}</small>
                        @else
                            Expect to hear from your mentee within the next few days. We've shared your contact information ({{ $mentor->email }}@if($mentor->phone), {{ $mentor->phone }}@endif) with them.
                        @endif
                    </li>
                    <li><strong>2. Prepare for your first session:</strong> Review their request and think about how you can best help them achieve their goals.</li>
                    <li><strong>3. Be welcoming and set expectations:</strong> Make them feel comfortable and discuss how often you'll meet and what success looks like.</li>
                    @if($reportUrl)
                        <li><strong>4. After your session:</strong> <a href="{{ $reportUrl }}" style="color: #07847f; text-decoration: underline;">Submit a brief report</a> to help us track program impact.
                            <br><small style="color: #8b9e9e;">Report link: {{ $reportUrl }}</small>
                        </li>
                    @endif
                </ul>

                <p style="margin-top: 20px; font-size: 14px; color: #6e7a7a;">
                    <strong>Need support?</strong> Contact us at <a href="mailto:admin@getu-prospects.de" style="color: #07847f;">admin@getu-prospects.de</a><br>
                    <small style="color: #8b9e9e;">Email: admin@getu-prospects.de</small>
                </p>
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
                <a href="https://getu-prospects.de">GeTu Prospects e.V.</a> |
                <a href="mailto:admin@getu-prospects.de">admin@getu-prospects.de</a>
            </p>
            <p style="margin-top: 20px; font-size: 12px; color: #b0b0b0;">
                This is an automated message. Please do not reply directly to this email.
            </p>
        </div>
    </div>
</body>
</html>
