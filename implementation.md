# Mentorship Booking Platform - Technical Implementation Plan

## Current Status: Phase 1 ✅ Complete | Phase 2 🚧 Ready to Start

## Overview
A simple, admin-controlled mentorship matching platform using Laravel 12 & Filament v4. The system operates without user accounts for mentors/mentees, using secure token-based links for all interactions.

### ✅ What's Been Implemented (Phase 1 - Foundation)
- **Database**: All 6 core models with migrations, relationships, and factories
- **Models**: Mentor, MentorshipRequest, MentorshipSession, MentorReport, MenteeFeedback, ExpertiseCategory
- **Infrastructure**: TokenService, ValidateToken middleware, rate limiting (5/min), BasePublicFormController
- **Admin**: Filament panel configured with GeTu branding, 2 admin users seeded
- **Testing**: Model tests passing, factories working
- **Changes from Original Plan**:
  - Removed `bio` field from Mentor model
  - Removed `application_token` from Mentor (no status tracking needed)
  - Added `phone` field to both Mentor and MentorshipRequest models
  - Made ExpertiseCategory required (not optional) for better matching

## Core Architecture Principles
- **No user accounts** for mentors/mentees (only admins have accounts)
- **Token-based access** via email links for all participant actions
- **Admin-controlled matching** - humans review and match all requests
- **Integration-friendly** - works with existing calendar tools
- **Simple forms** for data collection
- **Email-driven workflow** for all notifications

## Database Models & Structure

### Stage 1: Core Models

#### 1. Mentor Model ✅
```
- id
- name (string)
- email (string, unique)
- phone (string, nullable)
- expertise_areas (json) // Structure: {"category_ids": [1,2,3], "other": "Custom expertise"}
- booking_calendar_link (string) // Calendly, Google Calendar, etc.
- status (enum: pending, approved, suspended, inactive)
- approved_at (datetime, nullable) // Track when approved
- created_at, updated_at
```
**Note:** Removed bio and application_token fields per requirements

#### 2. MentorshipRequest Model ✅
```
- id
- name (string)
- email (string)
- phone (string, nullable) // Added for mentee contact
- description (text) // What they need help with
- expertise_needed (json, nullable) // Structure: {"category_ids": [1,2], "other": "Custom need"}
- status (enum: pending, matched, completed, cancelled)
- matched_mentor_id (foreign key, nullable)
- matched_at (datetime, nullable)
- matched_by_user_id (foreign key, nullable) // Admin who matched
- request_token (string, unique, 64 chars) // For secure link access
- created_at, updated_at
```

#### 3. MentorshipSession Model ✅
```
- id
- mentorship_request_id (foreign key)
- mentor_id (foreign key)
- scheduled_at (datetime, nullable)
- session_status (enum: scheduled, completed, cancelled, no_show)
- session_token (string, unique, 64 chars) // For feedback links
- feedback_requested_at (datetime, nullable) // Track when feedback email sent
- created_at, updated_at
```

### Stage 2: Feedback & Reporting Models

#### 4. MentorReport Model ✅
```
- id
- mentorship_session_id (foreign key)
- topics_covered (text)
- recommendations (text, nullable)
- session_duration_minutes (integer, nullable)
- report_token (string, unique, 64 chars)
- submitted_at (datetime)
- created_at, updated_at
```

#### 5. MenteeFeedback Model ✅
```
- id
- mentorship_session_id (foreign key)
- rating (integer, 1-5)
- feedback_text (text, nullable)
- would_recommend (boolean)
- feedback_token (string, unique, 64 chars)
- submitted_at (datetime)
- created_at, updated_at
```
**Note:** Table name is 'mentee_feedback' (singular)

### Stage 3: Supporting Models

#### 6. ExpertiseCategory Model ✅ (Required for matching)
```
- id
- name (string) // e.g., "Language & Communication"
- slug (string, unique) // e.g., "language-communication"
- name_de (string) // German translation: "Sprache & Kommunikation"
- description (text, nullable)
- is_active (boolean, default true)
- sort_order (integer, default 0) // For controlling display order
- created_at, updated_at
```

**Seeded Categories:**
1. Orientation & Everyday Life in Germany
2. Language & Communication
3. Education & Work
4. Administrative Procedures & Rights
5. Housing & Mobility
6. Social Integration & Network
7. Healthcare
8. Instrument

**Note:** Email tracking handled through model timestamps and Laravel's built-in mail logging.

## Implementation Stages

### Stage 1: Foundation (Week 1)
1. **Database Setup**
   - Create all migrations for core models
   - Set up model relationships and scopes
   - Create factories for testing

2. **Admin Authentication & Filament Setup**
   - Configure Filament admin panel access
   - Set up admin user seeder
   - Customize panel colors and branding
   - Configure error notifications

3. **Public Forms Infrastructure**
   - Create base controller for public token-validated forms
   - Build token generation trait/service
   - Set up rate limiting middleware
   - Create base layouts for public pages

### Stage 2: Mentor Management (Week 1-2)

#### Public Mentor Application
1. **Application Form (using Livewire component)**
   - Multi-step wizard using Filament's Wizard component
   - Step 1: Basic info (name, email, phone)
   - Step 2: Expertise selection with tags input
   - Step 3: Bio and calendar link
   - Real-time validation with `wire:model.live`
   - Success page with application number
   - **Security:** Livewire handles CSRF automatically

2. **Token-Based Status Page**
   - Clean status display using Filament's Infolist components
   - Show application status with colored badges
   - Display submitted information in read-only format

#### Admin Mentor Management (Filament)
1. **MentorResource**
   - Table with custom layout using Grid for better column control
   - Filters: status (SelectFilter), expertise (custom filter)
   - Bulk actions: approve multiple, suspend multiple
   - Row actions: view, edit, approve (with modal confirmation)
   - Header actions: export to CSV

2. **Mentor View Page**
   - Infolist with sections for contact info, expertise, bio
   - Stats widget showing total sessions, average rating
   - Related sessions table

3. **Notifications**
   - Use Filament's notification system for admin actions
   - Queue email jobs for mentor communications

### Stage 3: Mentee Request Flow (Week 2)

#### Public Request Submission
1. **Simple Request Form**
   - Single-page form with 3 fields (name, email, description)
   - Description field with helpful placeholder text
   - Client-side validation using Alpine.js
   - Loading states with `wire:loading`
   - Honeypot fields for bot prevention
   - Rate limiting (5 requests per minute per IP)
   - **Security:** CSRF handled automatically by Livewire/Laravel

2. **Request Status Page**
   - Clean layout showing request status
   - Display submitted description
   - If matched: display mentor info and booking link prominently
   - Call-to-action button for booking

#### Admin Request Management
1. **MentorshipRequestResource**
   - Table with status badges and date formatting
   - Description preview in table with truncation
   - Quick view using modal with Infolist
   - Custom matching action with mentor selection
   - Filters: status, date range, keyword search in description

2. **Matching Interface**
   - Modal form with searchable Select for mentor
   - Display full description for context
   - Show mentor availability and expertise match
   - Preview of notification email before sending
   - Confirmation with notification on success

### Stage 4: Session Tracking (Week 3)

#### Session Management
1. **MentorshipSessionResource**
   - Automatic creation upon matching
   - Table with status indicators
   - Timeline view of session history
   - Related reports and feedback

2. **Dashboard Widgets**
   - Stats Overview widget (using Filament v4's built-in stats)
     - Sessions this month
     - Average rating
     - Completion rate
   - Chart widget for sessions over time
   - Table widget for recent sessions

3. **Automated Workflows**
   - Laravel scheduled commands for reminders
   - Queue jobs for post-session emails
   - Track email sending via model timestamps (feedback_requested_at)
   - Automatic status updates based on dates

### Stage 5: Feedback Collection (Week 3-4)

#### Public Feedback Forms
1. **Mentor Report Form**
   - Token validation middleware (secure access via URL token)
   - Rich text editor for recommendations
   - Duration slider with non-linear scale
   - Topics covered as tags input
   - **Security:** Token in URL provides authentication, CSRF automatic

2. **Mentee Feedback Form**
   - Token validation middleware
   - Star rating component
   - Optional feedback textarea
   - Yes/no toggle for recommendation
   - Thank you page with next steps
   - **Security:** Token in URL provides authentication, CSRF automatic

#### Admin Reporting
1. **Report Views**
   - Combined view of mentor report and mentee feedback
   - Infolist layout with side-by-side comparison
   - Export individual session reports as PDF

2. **Analytics Dashboard**
   - Custom dashboard page with multiple widgets
   - Topic demand chart (bar/pie chart)
   - Mentor performance table with sortable metrics
   - Time-based filters for all widgets

### Stage 6: Polish & Optimization (Week 4)

#### User Experience Enhancements
1. **Email Templates**
   - Responsive HTML templates using Laravel mail components
   - Consistent branding with logo and colors
   - Clear CTAs with styled buttons
   - Plain text alternatives
   - Track sending via model timestamps instead of separate log

2. **Public Form Improvements**
   - Progress indicators for multi-step forms
   - Auto-save draft functionality
   - Mobile-optimized layouts
   - Accessibility improvements (ARIA labels, keyboard nav)

3. **Admin UI Enhancements**
   - Custom theme with organization colors
   - Keyboard shortcuts for common actions
   - Bulk operations with progress indicators
   - Advanced search with saved filters

## Security Implementation

### Form Security (Simplified)
1. **CSRF Protection**
   - Automatically handled by Laravel for standard forms
   - Automatically handled by Livewire for Livewire components
   - No additional configuration needed

2. **Token Management**
   - 32-character random tokens for URL-based access
   - Hashed storage in database
   - Expiration after 30 days
   - One-time use for sensitive actions
   - Tokens provide authentication for feedback forms

3. **Rate Limiting**
   - 5 requests per minute for public forms
   - IP-based tracking using Laravel's RateLimiter
   - Honeypot fields for bot prevention
   - Consider CAPTCHA only if spam becomes an issue

4. **Validation & Sanitization**
   - Form Request classes for all inputs
   - HTML purification for rich text inputs
   - Email validation with DNS check
   - Input length limits

## Email Tracking Strategy (Simplified)

Instead of a separate EmailLog model, track emails through:

1. **Model Timestamps**
   - `mentor.approved_at` - When approval email sent
   - `mentorship_request.matched_at` - When match email sent
   - `mentorship_session.feedback_requested_at` - When feedback email sent

2. **Laravel Mail Events**
   - Use Laravel's mail events for debugging if needed
   - Log to `mail` channel in development
   - Use queue failed_jobs table for retry logic

3. **Queue Jobs**
   - Each email type has its own job class
   - Failed jobs tracked in failed_jobs table
   - Retry logic built into queue system

## Testing Strategy

### Feature Tests
```php
// Mentor application flow (CSRF handled automatically)
test('mentor can submit application', function () {
    livewire(MentorApplicationForm::class)
        ->fillForm([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'expertise_areas' => ['Laravel', 'Vue.js'],
        ])
        ->call('submit')
        ->assertRedirect('/mentor/application-success');

    // Verify email was queued
    Mail::assertQueued(MentorApplicationReceived::class);
});

// Token-based feedback form
test('mentee can submit feedback with valid token', function () {
    $session = MentorshipSession::factory()->create();

    $response = $this->post("/session/{$session->session_token}/feedback", [
        'rating' => 5,
        'feedback_text' => 'Great session!',
        'would_recommend' => true,
    ]);

    $response->assertRedirect('/feedback/thank-you');
});

// Invalid token rejection
test('feedback form rejects invalid token', function () {
    $response = $this->get('/session/invalid-token/feedback');

    $response->assertStatus(404);
});
```

### Security Tests
```php
// Rate limiting test
test('public forms are rate limited', function () {
    for ($i = 0; $i < 6; $i++) {
        $response = $this->post('/request', [
            'name' => "Test $i",
            'email' => "test$i@example.com",
            'description' => 'Help needed',
        ]);
    }

    // 6th request should be rate limited
    $response->assertStatus(429);
});

// Honeypot test
test('honeypot field blocks submission', function () {
    $response = $this->post('/request', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'description' => 'Help needed',
        'website' => 'spam-site.com', // honeypot field
    ]);

    $response->assertStatus(422);
});
```

## File Structure
```
app/
├── Filament/
│   ├── Resources/
│   │   ├── MentorResource.php
│   │   ├── MentorshipRequestResource.php
│   │   └── MentorshipSessionResource.php
│   ├── Widgets/
│   │   ├── StatsOverview.php
│   │   ├── RecentSessions.php
│   │   └── TopicDemandChart.php
│   └── Pages/
│       └── Reports.php
├── Http/
│   ├── Controllers/
│   │   ├── MentorApplicationController.php
│   │   ├── MentorshipRequestController.php
│   │   └── FeedbackController.php
│   ├── Livewire/
│   │   ├── MentorApplicationForm.php
│   │   └── MentorshipRequestForm.php
│   └── Middleware/
│       └── ValidateToken.php
├── Models/
│   ├── Mentor.php
│   ├── MentorshipRequest.php
│   ├── MentorshipSession.php
│   ├── MentorReport.php
│   └── MenteeFeedback.php
├── Mail/
│   ├── MentorApproved.php
│   ├── MentorshipMatched.php
│   └── FeedbackRequest.php
└── Services/
    └── TokenService.php
```

## Implementation Progress Tracker

### Phase 1: Foundation ✅ COMPLETED (2025-09-16)
- [x] Database migrations for all 6 models
- [x] Model files with relationships and HasFactory trait
- [x] Model factories with realistic test data
- [x] Admin authentication (admin@getu-prospects.org, support@getu-prospects.org)
- [x] Filament panel configuration with GeTu branding (Emerald theme)
- [x] TokenService for secure token generation
- [x] ValidateToken middleware for token-based authentication
- [x] Rate limiting configuration (5 requests/minute for public forms)
- [x] BasePublicFormController for public form infrastructure
- [x] ExpertiseCategorySeeder with 8 default categories
- [x] AdminSeeder with default admin users
- [x] Tests for models and relationships

### Phase 2: Mentor Management 🚧 IN PROGRESS
- [ ] MentorResource (Filament) for admin management
- [ ] Public mentor application form (Livewire component)
- [ ] Email notifications for mentor approval
- [ ] Mentor listing page for admins
- [ ] Bulk approval actions

### Phase 3: Mentee Request Flow
- [ ] MentorshipRequestResource (Filament)
- [ ] Public mentorship request form
- [ ] Admin matching interface
- [ ] Match notification emails
- [ ] Request status page (token-based)

### Phase 4: Session Tracking
- [ ] MentorshipSessionResource (Filament)
- [ ] Dashboard widgets (stats, charts, recent sessions)
- [ ] Automated reminder system
- [ ] Session timeline view

### Phase 5: Feedback Collection
- [ ] Public mentor report form (token-based)
- [ ] Public mentee feedback form (token-based)
- [ ] Combined report/feedback view for admins
- [ ] Analytics dashboard with metrics

### Stage 6: Polish & Optimization
- [ ] Email templates
- [ ] Form improvements
- [ ] Admin UI enhancements
- [ ] Testing suite

## Next Immediate Steps
1. ✅ Create implementation.md with this detailed plan
2. Begin Stage 1: Foundation implementation
3. Create comprehensive seeders for testing
4. Set up CI/CD pipeline with tests

This implementation leverages Filament v4's powerful features while maintaining simplicity and focusing on the core mentorship matching functionality.