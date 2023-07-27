<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign A Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                @if ($errors->any())
                <div class="alert alert-danger bg-red-200 text-red-800 border border-red-800 rounded-md p-4 mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form method="POST" action="{{ route('users.assignRoleAndPermission', ['user' => $user->id]) }}">
                    @csrf
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="role" value="{{ $role->name }}" class="role-checkbox rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="ml-2">{{ $role->name }}</span>
                                    </label>
                                    <br>
                                    <div class="permissions-list hidden">
                                        @foreach($role->permissions as $permission)
                                            <span class="ml-2">{{ $permission->name }}</span>
                                            <br>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Update Role</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add JavaScript to handle the checkbox clicks -->
    <script>
        const roleCheckboxes = document.querySelectorAll('.role-checkbox');
        roleCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('click', () => {
                const permissionsList = checkbox.closest('td').querySelector('.permissions-list');
                permissionsList.classList.toggle('hidden', !checkbox.checked);
            });
        });
    </script>
</x-app-layout>




