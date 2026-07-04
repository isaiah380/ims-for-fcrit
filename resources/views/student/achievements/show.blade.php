<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('student.achievements.index') }}" id="achievement-show-back-btn" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
            </a>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Achievement Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header with Status -->
            <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h3 id="achievement-show-title" class="text-lg font-bold text-gray-800">{{ $achievement->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Submitted on {{ $achievement->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    @if($achievement->status === 'pending')
                        <span id="achievement-show-status" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-amber-100 text-amber-700">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                            Pending Review
                        </span>
                    @elseif($achievement->status === 'approved')
                        <span id="achievement-show-status" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-700">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                            Approved
                        </span>
                    @else
                        <span id="achievement-show-status" class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3"/></svg>
                            Rejected
                        </span>
                    @endif
                </div>
            </div>

            <!-- Details -->
            <div class="p-6 space-y-6">
                <!-- Category -->
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Category</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-gray-100 text-gray-700">
                        {{ $achievement->category }}
                    </span>
                </div>

                <!-- Description -->
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Description</p>
                    <p id="achievement-show-description" class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $achievement->description }}</p>
                </div>

                <!-- File -->
                @if($achievement->file_path)
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Attached Document</p>
                        <a href="{{ Storage::url($achievement->file_path) }}" id="achievement-show-download" target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12M12 16.5V3"/>
                            </svg>
                            Download File
                        </a>
                    </div>
                @endif
            </div>

            <!-- Review Info (if reviewed) -->
            @if($achievement->status !== 'pending' && $achievement->reviewer)
                <div class="px-6 py-5 bg-gray-50 border-t border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                        </svg>
                        Review Information
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Reviewed By</p>
                            <p id="achievement-show-reviewer" class="text-gray-700 font-medium mt-0.5">{{ $achievement->reviewer->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Reviewed On</p>
                            <p id="achievement-show-reviewed-date" class="text-gray-700 font-medium mt-0.5">{{ $achievement->reviewed_at ? $achievement->reviewed_at->format('M d, Y') : '—' }}</p>
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
                            <p id="achievement-show-remarks" class="text-gray-700 text-sm bg-white p-3 rounded-lg border border-gray-200">{{ $achievement->remarks }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('student.achievements.index') }}" id="achievement-show-back-link"
               class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-fcrit-600 font-medium transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
                Back to My Achievements
            </a>
        </div>
    </div>
</x-app-layout>
