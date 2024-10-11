<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div>
            <div class="relative z-50 hidden" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-900/80" aria-hidden="true"></div>
                <div class="fixed inset-0 flex">
                    <div class="relative mr-16 flex w-full max-w-xs flex-1">
                        <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                            <button type="button" class="-m-2.5 p-2.5">
                                <span class="sr-only">Cerrar sidebar</span>
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Sidebar component, swap this element with another sidebar if you like -->
                        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
                            <div class="flex h-16 shrink-0 items-center">
                                <img class="h-8 w-auto" src="{{ asset('img/dashboard_logo.png') }}" alt="Raga AI">
                            </div>
                            <nav class="flex flex-1 flex-col">
                                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                    <li>
                                        <ul role="list" class="-mx-2 space-y-1">
                                            <li>
                                                <!-- Current: "bg-gray-50 text-indigo-600", Default: "text-gray-700 hover:text-indigo-600 hover:bg-gray-50" -->
                                                <a href="#" class="group flex gap-x-3 rounded-md bg-gray-50 p-2 text-sm font-semibold leading-6 text-indigo-600">
                                                    <svg class="h-6 w-6 shrink-0 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                                    </svg>
                                                    Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                    </svg>
                                                    Team
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                                    </svg>
                                                    Projects
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                    </svg>
                                                    Calendar
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                                    </svg>
                                                    Documents
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                                    </svg>
                                                    Reports
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="mt-auto">
                                        <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                            <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Settings
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Static sidebar for desktop -->
            <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-[#F7F7F7] px-6 pb-4">
                    <div class="flex h-[100px] shrink-0 items-center justify-center">
                        <a href="/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="157" height="53" viewBox="0 0 157 53" fill="none">
                                <g clip-path="url(#clip0_2001_7199)">
                                    <path d="M61.386 40.1843H64.6212L56.5549 28.9998L57.5325 28.7766C60.832 28.0261 62.8812 25.418 62.8812 21.9699C62.8812 20.5463 62.513 17.9066 60.0436 16.2282C58.5137 15.1843 56.6625 14.7783 53.4394 14.7783H49.3828V40.1843H52.1075V29.2405H53.8198L61.3843 40.1843H61.386ZM52.1075 17.2159H54.1514C59.2448 17.2159 60.3145 19.8223 60.3145 22.0103C60.3145 25.1632 57.9667 27.0455 54.0316 27.0455H52.1075V17.2159Z" fill="#0C0C0C"/>
                                    <path d="M84.1283 33.731L86.9017 40.1844H89.8121L78.2969 14.1458L66.1982 40.1844H69.0948L71.9862 33.731H84.1301H84.1283ZM78.165 19.8575L83.0795 31.2125H73.0508L78.165 19.8575Z" fill="#0C0C0C"/>
                                    <path d="M103.178 27.6062V30.0438H109.826L109.749 30.7784C109.55 32.6976 108.76 34.3127 107.336 35.7152C105.573 37.4568 103.552 38.2688 100.976 38.2688C98.0101 38.2688 95.6901 37.3215 93.8823 35.3724C92.0311 33.3724 90.9718 30.5623 90.9718 27.6607C90.9718 24.5763 92.0954 21.5992 93.9761 19.6941C95.3098 18.3426 97.6837 16.7327 101.412 16.7327C103.378 16.7327 105.017 17.144 106.422 17.9893C107.474 18.5886 108.586 19.5781 109.473 20.6941L111.634 19.1563C110.92 18.1668 109.758 16.9313 107.94 15.8944C106.115 14.8645 103.781 14.2969 101.37 14.2969C97.7549 14.2969 94.214 15.7204 91.8974 18.1071C89.6086 20.4234 88.2437 23.9788 88.2437 27.622C88.2437 31.2652 89.5704 34.7468 91.979 37.26C94.2904 39.6747 96.8379 40.7064 100.499 40.7064C104.159 40.7064 106.827 39.6536 109.032 37.4867C111.38 35.1826 112.66 31.7731 112.748 27.6062H103.176H103.178Z" fill="#0C0C0C"/>
                                    <path d="M128.775 33.731L131.549 40.1844H134.459L122.944 14.1458L110.845 40.1844H113.742L116.633 33.731H128.777H128.775ZM122.81 19.8575L127.725 31.2125H117.696L122.81 19.8575Z" fill="#0C0C0C"/>
                                    <path d="M40.7608 44.4919C41.551 43.6272 42.2821 42.7063 42.9524 41.7415C41.2644 36.3091 38.3574 31.3127 34.3581 27.1035C38.4373 22.5394 41.3773 17.1826 43.0479 11.3935C42.3706 10.4093 41.6326 9.47259 40.8338 8.5921C39.4358 14.6642 36.5601 20.2863 32.3836 25.0121C26.3039 18.1299 22.9748 9.34254 22.9644 0.0384982C22.1187 -0.00719604 21.2643 -0.0142259 20.4012 0.0226809C20.2901 0.0279533 20.1824 0.0402556 20.0713 0.045528C20.0591 9.34605 16.7319 18.1299 10.6521 25.0086C6.48262 20.2916 3.61033 14.68 2.21066 8.62022C1.41183 9.50423 0.675526 10.4445 0 11.4304C1.67232 17.2055 4.60713 22.5482 8.67765 27.1018C4.68875 31.3039 1.7852 36.2863 0.097248 41.7046C0.767565 42.6712 1.49866 43.5903 2.28707 44.455C3.71279 38.7661 6.5573 33.5288 10.6521 29.1896C16.7249 35.6255 20.0609 44.0315 20.0713 52.9594C20.9292 53.0069 21.7975 53.0139 22.6744 52.9752C22.7717 52.9717 22.8672 52.9612 22.9644 52.9559C22.9766 44.0297 26.3125 35.6237 32.3836 29.1896C36.4871 33.5394 39.3368 38.7907 40.7591 44.4937L40.7608 44.4919ZM21.5179 42.7239C19.8855 36.912 16.8656 31.5657 12.6266 27.1035C16.8691 22.3566 19.8872 16.7555 21.5179 10.6993C23.1485 16.7555 26.1667 22.3566 30.4091 27.1035C26.1701 31.5657 23.1485 36.912 21.5179 42.7239Z" fill="url(#paint0_linear_2001_7199)"/>
                                    <path d="M142.763 31.9263H135.513V34.6222H142.763V31.9263Z" fill="#0C0C0C"/>
                                    <path d="M154.006 40.0703H157L151.304 32.7663L156.161 26.645H153.11L149.805 31.0211L146.535 26.645H143.602L148.31 32.7751L148.267 32.8278L142.428 40.0703H145.478L149.812 34.5607L154.006 40.0703Z" fill="#0C0C0C"/>
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_2001_7199" x1="-5.75153" y1="54.1229" x2="44.1623" y2="4.80253" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white"/>
                                        <stop offset="0.01" stop-color="#F2FDFE"/>
                                        <stop offset="0.09" stop-color="#A0F1F8"/>
                                        <stop offset="0.15" stop-color="#6DE9F5"/>
                                        <stop offset="0.17" stop-color="#5AE7F4"/>
                                        <stop offset="0.2" stop-color="#5AE1F4"/>
                                        <stop offset="0.23" stop-color="#5BD0F5"/>
                                        <stop offset="0.27" stop-color="#5DB5F8"/>
                                        <stop offset="0.31" stop-color="#6090FB"/>
                                        <stop offset="0.35" stop-color="#6367FF"/>
                                        <stop offset="0.4" stop-color="#5556F8"/>
                                        <stop offset="0.49" stop-color="#312BE6"/>
                                        <stop offset="0.55" stop-color="#190FDB"/>
                                        <stop offset="0.62" stop-color="#4922B9"/>
                                        <stop offset="0.72" stop-color="#853B90"/>
                                        <stop offset="0.81" stop-color="#B54E6F"/>
                                        <stop offset="0.89" stop-color="#D75C57"/>
                                        <stop offset="0.95" stop-color="#EC6449"/>
                                        <stop offset="1" stop-color="#F46844"/>
                                    </linearGradient>
                                    <clipPath id="clip0_2001_7199">
                                        <rect width="157" height="53" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>

                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col justify-between gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="group flex gap-x-3 rounded-md p-2 text-[16px]  leading-6 text-[#7288FF] hover:bg-gray-50 hover:text-indigo-600 items-center">
                                        <a href="{{ route('dashboard') }}" class="group flex gap-x-3 rounded-md p-2 text-[16px]  leading-6 text-[#7288FF] hover:bg-gray-50 hover:text-indigo-600 items-center">
                                            <div class="flex border-2 border-[#7288FF] rounded-full p-[10px]">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 3H16.2C17.8802 3 18.7202 3 19.362 3.32698C19.9265 3.6146 20.3854 4.07354 20.673 4.63803C21 5.27976 21 6.11984 21 7.8V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V12M8 13V17M16 11V17M12 7V17M2 5L5 2M5 2L8 5M5 2L5 8" stroke="#7288FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            Lista de  margenes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users') }}" class="group flex gap-x-3 rounded-md p-2 text-[16px]  leading-6 text-[#7288FF] hover:bg-gray-50 hover:text-indigo-600 items-center">
                                        <a href="{{ route('users') }}" class="group flex gap-x-3 rounded-md p-2 text-[16px]  leading-6 text-[#7288FF] hover:bg-gray-50 hover:text-indigo-600 items-center">
                                            <div class="flex border-2 border-[#7288FF] rounded-full p-[10px]">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M9 15.5H7.5C6.10444 15.5 5.40665 15.5 4.83886 15.6722C3.56045 16.06 2.56004 17.0605 2.17224 18.3389C2 18.9067 2 19.6044 2 21M14.5 7.5C14.5 9.98528 12.4853 12 10 12C7.51472 12 5.5 9.98528 5.5 7.5C5.5 5.01472 7.51472 3 10 3C12.4853 3 14.5 5.01472 14.5 7.5ZM11 21L14.1014 20.1139C14.2499 20.0715 14.3241 20.0502 14.3934 20.0184C14.4549 19.9902 14.5134 19.9558 14.5679 19.9158C14.6293 19.8707 14.6839 19.8161 14.7932 19.7068L21.25 13.25C21.9404 12.5597 21.9404 11.4403 21.25 10.75C20.5597 10.0596 19.4404 10.0596 18.75 10.75L12.2932 17.2068C12.1839 17.3161 12.1293 17.3707 12.0842 17.4321C12.0442 17.4866 12.0098 17.5451 11.9816 17.6066C11.9497 17.6759 11.9285 17.7501 11.8861 17.8987L11 21Z" stroke="#7288FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            Configuraciones de usuario
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('land-charges') }}" class="group flex gap-x-3 rounded-md p-2 text-[16px]  leading-6 text-[#7288FF] hover:bg-gray-50 hover:text-indigo-600 items-center">
                                        <a href="{{ route('land-charges') }}" class="group flex gap-x-3 rounded-md p-2 text-[16px]  leading-6 text-[#7288FF] hover:bg-gray-50 hover:text-indigo-600 items-center">
                                            <div class="flex border-2 border-[#7288FF] rounded-full p-[10px]">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M21 12L9 12M21 6L9 6M21 18L9 18M5 12C5 12.5523 4.55228 13 4 13C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11C4.55228 11 5 11.4477 5 12ZM5 6C5 6.55228 4.55228 7 4 7C3.44772 7 3 6.55228 3 6C3 5.44772 3.44772 5 4 5C4.55228 5 5 5.44772 5 6ZM5 18C5 18.5523 4.55228 19 4 19C3.44772 19 3 18.5523 3 18C3 17.4477 3.44772 17 4 17C4.55228 17 5 17.4477 5 18Z" stroke="#7288FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>

                                            Lista de tarifas
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <div class="flex flex-col items-start justify-start">
                                <li class="mt-auto">
                                    <a href="{{ route('configs') }}" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm  leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                    <a href="{{ route('configs') }}" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm  leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-indigo-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                                        </svg>

                                        Prompts
                                    </a>
                                </li>

                                <li class="mt-auto">
                                    <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm  leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                    <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm  leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 shrink-0 text-gray-400 group-hover:text-indigo-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                        </svg>

                                        Cerrar sesión
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="lg:pl-72">
                <livewire:layout.navigation />

                <main class="py-10">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
