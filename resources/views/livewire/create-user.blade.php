<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create new staff member') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-white p-6 rounded shadow mt-4">
                    <form wire:submit.prevent="create" method="POST">
                        @csrf
                        <div class="flex flex-col">
                            <div class="sm:w-3/4 grid grid-cols-1 gap-2">
                                <label class="block mb-0">
                                    <span class="text-gray-700">Name</span>
                                </label>
                                    <input
                                        wire:model="name"
                                        placeholder="John Doe..."
                                        class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                        type="text">
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                <label class="block">
                                    <span class="text-gray-700">Email</span>
                                </label>
                                    <input
                                        wire:model="email"
                                        placeholder="john@doe.com"
                                        class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                        type="text">
                                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                                <label class="block">
                                    <span class="text-gray-700">Role</span>
                                </label>
                                <select 
                                    wire:model="role"
                                    class="block appearance-none w-full bg-gray-200 border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option>-Select-</option>
                                    <option value="admin">Admin</option>
                                    <option value="normal">Normal</option>
                                  </select>
                                    @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
                                <label class="block">
                                    <span class="text-gray-700">Password</span>
                                </label>
                                    <input
                                    type="password"
                                    wire:model="password"
                                    class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                    type="text">
                                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                                <label class="block">
                                    <span class="text-gray-700">Password confirmation</span>
                                </label>
                                    <input
                                    type="password"
                                    wire:model="password_confirmation"
                                    class="form-input bg-gray-200 border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                    type="text">
                                @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-2">
                                <button class="mt-2 mr-2 px-3 py-1 bg-indigo-500 hover:bg-indigo-600 text-white font-medium rounded" type="submit">
                                    {{ __('Save') }}
                                </button>
                            </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>