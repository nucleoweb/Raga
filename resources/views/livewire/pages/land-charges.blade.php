<div class="page-wrapper" x-data="{ showModal: false }">
    <div>
        <h1>Land charges</h1>

        <div class="mb-[35px] flex gap-10">
            <div>
                <input type="text" placeholder="Search" class="search-input">
            </div>

            <div class="flex gap-5">
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
                    Crear Land Charge
                </button>
            </div>
        </div>

        <h3 class="text-[18px] text-[#190FDB] font-bold pb-[11px] mb-[40px] border-b-[2px] inline-block  border-[#190FDB] relative ">Land charges</h3>

        <div class="low-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full table-fixed divide-y divide-gray-300 border-2 border-[#E0E5FF]">
                        <thead class="bg-[#F2F4F8]">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Tipo de producto</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tipo de servicio</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Puerto de origen</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Transportista</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Transportistas habilitado</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tipo de cargo</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Costo</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Ciudad de destino</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fecha de creación</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fecha de vencimiento</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Notas externas</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tipo de costo</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($landCharges as $landCharge)
                                <tr>
                                    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900">{{ $landCharge->product_type }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->service_type }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->port_cfs_airport_name }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->trucker }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->allowed_carriers }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->supplier_charge_name }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->cost }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->unlocation_id }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->effective_date }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->expire_date }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->external_notes }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500">{{ $landCharge->charge_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                                    <input type="text" id="city_origin" wire:model="city_origin"  class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                    <x-input-error :messages="$errors->get('city_origin')" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Puerto de origen</label>
                                    <input type="text" id="city_origin" wire:model="port_cfs_airport_name" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Trucker</label>
                                    <input type="text" id="city_origin" wire:model="trucker" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Transportistas Permitidos</label>
                                    <input type="text" id="city_origin" wire:model="allowed_carriers" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Proveedor</label>
                                    <input type="text" id="city_origin" wire:model="supplier" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
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

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Costo minimo</label>
                                    <input type="text" id="city_origin" wire:model="min_cost" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Costo Máximo</label>
                                    <input type="text" id="city_origin" wire:model="max_cost" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Ubicación</label>
                                    <input type="text" id="city_origin" wire:model="unlocation_id" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">tipo de mercancía</label>
                                    <input type="text" id="city_origin" wire:model="goodstype" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

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

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Tipo de carga</label>
                                    <input type="text" id="city_origin" wire:model="charge_type" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="product_type" class="block text-sm font-medium text-gray-700">Peso minimo</label>
                                    <input type="text" id="city_origin" wire:model="min_weight" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label for="city_origin" class="block text-sm font-medium text-gray-700">Peso Maximo</label>
                                    <input type="text" id="city_origin" wire:model="max_weight" class="mt-2 block w-full rounded-md border-gray-300 py-1.5 text-gray-900 focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-5 items-center mb-5">
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
