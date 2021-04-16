<div>

    @isset ($documents)
    <div class="mt-2 p-2 sm:px-4" wire:poll.5000ms>
        <table class="border-collapse w-full">
            <thead>
                <tr>
                    <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                        Document Name
                    </th>
                    <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                        Category
                    </th>
                    <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                        Required
                    </th>

                    <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                        Template
                    </th>


                </tr>

            </thead>
            <tbody>
            </tbody>
            @foreach ($documents as $document)

            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-auto left-0 bg-blue-200 px-1 py-1 text-xs font-bold"> Document Name </span>
                    {{ $document->name }}
                </td>

                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-auto left-0 bg-blue-200 px-1 py-1 text-xs font-bold"> Category </span>
                    {{ $document->Documents_Category->name }}
                </td>

                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Required</span>
                    <span class="{{$document->required == 0 ? 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-green-800' : 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800' }}"> {{$document->required == 0 ? 'No' : 'Yes' }}</span>
                </td>

                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Template</span>

                    @if($document->file_path == !null )


                    <div class="flex no-wrap justify-center"> <a href="https://drive.google.com/uc?export=download&id={{$document->file_path}}">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                Download <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 ml-1" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                                </svg>

                            </span> </a> </div>
                    @endif




                </td>


            </tr>

            @endforeach
        </table>
    </div>
    @endisset

</div>