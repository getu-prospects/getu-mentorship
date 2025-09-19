<?php

namespace Database\Seeders;

use App\Enums\MentorshipRequestStatus;
use App\Models\ExpertiseCategory;
use App\Models\Mentor;
use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class MentorshipRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expertiseCategories = ExpertiseCategory::all();
        $approvedMentors = Mentor::where('status', 'approved')->get();
        $adminUser = User::first();

        $requests = [
            [
                'mentee_name' => 'Sarah Johnson',
                'mentee_email' => 'sarah.johnson@example.com',
                'mentee_phone' => '+49 171 2345678',
                'help_description' => 'I am preparing for my university application to study Computer Science in Germany. I need guidance on choosing the right programs, preparing my application documents, and understanding the admission process.',
                'status' => MentorshipRequestStatus::Pending,
                'expertise_ids' => ['university-application', 'computer-science'],
            ],
            [
                'mentee_name' => 'Ahmed Hassan',
                'mentee_email' => 'ahmed.hassan@example.com',
                'mentee_phone' => '+49 152 9876543',
                'help_description' => 'Recently graduated with a degree in Mechanical Engineering. Looking for guidance on job search strategies, CV optimization, and interview preparation for engineering positions in German companies.',
                'status' => MentorshipRequestStatus::Matched,
                'expertise_ids' => ['career-guidance', 'engineering'],
            ],
            [
                'mentee_name' => 'Maria Garcia',
                'mentee_email' => 'maria.garcia@example.com',
                'mentee_phone' => '+49 176 3456789',
                'help_description' => 'I want to start my own business in the sustainable fashion industry. Need mentorship on business planning, funding options, and navigating German bureaucracy for startups.',
                'status' => MentorshipRequestStatus::Pending,
                'expertise_ids' => ['entrepreneurship', 'business'],
            ],
            [
                'mentee_name' => 'David Chen',
                'mentee_email' => 'david.chen@example.com',
                'mentee_phone' => '+49 163 4567890',
                'help_description' => 'Struggling with German language learning and integration. Need help with improving my German for professional settings and understanding workplace culture.',
                'status' => MentorshipRequestStatus::Matched,
                'expertise_ids' => ['german-language', 'integration'],
            ],
            [
                'mentee_name' => 'Fatima Al-Rashid',
                'mentee_email' => 'fatima.alrashid@example.com',
                'mentee_phone' => '+49 172 5678901',
                'help_description' => 'Interested in pursuing a Master\'s degree in Public Health. Need guidance on university selection, scholarship opportunities, and application timeline.',
                'status' => MentorshipRequestStatus::Pending,
                'expertise_ids' => ['university-application', 'health-sciences'],
            ],
            [
                'mentee_name' => 'James Wilson',
                'mentee_email' => 'james.wilson@example.com',
                'mentee_phone' => '+49 151 6789012',
                'help_description' => 'Working as a software developer and looking to transition into a leadership role. Seeking mentorship on developing management skills and career advancement strategies.',
                'status' => MentorshipRequestStatus::Completed,
                'expertise_ids' => ['career-guidance', 'computer-science', 'leadership'],
            ],
            [
                'mentee_name' => 'Priya Sharma',
                'mentee_email' => 'priya.sharma@example.com',
                'mentee_phone' => '+49 177 7890123',
                'help_description' => 'Recent arrival in Germany with a background in finance. Need help understanding the German banking system and finding opportunities in the financial sector.',
                'status' => MentorshipRequestStatus::Matched,
                'expertise_ids' => ['finance', 'career-guidance', 'integration'],
            ],
            [
                'mentee_name' => 'Thomas Mueller',
                'mentee_email' => 'thomas.mueller@example.com',
                'mentee_phone' => '+49 162 8901234',
                'help_description' => 'High school student interested in studying Data Science. Looking for guidance on university programs, required skills, and career prospects in this field.',
                'status' => MentorshipRequestStatus::Pending,
                'expertise_ids' => ['university-application', 'computer-science', 'data-science'],
            ],
            [
                'mentee_name' => 'Elena Popova',
                'mentee_email' => 'elena.popova@example.com',
                'mentee_phone' => '+49 173 9012345',
                'help_description' => 'Artist looking to establish myself in the German art scene. Need guidance on networking, gallery representation, and funding opportunities for artists.',
                'status' => MentorshipRequestStatus::Matched,
                'expertise_ids' => ['arts', 'entrepreneurship', 'networking'],
            ],
            [
                'mentee_name' => 'Robert Taylor',
                'mentee_email' => 'robert.taylor@example.com',
                'mentee_phone' => '+49 174 0123456',
                'help_description' => 'Engineer with 10 years of experience looking to validate my foreign degree and understand the certification process for practicing in Germany.',
                'status' => MentorshipRequestStatus::Cancelled,
                'expertise_ids' => ['engineering', 'career-guidance', 'legal-advice'],
            ],
            [
                'mentee_name' => 'Aisha Okonkwo',
                'mentee_email' => 'aisha.okonkwo@example.com',
                'mentee_phone' => '+49 175 1234567',
                'help_description' => 'Medical professional seeking guidance on the process of getting my medical license recognized in Germany and finding residency positions.',
                'status' => MentorshipRequestStatus::Matched,
                'expertise_ids' => ['health-sciences', 'career-guidance', 'legal-advice'],
            ],
            [
                'mentee_name' => 'Carlos Rodriguez',
                'mentee_email' => 'carlos.rodriguez@example.com',
                'mentee_phone' => '+49 178 2345678',
                'help_description' => 'Want to pivot my career from marketing to UX design. Looking for guidance on skill development, portfolio building, and breaking into the tech industry.',
                'status' => MentorshipRequestStatus::Pending,
                'expertise_ids' => ['career-guidance', 'design', 'computer-science'],
            ],
            [
                'mentee_name' => 'Linda Kim',
                'mentee_email' => 'linda.kim@example.com',
                'mentee_phone' => '+49 179 3456789',
                'help_description' => 'PhD student in Biology looking for advice on research opportunities, funding, and academic career paths in Germany.',
                'status' => MentorshipRequestStatus::Completed,
                'expertise_ids' => ['research', 'sciences', 'university-application'],
            ],
            [
                'mentee_name' => 'Mohammed Ali',
                'mentee_email' => 'mohammed.ali@example.com',
                'mentee_phone' => '+49 152 4567890',
                'help_description' => 'Entrepreneur looking to scale my e-commerce business. Need mentorship on German tax laws, hiring employees, and expanding to other EU markets.',
                'status' => MentorshipRequestStatus::Matched,
                'expertise_ids' => ['entrepreneurship', 'business', 'legal-advice'],
            ],
            [
                'mentee_name' => 'Sophie Dubois',
                'mentee_email' => 'sophie.dubois@example.com',
                'mentee_phone' => '+49 176 5678901',
                'help_description' => 'Journalist seeking to understand the German media landscape and find freelance opportunities in international journalism.',
                'status' => MentorshipRequestStatus::Pending,
                'expertise_ids' => ['media', 'career-guidance', 'networking'],
            ],
        ];

        foreach ($requests as $requestData) {
            $expertiseIds = [];
            foreach ($requestData['expertise_ids'] as $slug) {
                $expertise = $expertiseCategories->where('slug', $slug)->first();
                if ($expertise) {
                    $expertiseIds[] = $expertise->id;
                }
            }

            $request = MentorshipRequest::create([
                'mentee_name' => $requestData['mentee_name'],
                'mentee_email' => $requestData['mentee_email'],
                'mentee_phone' => $requestData['mentee_phone'],
                'help_description' => $requestData['help_description'],
                'status' => $requestData['status'],
                'preferred_expertise' => json_encode($expertiseIds),
            ]);

            // Attach expertise categories
            if (!empty($expertiseIds)) {
                $request->expertiseCategories()->attach($expertiseIds);
            }

            // For matched and completed requests, assign a mentor
            if (in_array($requestData['status'], [MentorshipRequestStatus::Matched, MentorshipRequestStatus::Completed])) {
                if ($approvedMentors->isNotEmpty()) {
                    // Find a mentor with matching expertise if possible
                    $matchingMentor = $approvedMentors->filter(function ($mentor) use ($expertiseIds) {
                        return $mentor->expertiseCategories()->whereIn('expertise_categories.id', $expertiseIds)->exists();
                    })->first();

                    if (!$matchingMentor) {
                        $matchingMentor = $approvedMentors->random();
                    }

                    $request->update([
                        'matched_mentor_id' => $matchingMentor->id,
                        'matched_at' => now()->subDays(rand(1, 30)),
                        'matched_by' => $adminUser?->id,
                    ]);
                }
            }

            // For completed requests, set completion date
            if ($requestData['status'] === MentorshipRequestStatus::Completed) {
                $request->update([
                    'updated_at' => now()->subDays(rand(1, 10)),
                ]);
            }
        }

        $this->command->info('Mentorship requests seeded successfully!');
    }
}