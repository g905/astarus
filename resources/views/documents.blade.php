<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('documents') }}" method="post" class="m-auto w-100" id="sortForm">
                @csrf

                <input type="text" name="searchPhrase" placeholder="input search word" class="my-3 w-full flex flex-col items-center px-4 py-4 bg-white text-blue uppercase border" value="{{ isset($_POST['searchPhrase']) ? $_POST['searchPhrase'] : '' }}"/>
                <input type='hidden' name='sort' id="sort" value='name'/>
            </form>

        </div>
    </div>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <table class="table-auto border-2">
                <thead>
                    <tr>
                        <th class="w-1/2 cursor-pointer hover:text-green-600" onclick='document.querySelector("#sort").value = "name"; document.querySelector("#sortForm").submit()'>Title</th>
                        <th class="w-1/4 cursor-pointer hover:text-green-600" onclick='document.querySelector("#sort").value = "author"; document.querySelector("#sortForm").submit()'>Author</th>
                        <th class="w-1/4 cursor-pointer hover:text-green-600" onclick='document.querySelector("#sort").value = "date"; document.querySelector("#sortForm").submit()'>Date</th>
                        <th class="w-1/4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $doc)
                    <tr>
                        <td class="border-2 p-5">{{ $doc->name }}</td>
                        <td class="border-2 p-5">{{ \App\Models\User::findOrFail($doc->author)->name }}</td>
                        <td class="border-2 p-5">{{ date('d-m-Y', $doc->date) }}</td>
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
