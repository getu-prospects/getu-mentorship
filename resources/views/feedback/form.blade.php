<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type === 'feedback' ? 'Session Feedback' : 'Session Report' }} - GeTu Prospects</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.955 8.955 0 01-4.126-.98L3 20l1.98-5.874A8.955 8.955 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ $type === 'feedback' ? 'Session Feedback' : 'Session Report' }}
                </h1>
                <p class="text-gray-600">
                    {{ $type === 'feedback'
                        ? 'Please share your experience with the mentorship session'
                        : 'Please provide a report of the mentorship session conducted' }}
                </p>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Session Details</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Mentee:</span>
                        <span class="font-medium">{{ $session->request->mentee_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Mentor:</span>
                        <span class="font-medium">{{ $session->mentor->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Request Date:</span>
                        <span class="font-medium">{{ $session->request->created_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>

            <form action="{{ $type === 'feedback' ? route('feedback.submit', $token->token) : route('report.submit', $token->token) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $type === 'feedback' ? 'How would you rate this mentorship session?' : 'How would you rate the overall session?' }}
                    </label>
                    <div class="flex space-x-2">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" {{ old('rating') == $i ? 'checked' : '' }}>
                                <div class="w-12 h-12 rounded-full border-2 border-gray-300 flex items-center justify-center peer-checked:border-teal-500 peer-checked:bg-teal-500 peer-checked:text-white hover:border-teal-400 transition-colors">
                                    <span class="font-semibold">{{ $i }}</span>
                                </div>
                            </label>
                        @endfor
                    </div>
                    <div class="flex justify-between text-sm text-gray-500 mt-2">
                        <span>Poor</span>
                        <span>Excellent</span>
                    </div>
                    @error('rating')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="comments" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $type === 'feedback'
                            ? 'Please share your thoughts about the session'
                            : 'Please provide details about what was covered in the session' }}
                    </label>
                    <textarea
                        name="comments"
                        id="comments"
                        rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                        placeholder="{{ $type === 'feedback'
                            ? 'What did you find most helpful? Any suggestions for improvement?'
                            : 'Topics discussed, outcomes achieved, next steps recommended...' }}"
                    >{{ old('comments') }}</textarea>
                    @error('comments')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <strong>Note:</strong> This form can only be submitted once. Once you submit your {{ $type }}, this link will no longer be accessible.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="bg-teal-600 text-white px-8 py-3 rounded-md font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-colors"
                    >
                        Submit {{ ucfirst($type) }}
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-8">
            <p class="text-sm text-gray-500">
                <strong>GeTu Prospects e.V.</strong> - Supporting refugee and migrant youth in Germany
            </p>
        </div>
    </div>
</body>
</html>