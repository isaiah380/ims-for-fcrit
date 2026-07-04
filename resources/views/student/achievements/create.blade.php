<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Submit Achievement') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Achievement Details</h3>
                <p class="text-sm text-gray-500 mt-1">Fill in the details of your academic achievement for review.</p>
            </div>

            <form method="POST" action="{{ route('student.achievements.store') }}" enctype="multipart/form-data" id="achievement-create-form" class="p-6 space-y-5">
                @csrf

                <!-- Title -->
                <div>
                    <x-input-label for="achievement-title" :value="__('Achievement Title')" />
                    <x-text-input id="achievement-title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required placeholder="e.g., First Prize in National Coding Competition" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Category -->
                <div>
                    <x-input-label for="achievement-category" :value="__('Category')" />
                    <select id="achievement-category" name="category" required
                            class="block mt-1 w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm">
                        <option value="">Select Category</option>
                        <option value="Internship" {{ old('category') === 'Internship' ? 'selected' : '' }}>Internship</option>
                        <option value="Certificate" {{ old('category') === 'Certificate' ? 'selected' : '' }}>Certificate</option>
                        <option value="Competition" {{ old('category') === 'Competition' ? 'selected' : '' }}>Competition</option>
                        <option value="Paper Publication" {{ old('category') === 'Paper Publication' ? 'selected' : '' }}>Paper Publication</option>
                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="achievement-description" :value="__('Description')" />
                    <textarea id="achievement-description" name="description" rows="4" required
                              class="block mt-1 w-full border-gray-300 focus:border-fcrit-500 focus:ring-fcrit-500 rounded-lg shadow-sm text-sm resize-y"
                              placeholder="Describe your achievement, including relevant dates, organizations, and outcomes...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- File Upload -->
                <div>
                    <x-input-label for="achievement-file" :value="__('Supporting Document (Optional)')" />
                    <div x-data="{ fileName: '', dragging: false }"
                         class="mt-1"
                         @dragover.prevent="dragging = true"
                         @dragleave.prevent="dragging = false"
                         @drop.prevent="dragging = false; $refs.fileInput.files = $event.dataTransfer.files; fileName = $refs.fileInput.files[0]?.name || ''">

                        <label for="achievement-file"
                               :class="dragging ? 'border-fcrit-500 bg-fcrit-50' : 'border-gray-300 bg-gray-50 hover:bg-gray-100'"
                               class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed rounded-xl cursor-pointer transition-colors duration-200">
                            <div class="flex flex-col items-center justify-center py-4">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                                </svg>
                                <template x-if="fileName">
                                    <p class="text-sm text-fcrit-600 font-medium" x-text="fileName"></p>
                                </template>
                                <template x-if="!fileName">
                                    <div class="text-center">
                                        <p class="text-sm text-gray-500"><span class="text-fcrit-600 font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-400 mt-1">PDF or Image (max 5MB)</p>
                                    </div>
                                </template>
                            </div>
                            <input id="achievement-file" x-ref="fileInput" type="file" name="file" class="hidden"
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   @change="fileName = $refs.fileInput.files[0]?.name || ''" />
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('file')" class="mt-2" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('student.achievements.index') }}" id="achievement-cancel-btn"
                       class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </a>
                    <x-primary-button id="achievement-submit-btn">
                        {{ __('Submit Achievement') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
