<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Student Submissions') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search & Filter Bar -->
        <div id="faculty-filter-bar" class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
            <form method="GET" action="{{ route('faculty.submissions.index') }}" id="faculty-filter-form">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label for="filter-search" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Search</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                            </svg>
                            <input type="text" id="filter-search" name="search" value="{{ $filters['search'] ?? '' }}"
                                   class="w-full pl-9 pr-3 py-2 border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm"
                                   placeholder="Search by name, roll no, or title...">
                        </div>
                    </div>

                    <!-- Department -->
                    <div>
                        <label for="filter-department" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Department</label>
                        <select id="filter-department" name="department"
                                class="w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm">
                            <option value="">All Departments</option>
                            @foreach(['CE', 'ME', 'EXTC', 'EE', 'CSE', 'BSH'] as $dept)
                                <option value="{{ $dept }}" {{ ($filters['department'] ?? '') === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="filter-category" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Category</label>
                        <select id="filter-category" name="category"
                                class="w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm">
                            <option value="">All Categories</option>
                            @foreach(['Internship', 'Certificate', 'Competition', 'Paper Publication'] as $cat)
                                <option value="{{ $cat }}" {{ ($filters['category'] ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="filter-status" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Status</label>
                        <select id="filter-status" name="status"
                                class="w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm">
                            <option value="">All Status</option>
                            <option value="pending" {{ ($filters['status'] ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ ($filters['status'] ?? '') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ ($filters['status'] ?? '') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-4">
                    <a href="{{ route('faculty.submissions.index') }}" id="filter-reset-btn"
                       class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Reset
                    </a>
                    <button type="submit" id="filter-apply-btn"
                            class="px-4 py-2 text-sm font-semibold text-white bg-fcrit-600 rounded-lg hover:bg-fcrit-700 focus:outline-none focus:ring-2 focus:ring-fcrit-500 focus:ring-offset-2 transition-all duration-200">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Results -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            @if(isset($submissions) && $submissions->count() > 0)
                <!-- Result Count -->
                <div class="px-6 py-3 border-b border-gray-100 bg-gray-50">
                    <p id="faculty-result-count" class="text-sm text-gray-500">
                        Showing <span class="font-semibold text-gray-700">{{ $submissions->firstItem() }}–{{ $submissions->lastItem() }}</span> of <span class="font-semibold text-gray-700">{{ $submissions->total() }}</span> submissions
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table id="faculty-submissions-table" class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Student</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Roll No</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dept</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($submissions as $submission)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $submission->user->name }}</td>
                                    <td class="px-6 py-4 text-gray-600 font-mono text-xs">{{ $submission->user->roll_number }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-700">
                                            {{ $submission->user->department }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{ Str::limit($submission->title, 35) }}</td>
                                    <td class="px-6 py-4 text-gray-600 text-xs">{{ $submission->category }}</td>
                                    <td class="px-6 py-4">
                                        @if($submission->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Pending</span>
                                        @elseif($submission->status === 'approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Approved</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-xs">{{ $submission->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('faculty.submissions.show', $submission) }}" class="text-fcrit-600 hover:text-fcrit-700 font-medium transition-colors">
                                            Review
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($submissions->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $submissions->appends($filters ?? [])->links() }}
                    </div>
                @endif
            @else
                <div id="faculty-submissions-empty" class="px-6 py-16 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                    <h4 class="text-gray-500 font-medium mb-1">No submissions found</h4>
                    <p class="text-sm text-gray-400">Try adjusting your search or filter criteria.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
