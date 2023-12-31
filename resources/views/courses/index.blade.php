<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900">
                    @if(auth()->user()->type == 'teacher')
                        <a class="btn btn-primary"
                            href="{{ route('courses.create') }}"> Create New Course</a>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>name</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(auth()->user()->type == 'teacher')
                            @foreach($courses as $course)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$course->name}}</td>
                            </tr>
                            @endforeach
                        @endif

                        @if(auth()->user()->type == 'student')
                            @foreach($courses as $course)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$course->course->name}}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
