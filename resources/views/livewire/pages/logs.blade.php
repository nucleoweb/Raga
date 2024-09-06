<div class="px-8">
    <div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option>Overview</option>
                <option>Tasks</option>
                <option selected>Documents</option>
                <option>Team</option>
                <option>Reports</option>
            </select>
        </div>

        <div class="hidden sm:block">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-200 hover:text-gray-700" -->
                    <a href="#" class="flex whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-sm font-medium text-gray-500 hover:border-gray-200 hover:text-gray-700">
                        Overview
                        <!-- Current: "bg-indigo-100 text-indigo-600", Default: "bg-gray-100 text-gray-900" -->
                        <span class="ml-3 hidden rounded-full bg-[#7288FF] text-white  px-2.5 py-0.5 text-xs font-medium md:inline-block">50</span>
                    </a>
                    <a href="#" class="flex whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-sm font-medium text-gray-500 hover:border-gray-200 hover:text-gray-700">
                        Tasks
                        <span class="ml-3 hidden rounded-full bg-[#7288FF] text-white  px-2.5 py-0.5 text-xs font-medium md:inline-block">1</span>
                    </a>
                    <a href="#" class="flex whitespace-nowrap border-b-2 border-indigo-500 px-1 py-4 text-sm font-medium text-indigo-600" aria-current="page">
                        Documents
                        <span class="ml-3 hidden rounded-full bg-[#7288FF] text-white  px-2.5 py-0.5 text-xs font-medium md:inline-block">4</span>
                    </a>
                    <a href="#" class="flex whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-sm font-medium text-gray-500 hover:border-gray-200 hover:text-gray-700"> Team </a>
                    <a href="#" class="flex whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-sm font-medium text-gray-500 hover:border-gray-200 hover:text-gray-700"> Reports </a>
                </nav>
            </div>
        </div>
    </div>

    @php
        $correos = \App\Models\Log::orderBy('id', 'desc')->get();
    @endphp

    <div class="sm:px-6 lg:px-8">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="relative">
                        <table class="min-w-full table-fixed divide-y divide-gray-300 border-2 border-[#E0E5FF]">
                            <thead class="bg-[#F2F4F8]">
                                <tr>
                                    <th scope="col" class="relative px-7 sm:w-12 sm:px-6">
                                        <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    </th>
                                    <th scope="col" class="py-3.5 pr-3 text-left text-sm font-semibold text-gray-900 w-[5%]">ID</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Asunto</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Body</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Respuesta</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($correos as $correo)
                                    @php
                                        $context = json_decode($correo->context, true); // Decode as an associative array
                                        $data = $context['data'] ?? [];
                                    @endphp
                                    <tr>
                                        <td class="relative px-7 sm:w-12 sm:px-6">
                                            <input type="checkbox" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </td>
                                        <!-- Selected: "text-indigo-600", Not Selected: "text-gray-900" -->
                                        <td class="py-4 pr-3 text-sm font-medium text-gray-900 w-[5%]">{{ $correo->id }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ $data['email'] ?? 'Email not available' }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500">{{ $data['asunto'] ?? 'Asunto not available' }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500 w-[20%]">{{ $data['body'] ?? 'Body not available' }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500 w-[50%]">{{ $correo->response ?? 'Response not available' }}</td>
                                        <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
