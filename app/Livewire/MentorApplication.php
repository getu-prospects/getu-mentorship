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

    public string $location = '';

    public string $profession = '';

    public array $expertise_areas = [];

    public string $booking_calendar_link = '';


    public string $additional_contribution = '';

    public bool $join_online_community = false;

    public bool $submitted = false;

    public ?string $statusCheckUrl = null;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mentors,email|max:255',
            'phone' => $this->join_online_community ? 'required|string|max:255' : 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'expertise_areas' => 'required|array|min:1',
            'expertise_areas.*' => 'exists:expertise_categories,id',
            'booking_calendar_link' => 'required|url|max:500',
            'additional_contribution' => 'nullable|string|max:1000',
            'join_online_community' => 'boolean',
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter your full name.',
        'email.required' => 'Please enter your email address.',
        'email.unique' => 'This email is already registered.',
        'phone.required' => 'Please provide your WhatsApp number to join the community.',
        'location.required' => 'Please enter your location.',
        'expertise_areas.required' => 'Please select at least one area of expertise.',
        'expertise_areas.min' => 'Please select at least one area of expertise.',
        'booking_calendar_link.required' => 'Please provide your calendar booking link.',
        'booking_calendar_link.url' => 'Please provide a valid URL for your booking calendar.',
    ];

    public function submit()
    {
        $this->validate();

        $mentor = Mentor::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->join_online_community ? $this->phone : null,
            'location' => $this->location,
            'profession' => $this->profession,
            'booking_calendar_link' => $this->booking_calendar_link,
            'bio' => null,
            'additional_contribution' => $this->additional_contribution,
            'join_online_community' => $this->join_online_community,
            'status' => 'pending',
        ]);

        $mentor->expertiseCategories()->attach($this->expertise_areas);

        $this->statusCheckUrl = URL::signedRoute('mentor.status', ['mentor' => $mentor->id]);
        $this->submitted = true;

        $this->reset(['name', 'email', 'phone', 'location', 'profession', 'expertise_areas', 'booking_calendar_link', 'additional_contribution', 'join_online_community']);
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
