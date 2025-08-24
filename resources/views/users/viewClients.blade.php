<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session()->has('message'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Success!</span>     {{ session()->get('message') }}.
                    
                </div>
            @endif
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                {{$user}} ===> Clients
            </span>
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Link
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Client
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        @if ($quots->count() > 0)
                            @foreach ($quots as $q)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{$q->link}}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($q->visited && $q->pdfLink)
                                            <a href="{{url($q->pdfLink)}}" target="_blank">View</a>
                                        @else
                                            @if(round((strtotime($q->created_at) - time()) / 3600) < 0)
                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-5 py-1 rounded dark:bg-white-700 dark:text-green-400 border border-blue-400">
                                                    Expired
                                                </span> 
                                            @else
                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-5 py-1 rounded dark:bg-white-700 dark:text-green-400 border border-blue-400">
                                                        Waiting...
                                                </span>  
                                            @endif
                                        @endif
                                    
                                    </td>
                                    <td class="px-6 py-4">                                        
                                        {{$q->clientName}}
                                    </td>
                                    <td class="px-6 py-4 flex flex-wrap">
                                        {{$q->created_at}}
                                    </td>
                                </tr>
                            
                            @endforeach
                        
                        @endif

                            
                        </tbody>
                    </table>
                </div>                

                <nav aria-label="Page navigation example" class="mt-5 ms-auto">
                    <ul class="inline-flex -space-x-px text-sm ms-auto">
                        <p class="text-right">{{ $quots->links() }} </p>
                    </ul>
                </nav>
            </div>


        </div>
    </div>
</x-app-layout>
