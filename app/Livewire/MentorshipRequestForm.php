<?php

namespace App\Livewire;

use App\Enums\MentorshipRequestStatus;
use App\Models\ExpertiseCategory;
use App\Models\MentorshipRequest;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MentorshipRequestForm extends Component
{
    #[Validate('required|string|min:2|max:255')]
    public string $mentee_name = '';

    #[Validate('required|email:rfc,dns|max:255')]
    public string $mentee_email = '';

    #[Validate('nullable|string|max:20')]
    public string $mentee_phone = '';

    #[Validate('required|string|min:50|max:2000')]
    public string $help_description = '';

    #[Validate('nullable|array|max:3')]
    public array $preferred_expertise = [];

    public bool $submitted = false;

    public Collection $expertiseCategories;

    public function mount(): void
    {
        $this->expertiseCategories = ExpertiseCategory::query()
            ->active()
            ->ordered()
            ->get(['id', 'name', 'description']);
    }

    public function submit(): void
    {
        $this->validate();

        MentorshipRequest::create([
            'mentee_name' => $this->mentee_name,
            'mentee_email' => $this->mentee_email,
            'mentee_phone' => $this->mentee_phone ?: null,
            'help_description' => $this->help_description,
            'preferred_expertise' => collect($this->preferred_expertise)->map(fn($id) => (int) $id),
            'status' => MentorshipRequestStatus::Pending,
        ]);

        $this->submitted = true;
    }

    public function resetForm(): void
    {
        $this->reset(['mentee_name', 'mentee_email', 'mentee_phone', 'help_description', 'preferred_expertise', 'submitted']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.mentorship-request-form')
            ->layout('layouts.app', ['title' => 'Request Mentorship - GeTu Prospects']);
    }
}