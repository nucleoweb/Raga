<div class="page-wrapper" x-data="{ showModal: false }">
    <div>
        <h1>Lista de tarifas</h1>

        <div class="mb-[35px] flex gap-10">
            <div>
                <input type="text" placeholder="Search" class="search-input" wire:model.live="search">
            </div>

            <div class="flex gap-5 hidden">
                <span class="label">
                    Etiqueta

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17 7L7 17M7 7L17 17" stroke="#7288FF" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </span>

                    <span class="label">
                    Etiqueta

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M17 7L7 17M7 7L17 17" stroke="#7288FF" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </span>

                <button @click="showModal = true" class="bg-indigo-600 text-white px-4 py-2 rounded h-[42px]">
                    Crear Port Charge
                </button>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <div class="flex items-center gap-5">
                <a href="{{ route('land-charges') }}" class="text-[18px] text-[#2E2E2E] font-bold pb-[11px] mb-[40px] inline-block  relative cursor-pointer">Land charges</a>
                <a href="{{ route('port-charges') }}" class="text-[18px] text-[#190FDB] font-bold pb-[11px] mb-[40px] border-b-[2px] inline-block  border-[#190FDB] relative cursor-pointer">Port Charges</a>
            </div>

            <div class="flex justify-end items-center gap-2 mb-5">
                <div class="flex justify-center items-center border-[3px] border-[#C2C2C2] hover:border-[#565AFF] rounded-[6px] h-[46px] w-[46px] group transition-all duration-500 cursor-pointer">
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

        <div class="flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full table-fixed divide-y divide-gray-300 border-2 border-[#E0E5FF]">
                        <thead class="bg-[#F2F4F8]">
                            <tr class="px-5">
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Product Type</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-[18%]">Service Type</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">POD</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Carrier</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Supplier Charge Name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Calculation Rule</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cost</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Effective Date</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Expire Date</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">External Notes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($portCharges as $portCharge)
                                <tr>
                                    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900">{{ $portCharge->product_type }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->service_type }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->pod }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->carrier }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->supplier_charge_name }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->calculation_rule }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->cost }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->effective_date }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->expire_date }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $portCharge->external_notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div x-show="showModal" class="relative z-[9999]" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showModal = false" aria-hidden="true"></div>

        <!-- Contenido del modal -->
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Panel del modal -->
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[800px] sm:p-6"  @click.away="showModal = false">
                    <div>
                        <form wire:submit="save">
                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Tipo de producto</label>
                                    <select id="product_type" wire:model="product_type" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 pl-3 pr-10 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                        <option>Selecciona un tipo</option>
                                        <option value="FCL">FCL</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('product_type')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="service_type" class="block text-sm font-medium text-gray-700">Tipo de servicio</label>
                                    <select id="service_type" wire:model="service_type"  class="mt-2 block w-full rounded-md border-gray-300 py-1.5 pl-3 pr-10 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                        <option>Selecciona un tipo</option>
                                        <option value="IMPO">IMPO</option>
                                        <option value="EXPO">EXPO</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('service_type')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Ciudad origen</label>
                                    <input type="text" id="city_origin" wire:model="origin_country"  class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('origin_country')" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">POL</label>
                                    <input type="text" id="city_origin" wire:model="pol" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">POD</label>
                                    <input type="text" id="city_origin" wire:model="pod" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Ciudad de destino</label>
                                    <input type="text" id="city_origin" wire:model="dest_country" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Carrier</label>
                                    <input type="text" id="city_origin" wire:model="carrier" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Nombre carga proveedor</label>
                                    <input type="text" id="city_origin" wire:model="supplier_charge_name" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('supplier_charge_name')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Costos</label>
                                    <input type="number" id="city_origin" wire:model="cost" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Moneda</label>
                                    <input type="text" id="city_origin" wire:model="currency" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">tipo de mercancía</label>
                                    <input type="text" id="city_origin" wire:model="goodstype" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Fecha de creación</label>
                                    <input type="date" id="city_origin" wire:model="effective_date" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Fecha de vencimiento</label>
                                    <input type="date" id="city_origin" wire:model="expire_date" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Tasa de venta</label>
                                    <input type="number" id="city_origin" wire:model="sell_rate" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Notas internas</label>
                                    <input type="text" id="city_origin" wire:model="internal_notes" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Notas extrernas</label>
                                    <input type="text" id="city_origin" wire:model="external_notes" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Peso minimo</label>
                                    <input type="text" id="city_origin" wire:model="min_weight" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Peso Maximo</label>
                                    <input type="text" id="city_origin" wire:model="max_weight" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Tamaño minimo</label>
                                    <input type="number" id="city_origin" wire:model="min_size" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">tamaño maximo</label>
                                    <input type="text" id="city_origin" wire:model="max_size" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
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
</div>
