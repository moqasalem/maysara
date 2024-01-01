<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create Assessment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('assessments.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="title" :value="__('Tittle')" />
                            <x-text-input id="title" class="block w-full mt-1" type="text" name="title" placeholder="Assessment Title"
                                :value="old('title')" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <x-input-label for="type" :value="__('Type')" class="mt-2"/>

                            <select class="block w-full mt-1" data-hide-search="true" required  id="type"
                                data-placeholder="Select" name="type">
                                    <option value="quiz">Quiz</option>
                                    <option value="question ">Question </option>
                            </select>
                        </div>
                       
                        <select class="block w-full mt-2" data-hide-search="true" required  id="type"
                            data-placeholder="Select" name="course_id">
                            @foreach ($courses as $course)
                            <option value="{{  $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        <textarea name="body" class="my-2 w-100" rows="10" placeholder="Assessment Body"></textarea>
                        <br>
                        <x-primary-button class="ms-4">
                            {{ __('Save') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
