<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type === 'feedback' ? 'Feedback' : 'Report' }} Submitted - GeTu Prospects</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                {{ $type === 'feedback' ? 'Feedback' : 'Report' }} Submitted Successfully!
            </h1>

            <p class="text-lg text-gray-600 mb-6">
                {{ $type === 'feedback'
                    ? 'Thank you for taking the time to share your experience. Your feedback helps us improve our mentorship program.'
                    : 'Thank you for providing your session report. This information helps us ensure the quality of our mentorship program.' }}
            </p>

            <div class="bg-green-50 rounded-lg p-6 mb-8">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-green-800">What happens next?</h3>
                        <div class="mt-2 text-sm text-green-700">
                            <ul class="list-disc list-inside space-y-1">
                                @if($type === 'feedback')
                                    <li>Your feedback has been recorded and will be reviewed by our team</li>
                                    <li>We may use your insights to improve our mentorship matching process</li>
                                    <li>If you need additional support, we'll reach out to you directly</li>
                                @else
                                    <li>Your session report has been recorded in our system</li>
                                    <li>This helps us track the progress and impact of our mentorship program</li>
                                    <li>The information will be used to support future mentorship matches</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <p class="text-sm text-gray-500 mb-4">
                    This {{ $type }} link has now expired and cannot be used again.
                </p>

                <p class="text-sm text-gray-600">
                    If you have any questions or need support, please contact us at
                    <a href="mailto:admin@getu-prospects.de" class="text-teal-600 hover:text-teal-700 font-medium">
                        admin@getu-prospects.de
                    </a>
                </p>
            </div>
        </div>

        <div class="text-center mt-8">
            <p class="text-sm text-gray-500">
                <strong>GeTu Prospects e.V.</strong> - Supporting refugee and migrant youth in Germany
            </p>
            <p class="text-sm text-gray-400 mt-2">
                <a href="https://www.getu-prospects.de" class="hover:text-gray-600">www.getu-prospects.de</a>
            </p>
        </div>
    </div>
</body>
</html>