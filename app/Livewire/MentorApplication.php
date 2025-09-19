<?php

namespace App\Livewire;

use App\Models\ExpertiseCategory;
use App\Models\Mentor;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class MentorApplication extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public array $expertise_areas = [];

    public string $booking_calendar_link = '';

    public string $bio = '';

    public bool $submitted = false;

    public ?string $statusCheckUrl = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:mentors,email|max:255',
        'phone' => 'nullable|string|max:255',
        'expertise_areas' => 'required|array|min:1',
        'expertise_areas.*' => 'exists:expertise_categories,id',
        'booking_calendar_link' => 'required|url|max:500',
        'bio' => 'required|string|max:2000',
    ];

    protected $messages = [
        'name.required' => 'Please enter your full name.',
        'email.required' => 'Please enter your email address.',
        'email.unique' => 'This email is already registered.',
        'expertise_areas.required' => 'Please select at least one area of expertise.',
        'expertise_areas.min' => 'Please select at least one area of expertise.',
        'booking_calendar_link.required' => 'Please provide your calendar booking link.',
        'booking_calendar_link.url' => 'Please provide a valid URL for your booking calendar.',
        'bio.required' => 'Please tell us about yourself.',
    ];

    public function submit()
    {
        $this->validate();

        $mentor = Mentor::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'booking_calendar_link' => $this->booking_calendar_link,
            'bio' => $this->bio,
            'status' => 'pending',
        ]);

        $mentor->expertiseCategories()->attach($this->expertise_areas);

        $this->statusCheckUrl = URL::signedRoute('mentor.status', ['mentor' => $mentor->id]);
        $this->submitted = true;

        $this->reset(['name', 'email', 'phone', 'expertise_areas', 'booking_calendar_link', 'bio']);
    }

    public function render()
    {
        return view('livewire.mentor-application', [
            'expertiseCategories' => ExpertiseCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get(),
        ])->layout('layouts.app', ['title' => 'Become a Mentor - GeTu Mentorship']);
    }
}
