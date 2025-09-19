# GeTu Mentorship Platform - Implementation Plan

## Project Overview
A simple, admin-controlled mentorship matching platform that connects mentees with mentors without requiring user accounts. Everything works through secure token-based links sent via email.

## Tech Stack
- **Backend**: Laravel 12
- **Admin Panel**: Filament v4 (Latest version with enhanced features)
- **Frontend Forms**: Livewire v3 (Latest stable version)
- **Database**: MySQL/PostgreSQL
- **Email**: Laravel Mail with queues
- **Styling**: Tailwind CSS v4

## Core Principles
1. **No User Accounts**: Mentors and mentees use token-based links
2. **Admin Control**: All matching done by human admins
3. **Simple Forms**: Minimal fields, maximum usability
4. **Email-Driven**: All communication via email with secure links
5. **Existing Tools**: Mentors use their own calendar systems

## Database Schema

### Core Tables

#### 1. `mentors`
- id (bigint, primary)
- name (string)
- email (string, unique)
- phone (string, nullable)
- expertise_areas (json) - Categories and skills
- booking_calendar_link (string) - Calendly, etc.
- bio (text)
- status (enum: pending, approved, suspended)
- approved_at (timestamp, nullable)
- approved_by (bigint, nullable) - Admin who approved
- created_at, updated_at

#### 2. `mentorship_requests`
- id (bigint, primary)
- mentee_name (string)
- mentee_email (string)
- mentee_phone (string, nullable)
- help_description (text)
- preferred_expertise (json, nullable)
- status (enum: pending, matched, completed, cancelled)
- matched_mentor_id (bigint, nullable)
- matched_at (timestamp, nullable)
- matched_by (bigint, nullable) - Admin who matched
- created_at, updated_at

#### 3. `mentorship_sessions`
- id (bigint, primary)
- request_id (bigint, foreign)
- mentor_id (bigint, foreign)
- scheduled_at (timestamp, nullable)
- session_status (enum: scheduled, completed, cancelled, no_show)
- session_notes (text, nullable)
- created_at, updated_at

#### 4. `feedback`
- id (bigint, primary)
- session_id (bigint, foreign)
- feedback_type (enum: mentor, mentee)
- rating (integer, 1-5, nullable)
- comments (text, nullable)
- submitted_at (timestamp, nullable)
- created_at, updated_at

#### 5. `expertise_categories`
- id (bigint, primary)
- name (string)
- slug (string, unique)
- description (text, nullable)
- is_active (boolean, default: true)
- sort_order (integer, default: 0)
- created_at, updated_at

#### 6. `admin_users` (uses default Laravel users table)
- Already exists with Laravel installation

## Implementation Phases

### Phase 1: Foundation (Week 1)
**Goal**: Set up core infrastructure and admin access

Tasks:
1. Install and configure Filament admin panel
2. Create database migrations for all tables
3. Create Eloquent models with relationships
4. Set up model factories and seeders
5. Configure admin authentication
6. Implement Laravel signed URLs for secure links
7. Set up email templates structure

Deliverables:
- Working admin panel at /admin
- All database tables created
- Basic CRUD for admin users
- Token generation service

### Phase 2: Mentor Management (Week 1-2)
**Goal**: Allow mentors to apply and admins to manage them

Tasks:
1. Create public mentor application form (Livewire)
2. Create mentor status check page (token-based)
3. Build Filament resource for mentor management
4. Add approve/reject actions with email notifications
5. Create mentor listing and filtering in admin
6. Add bulk actions for mentor management

Deliverables:
- Public form at /mentor/apply
- Status page at /mentor/status/{token}
- Complete mentor management in admin panel
- Email notifications working

### Phase 3: Mentorship Requests (Week 2)
**Goal**: Allow mentees to request help and admins to match them

Tasks:
1. Create public mentorship request form
2. Build request status page (token-based)
3. Create Filament resource for request management
4. Build matching interface in admin panel
5. Add email notifications for matching
6. Create request analytics dashboard

Deliverables:
- Request form at /request-mentorship
- Status page at /request/status/{token}
- Matching workflow in admin
- Match notification emails

### Phase 4: Session Tracking (Week 3)
**Goal**: Track mentorship sessions and collect feedback

Tasks:
1. Auto-create sessions when matched
2. Build session management in admin
3. Create feedback forms (mentor and mentee)
4. Add reminder email system
5. Build session reporting dashboard
6. Add feedback analytics

Deliverables:
- Automatic session creation
- Feedback forms with token access
- Session reports in admin
- Analytics dashboard

### Phase 5: Polish & Launch (Week 4)
**Goal**: Refine UX and prepare for production

Tasks:
1. Improve form validation and UX
2. Add rate limiting and security measures
3. Create comprehensive email templates
4. Build analytics dashboard
5. Add data export features
6. Write user documentation

Deliverables:
- Production-ready application
- Complete email system
- Analytics and reporting
- Documentation

## File Structure
```
app/
├── Models/
│   ├── Mentor.php
│   ├── MentorshipRequest.php
│   ├── MentorshipSession.php
│   ├── Feedback.php
│   └── ExpertiseCategory.php
├── Services/
│   ├── TokenService.php
│   └── MatchingService.php
├── Mail/
│   ├── MentorApproved.php
│   ├── MentorshipMatched.php
│   └── FeedbackRequest.php
├── Livewire/
│   ├── MentorApplication.php
│   ├── MentorshipRequest.php
│   └── FeedbackForm.php
├── Filament/
│   └── Resources/
│       ├── MentorResource.php
│       ├── MentorshipRequestResource.php
│       └── MentorshipSessionResource.php
database/
├── migrations/
│   ├── create_mentors_table.php
│   ├── create_mentorship_requests_table.php
│   ├── create_mentorship_sessions_table.php
│   ├── create_feedback_table.php
│   └── create_expertise_categories_table.php
resources/
├── views/
│   ├── livewire/
│   │   ├── mentor-application.blade.php
│   │   ├── mentorship-request.blade.php
│   │   └── feedback-form.blade.php
│   ├── emails/
│   │   ├── mentor-approved.blade.php
│   │   ├── mentorship-matched.blade.php
│   │   └── feedback-request.blade.php
│   └── pages/
│       ├── mentor-status.blade.php
│       └── request-status.blade.php
```

## Security Considerations
1. All public forms use CSRF protection
2. Token-based URLs expire after 30 days
3. Rate limiting on public forms (5 requests/minute)
4. Input validation and sanitization
5. SQL injection prevention via Eloquent ORM
6. XSS protection via Blade templating

## Next Immediate Steps
1. Install Filament v4: `composer require filament/filament:"^4.0"`
2. Create database migrations
3. Set up models and relationships
4. Configure Filament admin panel
5. Create first admin user

## Success Metrics
- Time from request to match: < 24 hours
- Mentor approval rate: > 80%
- Session completion rate: > 90%
- Average feedback rating: > 4.0/5.0
- Admin time per match: < 5 minutes