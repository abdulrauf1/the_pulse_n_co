<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session()->has('message'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Success!</span>     {{ session()->get('message') }}.
                    <hr style="margin-bottom:10px;border: 2px sold white">
                    @if(session()->has('link'))
                        {{ session()->get('link') }}
                    @endif
                </div>
            @endif
            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-5 py-1 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                Users
            </span>
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid grid-cols-3 md:grid-cols-4 gap-5">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div>
                        <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                           <a href="{{route('users.create')}}">Add User</a> 
                        </button>
                    </div>
                </div>


                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Logo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        @if ($users->count() > 0)
                            @foreach ($users as $u)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a data-tooltip-target="view-tooltip" data-tooltip-placement="bottom" href="{{route('users.clients',$u->id)}}">{{$u->name}}</a>
                                        <div id="view-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">Click to View Clients
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>

                                    </th>
                                    <td class="px-6 py-4">
                                        {{$u->email}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$u->address}}
                                    </td>
                                    <td class="px-6 py-4">                                        
                                        <img id="logoSrc" class="w-16 h-16 rounded-full" src="{{$u->logo}}" alt="Logo">
                                    </td>
                                    <td class="px-6 py-4 flex flex-wrap">
                                        <form id="delete" action="{{ route('user.destroy',$u->id) }}" method="POST" >
                                            @csrf
                                            <button class="no-style" type="submit" data-tooltip-target="delete-tooltip" data-tooltip-placement="bottom" >
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                </svg>
                                            </button>
                                            <div id="delete-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">Delete User
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>

                                        </form>
                                        <form id="delete" action="{{ route('user.link',$u->id) }}" method="POST" >
                                            @csrf
                                            <button class="no-style" type="submit" data-tooltip-target="forward-tooltip" data-tooltip-placement="bottom" >
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.248 19C3.22 15.77 5.275 8.232 12.466 8.232V6.079a1.025 1.025 0 0 1 1.644-.862l5.479 4.307a1.108 1.108 0 0 1 0 1.723l-5.48 4.307a1.026 1.026 0 0 1-1.643-.861v-2.154C5.275 13.616 4.248 19 4.248 19Z"/>
                                                </svg>

                                            </button>
                                            <div id="forward-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">Send a new Link for Calculation
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>

                                        </form>
                                        
                                    </td>
                                </tr>
                            
                            @endforeach
                        
                        @endif

                            
                        </tbody>
                    </table>
                </div>                

                <nav aria-label="Page navigation example" class="mt-5 ms-auto">
                    <ul class="inline-flex -space-x-px text-sm ms-auto">
                        <p class="text-right">{{ $users->links() }} </p>
                    </ul>
                </nav>
            </div>


        </div>
    </div>
</x-app-layout>
