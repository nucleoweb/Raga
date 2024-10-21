<div class="page-wrapper" x-data="{ showModal: false, modalUpload: false, modalEdit: false, modalView: false }">
    <h1>Lista de Margenes</h1>

    <div class="mb-[35px] flex gap-10">
        <div>
            <input type="text" placeholder="Search" class="search-input" wire:model.live="search">
        </div>

        <div class="flex gap-5">
            <span class="label !hidden">
                Etiqueta
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M17 7L7 17M7 7L17 17" stroke="#7288FF" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </span>

            <span class="label !hidden">
                Etiqueta

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M17 7L7 17M7 7L17 17" stroke="#7288FF" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </span>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <h3 class="text-[18px] text-[#190FDB] font-bold pb-[11px] mb-[40px] border-b-[2px] inline-block  border-[#190FDB] relative ">Margenes</h3>
        <div class="flex justify-end items-center gap-2 mb-5">
            <div class="flex justify-center items-center border-[3px] border-[#C2C2C2] hover:border-[#565AFF] rounded-[6px] h-[46px] w-[46px] group transition-all duration-500 cursor-pointer" wire:click="exportMargins">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 15V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V15M17 10L12 15M12 15L7 10M12 15V3" class="group-hover:stroke-[#565AFF] transition-all duration-500" stroke="#AFAFAF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="flex justify-center items-center border-[3px] border-[#C2C2C2] hover:border-[#565AFF] rounded-[6px] h-[46px] w-[46px] group transition-all duration-500 cursor-pointer" @click="modalUpload = true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 15V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V15M17 8L12 3M12 3L7 8M12 3V15" class="group-hover:stroke-[#565AFF] transition-all duration-500" stroke="#AFAFAF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="flex justify-center items-center border-[3px] border-[#C2C2C2] hover:border-[#565AFF] bg-[#fff] hover:bg-[#565AFF] rounded-[6px] h-[46px] w-[46px] group cursor-pointer duration-500" @click="showModal = true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 8V16M8 12H16M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" class="group-hover:stroke-[#F7F7F7] transition-all duration-500" stroke="#AFAFAF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Establecidos por</th>
                    <th>Tipo de producto</th>
                    <th>Tipo de servicio</th>
                    <th>Nombre del país</th>
                    <th>Fee de agente</th>
                    <th>Tarifa de manejo</th>
                    <th>Tafica de documentos</th>
                    <th>Margen total</th>
                    <th>Fecha de vencimiento</th>
                    <th>Notas internas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($margins as $key => $margin)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $margin->user->name ?? 'Sin usuario' }} <br> {{ $margin->created_at->format('d/m/Y') }}</td>
                        <td>{{ $margin->product_type }}</td>
                        <td>{{ $margin->service_type }}</td>
                        <td>{{ $margin->country_name }}</td>
                        <td>{{ $margin->agent_fee }}</td>
                        <td>{{ $margin->handling_fee }}</td>
                        <td>{{ $margin->documentation_fee }}</td>
                        <td>{{ $margin->total_margin }}</td>
                        <td>
                            <span class="status {{ \Carbon\Carbon::parse($margin->expire_date)->isPast() ? 'status-inactive' : 'status-active' }}">
                                {{ \Carbon\Carbon::parse($margin->expire_date)->isPast() ? 'Expirado' : 'Vigente' }}
                            </span>
                        </td>
                        <td>{{ $margin->internal_notes }}</td>

                        <td>
                            <div class="flex gap-5">
                                <div class="cursor-pointer" @click="modalView = true" wire:click="editMargin({{ $margin->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <g clip-path="url(#clip0_807_2874)">
                                            <path d="M2.11342 8.47537C2.02262 8.33161 1.97723 8.25973 1.95182 8.14886C1.93273 8.06559 1.93273 7.93425 1.95182 7.85097C1.97723 7.74011 2.02262 7.66823 2.11341 7.52447C2.86369 6.33648 5.09693 3.33325 8.50027 3.33325C11.9036 3.33325 14.1369 6.33648 14.8871 7.52447C14.9779 7.66823 15.0233 7.74011 15.0487 7.85097C15.0678 7.93425 15.0678 8.06559 15.0487 8.14886C15.0233 8.25973 14.9779 8.33161 14.8871 8.47537C14.1369 9.66336 11.9036 12.6666 8.50027 12.6666C5.09693 12.6666 2.86369 9.66336 2.11342 8.47537Z" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.50027 9.99992C9.60484 9.99992 10.5003 9.10449 10.5003 7.99992C10.5003 6.89535 9.60484 5.99992 8.50027 5.99992C7.3957 5.99992 6.50027 6.89535 6.50027 7.99992C6.50027 9.10449 7.3957 9.99992 8.50027 9.99992Z" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_807_2874">
                                                <rect width="16" height="16" fill="white" transform="translate(0.5)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>

                                <div class="cursor-pointer" @click="modalEdit = true" wire:click="editMargin({{ $margin->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <g clip-path="url(#clip0_807_1182)">
                                            <path d="M7.8335 2.66666H5.0335C3.91339 2.66666 3.35334 2.66666 2.92552 2.88464C2.54919 3.07639 2.24323 3.38235 2.05148 3.75867C1.8335 4.1865 1.8335 4.74655 1.8335 5.86666V11.4667C1.8335 12.5868 1.8335 13.1468 2.05148 13.5746C2.24323 13.951 2.54919 14.2569 2.92552 14.4487C3.35334 14.6667 3.91339 14.6667 5.0335 14.6667H10.6335C11.7536 14.6667 12.3137 14.6667 12.7415 14.4487C13.1178 14.2569 13.4238 13.951 13.6155 13.5746C13.8335 13.1468 13.8335 12.5868 13.8335 11.4667V8.66666M5.83348 10.6667H6.94984C7.27596 10.6667 7.43902 10.6667 7.59247 10.6298C7.72852 10.5972 7.85858 10.5433 7.97788 10.4702C8.11243 10.3877 8.22773 10.2724 8.45833 10.0418L14.8335 3.66666C15.3858 3.11437 15.3858 2.21894 14.8335 1.66666C14.2812 1.11437 13.3858 1.11437 12.8335 1.66665L6.45832 8.04182C6.22772 8.27242 6.11241 8.38772 6.02996 8.52228C5.95685 8.64157 5.90298 8.77163 5.87032 8.90768C5.83348 9.06113 5.83348 9.22419 5.83348 9.55031V10.6667Z" stroke="#4D4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_807_1182">
                                                <rect width="16" height="16" fill="white" transform="translate(0.5)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="showModal" class="relative z-[9999]" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showModal = false" aria-hidden="true"></div>

        <!-- Contenido del modal -->
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Panel del modal -->
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[800px] sm:p-6"  @click.away="showModal = false">
                    <div>
                        <form wire:submit.prevent="save">
                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Tipo de producto</label>
                                    <input type="text" id="product_type" wire:model="product_type" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('product_type')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="service_type" class="block text-sm font-medium text-gray-700">Tipo de servicio</label>
                                    <input type="text" id="service_type" wire:model="service_type" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('service_type')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="country_name" class="block text-sm font-medium text-gray-700">Nombre del país</label>
                                    <input type="text" id="country_name" wire:model="country_name" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('country_name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="port_cfs_airport_name" class="block text-sm font-medium text-gray-700">Nombre del puerto/CFS/aeropuerto</label>
                                    <input type="text" id="port_cfs_airport_name" wire:model="port_cfs_airport_name" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="supplier" class="block text-sm font-medium text-gray-700">Proveedor</label>
                                    <input type="text" id="supplier" wire:model="supplier" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="agent_fee" class="block text-sm font-medium text-gray-700">Tarifa del agente</label>
                                    <input type="number" id="agent_fee" wire:model="agent_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="handling_fee" class="block text-sm font-medium text-gray-700">Tarifa de manejo</label>
                                    <input type="number" id="handling_fee" wire:model="handling_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="documentation_fee" class="block text-sm font-medium text-gray-700">Tarifa de documentación</label>
                                    <input type="number" id="documentation_fee" wire:model="documentation_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="total_margin" class="block text-sm font-medium text-gray-700">Margen total</label>
                                    <input type="number" id="total_margin" wire:model="total_margin" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                <div>
                                    <label for="effective_date" class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                                    <input type="date" id="effective_date" wire:model="effective_date" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="expire_date" class="block text-sm font-medium text-gray-700">Fecha de vencimiento</label>
                                    <input type="date" id="expire_date" wire:model="expire_date" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                <div>
                                    <label for="internal_notes" class="block text-sm font-medium text-gray-700">Notas internas</label>
                                    <textarea id="internal_notes" wire:model="internal_notes" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                </div>

                                <div>
                                    <label for="external_notes" class="block text-sm font-medium text-gray-700">Notas externas</label>
                                    <textarea id="external_notes" wire:model="external_notes" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                </div>
                            </div>

                            <!-- Botón de envío -->
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                                    Crear
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="modalUpload" class="relative z-[9999]" aria-labelledby="Upload Margenes" role="dialog" aria-modal="true" x-cloak>
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="modalUpload = false" aria-hidden="true"></div>

        <!-- Contenido del modal -->
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Panel del modal -->
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[500px] sm:p-6"  @click.away="modalUpload = false">
                    <div>
                        <div class="px-2 sm:px-2 lg:px-2">
                            <div class="flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <div class="col-span-full">
                                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                                <div class="text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="104" height="104" viewBox="0 0 104 104" fill="none" class="mx-auto h-[100px] w-[100px] text-gray-300">
                                                        <path d="M54.1667 8.66666H65.8667C73.1473 8.66666 76.7877 8.66666 79.5685 10.0836C82.0146 11.3299 84.0034 13.3187 85.2497 15.7648C86.6667 18.5456 86.6667 22.186 86.6667 29.4667V74.5333C86.6667 81.814 86.6667 85.4543 85.2497 88.2352C84.0034 90.6813 82.0146 92.6701 79.5685 93.9164C76.7877 95.3333 73.1473 95.3333 65.8667 95.3333H38.1333C30.8526 95.3333 27.2123 95.3333 24.4315 93.9164C21.9853 92.6701 19.9966 90.6813 18.7502 88.2352C17.3333 85.4543 17.3333 81.814 17.3333 74.5333V71.5M69.3333 56.3333H49.8333M69.3333 39H54.1667M69.3333 73.6667H34.6667M26 43.3333V19.5C26 15.9101 28.9101 13 32.5 13C36.0899 13 39 15.9101 39 19.5V43.3333C39 50.513 33.1797 56.3333 26 56.3333C18.8203 56.3333 13 50.513 13 43.3333V26" stroke="#565AFF" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <div class="mt-4 flex justify-center text-sm leading-6 text-gray-600">
                                                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                            <span class="block text-center">Subir Archivo CSV</span>
                                                            <input id="file-upload" name="file-upload" type="file" class="sr-only" wire:model="csv">
                                                        </label>
                                                    </div>
                                                    @if ($csvName)
                                                        <p class="text-xs leading-5 text-gray-600">Archivo seleccionado: <span class="font-semibold">{{ $csvName }}</p>
                                                    @endif

                                                    @if($uploading)
                                                        <div class="mt-4 flex justify-center">
                                                            <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-12 w-12"></div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex justify-center gap-5">
                                                <a class="mt-4 bg-[#565AFF] text-white px-4 py-2 rounded inline-block cursor-pointer" @click="modalUpload = false">Cancelar</a>
                                                <a wire:click="uploadMargins" class="mt-4 bg-[#565AFF] text-white px-4 py-2 rounded inline-block cursor-pointer">Cargar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="modalEdit" class="relative z-[9999]" aria-labelledby="Upload Margenes" role="dialog" aria-modal="true" x-cloak>
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="modalEdit = false" aria-hidden="true"></div>

        <!-- Contenido del modal -->
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Panel del modal -->
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[800px] sm:p-6"  @click.away="modalEdit = false">
                    <div>
                        <div>
                            <form wire:submit.prevent="save">
                                <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                    <div>
                                        <label for="product_type" class="block text-sm font-medium text-gray-700">Tipo de producto</label>
                                        <input type="text" id="product_type" wire:model="product_type" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                        <x-input-error :messages="$errors->get('product_type')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="service_type" class="block text-sm font-medium text-gray-700">Tipo de servicio</label>
                                        <input type="text" id="service_type" wire:model="service_type" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                        <x-input-error :messages="$errors->get('service_type')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="country_name" class="block text-sm font-medium text-gray-700">Nombre del país</label>
                                        <input type="text" id="country_name" wire:model="country_name" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                        <x-input-error :messages="$errors->get('country_name')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                    <div>
                                        <label for="port_cfs_airport_name" class="block text-sm font-medium text-gray-700">Nombre del puerto/CFS/aeropuerto</label>
                                        <input type="text" id="port_cfs_airport_name" wire:model="port_cfs_airport_name" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="supplier" class="block text-sm font-medium text-gray-700">Proveedor</label>
                                        <input type="text" id="supplier" wire:model="supplier" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="agent_fee" class="block text-sm font-medium text-gray-700">Tarifa del agente</label>
                                        <input type="number" id="agent_fee" wire:model="agent_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                    <div>
                                        <label for="handling_fee" class="block text-sm font-medium text-gray-700">Tarifa de manejo</label>
                                        <input type="number" id="handling_fee" wire:model="handling_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="documentation_fee" class="block text-sm font-medium text-gray-700">Tarifa de documentación</label>
                                        <input type="number" id="documentation_fee" wire:model="documentation_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="total_margin" class="block text-sm font-medium text-gray-700">Margen total</label>
                                        <input type="number" id="total_margin" wire:model="total_margin" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                    <div>
                                        <label for="effective_date" class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                                        <input type="date" id="effective_date" wire:model="effective_date" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="expire_date" class="block text-sm font-medium text-gray-700">Fecha de vencimiento</label>
                                        <input type="date" id="expire_date" wire:model="expire_date" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                    <div>
                                        <label for="internal_notes" class="block text-sm font-medium text-gray-700">Notas internas</label>
                                        <textarea id="internal_notes" wire:model="internal_notes" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>

                                    <div>
                                        <label for="external_notes" class="block text-sm font-medium text-gray-700">Notas externas</label>
                                        <textarea id="external_notes" wire:model="external_notes" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>

                                <!-- Botón de envío -->
                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                                        Actualizar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="modalView" class="relative z-[9999]" aria-labelledby="Upload Margenes" role="dialog" aria-modal="true" x-cloak>
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="modalView = false" aria-hidden="true"></div>

        <!-- Contenido del modal -->
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Panel del modal -->
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[800px] sm:p-6"  @click.away="modalView = false">
                    <div>
                        <div>
                            <form wire:submit.prevent="save">
                                <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                    <div>
                                        <label for="product_type" class="block text-sm font-medium text-gray-700">Tipo de producto</label>
                                        <input type="text" id="product_type" wire:model="product_type" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                        <x-input-error :messages="$errors->get('product_type')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="service_type" class="block text-sm font-medium text-gray-700">Tipo de servicio</label>
                                        <input type="text" id="service_type" wire:model="service_type" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                        <x-input-error :messages="$errors->get('service_type')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="country_name" class="block text-sm font-medium text-gray-700">Nombre del país</label>
                                        <input type="text" id="country_name" wire:model="country_name" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                        <x-input-error :messages="$errors->get('country_name')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                    <div>
                                        <label for="port_cfs_airport_name" class="block text-sm font-medium text-gray-700">Nombre del puerto/CFS/aeropuerto</label>
                                        <input type="text" id="port_cfs_airport_name" wire:model="port_cfs_airport_name" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="supplier" class="block text-sm font-medium text-gray-700">Proveedor</label>
                                        <input type="text" id="supplier" wire:model="supplier" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="agent_fee" class="block text-sm font-medium text-gray-700">Tarifa del agente</label>
                                        <input type="number" id="agent_fee" wire:model="agent_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                    <div>
                                        <label for="handling_fee" class="block text-sm font-medium text-gray-700">Tarifa de manejo</label>
                                        <input type="number" id="handling_fee" wire:model="handling_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="documentation_fee" class="block text-sm font-medium text-gray-700">Tarifa de documentación</label>
                                        <input type="number" id="documentation_fee" wire:model="documentation_fee" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="total_margin" class="block text-sm font-medium text-gray-700">Margen total</label>
                                        <input type="number" id="total_margin" wire:model="total_margin" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                    <div>
                                        <label for="effective_date" class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                                        <input type="date" id="effective_date" wire:model="effective_date" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="expire_date" class="block text-sm font-medium text-gray-700">Fecha de vencimiento</label>
                                        <input type="date" id="expire_date" wire:model="expire_date" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                    <div>
                                        <label for="internal_notes" class="block text-sm font-medium text-gray-700">Notas internas</label>
                                        <textarea id="internal_notes" wire:model="internal_notes" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>

                                    <div>
                                        <label for="external_notes" class="block text-sm font-medium text-gray-700">Notas externas</label>
                                        <textarea id="external_notes" wire:model="external_notes" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
