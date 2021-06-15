<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload new document') }}
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

            <form action="{{ route('document.upload.post') }}" method="POST" enctype="multipart/form-data" class="m-auto w-100">
                @csrf

                <div class="uppercase font-bold">Upload document</div>

                @if ($message = Session::get('success'))
                <div class="w-50">
                    <a href = "{{ 'uploads' }}/{{ Session::get('document') }}">uploads/{{ Session::get('document') }}</a>
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="text-red-600">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="flex w-full items-center justify-center bg-grey-lighter my-3">
                    <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue uppercase border border-blue cursor-pointer">
                        <span class="text-base leading-normal" id="fileBtn">Choose file</span>
                        <input type='file' name="document" class="hidden" onchange="document.querySelector('#fileBtn').innerText = this.files[0].name"/>
                    </label>
                </div>

                <div class="uppercase font-bold">Title</div>
                <input type="text" name="title" class="my-3 w-full flex flex-col items-center px-4 py-6 bg-white text-blue uppercase border">

                @if (!Auth::guest())
                <input type="hidden" name="author" value = "{{ Auth::user()->id }}">
                @else
                <input type="hidden" name="author" value = "0">
                @endif

                <button type="submit" class="my-8 w-full flex flex-col items-center px-4 py-6 uppercase font-bold bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Upload
                </button>


            </form>
        </div>
    </div>

</x-app-layout>
