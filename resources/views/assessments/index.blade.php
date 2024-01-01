<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Assessments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900">
                    @if(auth()->user()->type == 'teacher')
                        <a class="btn btn-primary"
                            href="{{ route('assessments.create') }}"> Create New Assessment</a>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>name</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($assessments as $assessment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$assessment->title}}</td>
                            </tr>
                            @endforeach

            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
