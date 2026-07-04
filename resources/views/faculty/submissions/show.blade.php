<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('faculty.submissions.index') }}" id="review-back-header-btn" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Review Submission') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Student Info Card -->
        <div id="review-student-info" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
            <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-3">Student Information</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <p class="text-xs text-gray-400 uppercase font-semibold">Name</p>
                    <p class="text-sm text-gray-800 font-medium mt-0.5">{{ $achievement->user->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-semibold">Roll No</p>
                    <p class="text-sm text-gray-800 font-mono mt-0.5">{{ $achievement->user->roll_number }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-semibold">Department</p>
                    <p class="text-sm text-gray-800 mt-0.5">{{ $achievement->user->department }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-semibold">Semester</p>
                    <p class="text-sm text-gray-800 mt-0.5">{{ $achievement->user->semester }}</p>
                </div>
            </div>
        </div>

        <!-- Achievement Details -->
        <div id="review-achievement-details" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">{{ $achievement->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Submitted on {{ $achievement->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    @if($achievement->status === 'pending')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-amber-100 text-amber-700">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                            Pending Review
                        </span>
                    @elseif($achievement->status === 'approved')
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-700">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                            Approved
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                            Rejected
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6 space-y-5">
                <!-- Category -->
                <div class="group">
                    <p class="text-xs font-semibold text-orange-400 uppercase tracking-wider mb-1 transition-colors group-hover:text-orange-600">Category</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-gradient-to-r from-orange-50 to-amber-50 text-orange-700 border border-orange-100 shadow-sm transition-all hover:shadow-md hover:scale-105">
                        {{ $achievement->category }}
                    </span>
                </div>

                <!-- Description -->
                <div class="group">
                    <p class="text-xs font-semibold text-orange-400 uppercase tracking-wider mb-2 transition-colors group-hover:text-orange-600">Description</p>
                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 p-4 rounded-xl border border-orange-100 shadow-sm transition-all hover:shadow-md">
                        <p class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $achievement->description }}</p>
                    </div>
                </div>

                <!-- File -->
                @if($achievement->file_path)
                    <div class="group">
                        <p class="text-xs font-semibold text-orange-400 uppercase tracking-wider mb-2 transition-colors group-hover:text-orange-600">Attached Document</p>
                        <a href="{{ Storage::url($achievement->file_path) }}" id="review-download-file" target="_blank"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-orange-500 to-amber-500 text-white rounded-lg text-sm font-medium hover:from-orange-600 hover:to-amber-600 shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12M12 16.5V3"/>
                            </svg>
                            View / Download File
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Review Form (only if pending) -->
        @if($achievement->status === 'pending')
            <div id="review-form-card" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-orange-200 bg-gradient-to-r from-orange-50 to-amber-50">
                    <h3 class="font-bold text-orange-700 flex items-center gap-2 text-lg">
                        <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                        </svg>
                        Submit Your Review
                    </h3>
                </div>

                <form method="POST" action="{{ route('faculty.submissions.review', $achievement) }}" id="review-form" class="p-6 space-y-5">
                    @csrf
                    @method('PATCH')

                    <!-- Decision -->
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Decision</p>
                        <div class="flex flex-col sm:flex-row gap-3" x-data="{ decision: '' }">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="approved" x-model="decision" class="sr-only peer" id="review-approve-radio" required>
                                <div class="flex items-center justify-center gap-2 px-4 py-3 rounded-lg border-2 text-sm font-semibold transition-all duration-300
                                            peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700
                                            border-gray-200 text-gray-500 hover:border-green-400 hover:text-green-600 hover:bg-green-50 hover:shadow-md cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    Approve
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="rejected" x-model="decision" class="sr-only peer" id="review-reject-radio" required>
                                <div class="flex items-center justify-center gap-2 px-4 py-3 rounded-lg border-2 text-sm font-semibold transition-all duration-300
                                            peer-checked:border-red-600 peer-checked:bg-red-50 peer-checked:text-red-700
                                            border-gray-200 text-gray-500 hover:border-red-400 hover:text-red-600 hover:bg-red-50 hover:shadow-md cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    Reject
                                </div>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <!-- Remarks -->
                    <div>
                        <x-input-label for="review-remarks" :value="__('Remarks (Optional)')" />
                        <textarea id="review-remarks" name="remarks" rows="3"
                                  class="block mt-1 w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm resize-y"
                                  placeholder="Add any notes or feedback for the student...">{{ old('remarks') }}</textarea>
                        <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end pt-2">
                        <x-primary-button id="review-submit-btn">
                            {{ __('Submit Review') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        @else
            <!-- Already Reviewed Info -->
            <div id="review-completed-card" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                        </svg>
                        Review Completed
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Reviewed By</p>
                            <p class="text-gray-700 font-medium mt-0.5">{{ $achievement->reviewer->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Reviewed On</p>
                            <p class="text-gray-700 font-medium mt-0.5">{{ $achievement->reviewed_at ? $achievement->reviewed_at->format('M d, Y') : '—' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Decision</p>
                            <p class="font-medium mt-0.5 {{ $achievement->status === 'approved' ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ ucfirst($achievement->status) }}
                            </p>
                        </div>
                    </div>
                    @if($achievement->remarks)
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Remarks</p>
                            <p class="text-gray-700 text-sm bg-gray-50 p-3 rounded-lg border border-gray-200">{{ $achievement->remarks }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div>
            <a href="{{ route('faculty.submissions.index') }}" id="review-back-link"
               class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-fcrit-600 font-medium transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
                Back to Submissions
            </a>
        </div>
    </div>
</x-app-layout>
