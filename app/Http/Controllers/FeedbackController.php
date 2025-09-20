<?php

namespace App\Http\Controllers;

use App\Enums\FeedbackType;
use App\Models\Feedback;
use App\Models\FeedbackToken;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function showFeedbackForm(string $token): View
    {
        $feedbackToken = $this->validateToken($token, 'mentee_feedback');

        return view('feedback.form', [
            'token' => $feedbackToken,
            'session' => $feedbackToken->mentorshipSession,
            'type' => 'feedback'
        ]);
    }

    public function showReportForm(string $token): View
    {
        $feedbackToken = $this->validateToken($token, 'mentor_report');

        return view('feedback.form', [
            'token' => $feedbackToken,
            'session' => $feedbackToken->mentorshipSession,
            'type' => 'report'
        ]);
    }

    public function submitFeedback(Request $request, string $token)
    {
        $feedbackToken = $this->validateToken($token, 'mentee_feedback');

        return $this->handleSubmission($request, $feedbackToken, 'mentee');
    }

    public function submitReport(Request $request, string $token)
    {
        $feedbackToken = $this->validateToken($token, 'mentor_report');

        return $this->handleSubmission($request, $feedbackToken, 'mentor');
    }

    private function validateToken(string $token, string $expectedType): FeedbackToken
    {
        $feedbackToken = FeedbackToken::where('token', $token)
            ->where('type', $expectedType)
            ->firstOrFail();

        if (!$feedbackToken->isValid()) {
            if ($feedbackToken->used) {
                abort(410, 'This feedback link has already been used.');
            }

            if ($feedbackToken->isExpired()) {
                abort(410, 'This feedback link has expired.');
            }
        }

        return $feedbackToken;
    }

    private function handleSubmission(Request $request, FeedbackToken $feedbackToken, string $feedbackType)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'required|string|max:2000',
        ]);

        Feedback::create([
            'session_id' => $feedbackToken->session_id,
            'feedback_type' => $feedbackType === 'mentee' ? FeedbackType::Mentee : FeedbackType::Mentor,
            'rating' => $validated['rating'],
            'comments' => $validated['comments'],
            'submitted_at' => now(),
        ]);

        $feedbackToken->markAsUsed();

        return view('feedback.success', [
            'type' => $feedbackType === 'mentee' ? 'feedback' : 'report'
        ]);
    }
}
