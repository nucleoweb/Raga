<div>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	@if (session()->has('message'))
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class=" overflow-hidden">
				<div class="p-6 text-gray-900">
					<div class="px-4 sm:px-6 lg:px-8">
						<div class="rounded-md bg-green-50 p-4 mb-4">
							<div class="flex">
								<div class="flex-shrink-0">
									<svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
									</svg>
								</div>
								<div class="ml-3">
									<div class="text-sm text-green-700">
										<p>{{ session('message') }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-10">
				<div class="p-6 text-gray-900">
					<div class="px-4 sm:px-6 lg:px-8">
						<div class="sm:flex sm:items-center">
							<div class="sm:flex-auto">
								<h1 class="text-base font-semibold leading-6 text-gray-900">Upload Port Charges</h1>
							</div>
						</div>
						<div class="mt-8 flow-root">
							<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
								<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
									<div class="col-span-full">
										<input type="file"
										       name="image"
										       wire:model="csv"
										       id="small-file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4">
										<button wire:click="uploadPortCharges" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-10">
				<div class="p-6 text-gray-900">
					<div class="px-4 sm:px-6 lg:px-8">
						<div class="sm:flex sm:items-center">
							<div class="sm:flex-auto">
								<h1 class="text-base font-semibold leading-6 text-gray-900">Upload Land Charges</h1>
							</div>
						</div>
						<div class="mt-8 flow-root">
							<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
								<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
									<div class="col-span-full">
										<input type="file"
										       name="image"
										       wire:model="csv"
										       id="small-file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4">
										<button wire:click="uploadLandCharges" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-10">
				<div class="p-6 text-gray-900">
					<div class="px-4 sm:px-6 lg:px-8">
						<div class="sm:flex sm:items-center">
							<div class="sm:flex-auto">
								<h1 class="text-base font-semibold leading-6 text-gray-900">Upload Inland Merchant</h1>
							</div>
						</div>
						<div class="mt-8 flow-root">
							<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
								<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
									<div class="col-span-full">
										<input type="file"
										       name="image"
										       wire:model="csv"
										       id="small-file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4">
										<button wire:click="uploadInlandMerchant" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-10">
				<div class="p-6 text-gray-900">
					<div class="px-4 sm:px-6 lg:px-8">
						<div class="sm:flex sm:items-center">
							<div class="sm:flex-auto">
								<h1 class="text-base font-semibold leading-6 text-gray-900">Upload Margins</h1>
							</div>
						</div>
						<div class="mt-8 flow-root">
							<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
								<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
									<div class="col-span-full">
										<input type="file"
										       name="image"
										       wire:model="csv"
										       id="small-file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4">
										<button wire:click="uploadMargins" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
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
