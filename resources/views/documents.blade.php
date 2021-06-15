<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents list') }}
        </h2>
    </x-slot>
    <!--
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <table class="table-auto border-2">
                <thead>
                    <tr>
                        <th class="w-1/2">Title</th>
                        <th class="w-1/4">Author</th>
                        <th class="w-1/4">Date</th>
                        <th class="w-1/4">File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $doc)
                    <tr>
                        <td class="border-2 p-5">{{ $doc->name }}</td>
                        <td class="border-2 p-5">{{ $doc->author }}</td>
                        <td class="border-2 p-5">{{ $doc->date }}</td>
                        <td class="border-2 p-5"><a href="uploads/{{ $doc->file }}" class="hover:text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
    </div>

</x-app-layout>
