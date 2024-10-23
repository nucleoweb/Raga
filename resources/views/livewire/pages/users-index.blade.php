<div class="page-wrapper" x-data="{ showModal: false, modalEdit: false, modalView: false }">
    <h1>Lista de usuario</h1>

    <div class="mb-[35px] flex gap-10">
        <div>
            <input type="text" placeholder="Search" class="search-input" wire:model.live="search">
        </div>
    </div>

    <div class="flex justify-between items-center">
        <div class="flex items-center gap-5">
            <a href="{{ route('users') }}" class="text-[18px] text-[#190FDB] font-bold pb-[11px] mb-[40px] border-b-[2px] inline-block  border-[#190FDB] relative cursor-pointer">Usuarios</a>
        </div>

        <div class="flex justify-end items-center gap-2 mb-5">
            <div class="flex justify-center items-center border-[3px]  border-[#565AFF] text-white hover:border-[#565AFF] bg-[#565AFF] hover:bg-[#565AFF] rounded-[6px] h-[46px] px-3 gap-2 group cursor-pointer duration-500" @click="showModal = true">
                Crear nuevo usuario

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 8V16M8 12H16M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" class="group-hover:stroke-[#F7F7F7] transition-all duration-500" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
    </div>

    <div>
        <table>
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                    <td>
                        <div class="flex gap-5">
                            <div class="cursor-pointer" @click="modalView = true" wire:click="editUser({{ $user->id }})">
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

                            <div class="cursor-pointer" @click="modalEdit = true" wire:click="editUser({{ $user->id }})">
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
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[600px] sm:p-6"  @click.away="showModal = false">
                    <div>
                        <form wire:submit="register">
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Contraseña')" />

                                <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                              type="password"
                                              name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Role')" />
                                <select
                                    id="selectRole"
                                    name="selectRole"
                                    defaultValue="Canada"
                                    wire:model.live="selectRole"
                                    class="mt-2 block w-full rounded-md border-[1px] py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6 h-[42px] border-[#9AABFF]">

                                    <option>Selecciona un role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Registrar') }}
                                </x-primary-button>
                            </div>
                        </form>
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
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[600px] sm:p-6"  @click.away="modalEdit = false">
                    <div>
                        <div>
                            <form wire:submit="update">
                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Nombre')" />
                                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Contraseña')" />

                                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                                  type="password"
                                                  name="password"
                                                  autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                                    <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                                  type="password"
                                                  name="password_confirmation" autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Role')" />
                                    <select
                                        id="selectRole"
                                        name="selectRole"
                                        defaultValue="Canada"
                                        wire:model.live="selectRole"
                                        class="mt-2 block w-full rounded-md border-[1px] py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6 h-[42px] border-[#9AABFF]">

                                        <option>Selecciona un role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ms-4">
                                        {{ __('Registrar') }}
                                    </x-primary-button>
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
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[600px] sm:p-6"  @click.away="modalView = false">
                    <div>
                        <div>
                            <form>
                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Nombre')" />
                                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Contraseña')" />

                                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                                  type="password"
                                                  name="password"
                                                  required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                                    <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                                  type="password"
                                                  name="password_confirmation" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Role')" />
                                    <select
                                        id="selectRole"
                                        name="selectRole"
                                        defaultValue="Canada"
                                        wire:model.live="selectRole"
                                        class="mt-2 block w-full rounded-md border-[1px] py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6 h-[42px] border-[#9AABFF]">

                                        <option>Selecciona un role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
