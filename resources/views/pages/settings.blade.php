<x-sidebar>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Settings</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Application Settings & Configuration</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <!-- General Settings -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">General Settings</h2>
            <form class="space-y-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company Name</label>
                    <input type="text" value="ISEKI Flow" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" value="admin@iseki-flow.com" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time Zone</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option selected>Asia/Jakarta</option>
                        <option>Asia/Tokyo</option>
                        <option>UTC</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Notification Settings -->
        <div class="mb-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Notification Settings</h2>
            <div class="space-y-3">
                <div class="flex items-center">
                    <input id="email-notif" type="checkbox" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="email-notif" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email Notifications</label>
                </div>
                <div class="flex items-center">
                    <input id="system-notif" type="checkbox" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="system-notif" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">System Notifications</label>
                </div>
                <div class="flex items-center">
                    <input id="delivery-notif" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="delivery-notif" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivery Notifications</label>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="pt-4">
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Save Settings
            </button>
        </div>
    </div>
</x-sidebar>

