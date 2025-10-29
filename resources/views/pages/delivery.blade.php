<x-sidebar>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Delivery</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Delivery Management System</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Delivery Overview</h2>
        </div>

        <!-- Content here -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">Total Deliveries</h3>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-300 mt-2">156</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-green-900 dark:text-green-100">Delivered</h3>
                <p class="text-3xl font-bold text-green-600 dark:text-green-300 mt-2">142</p>
            </div>
            <div class="bg-yellow-50 dark:bg-yellow-900 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-yellow-900 dark:text-yellow-100">In Transit</h3>
                <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-300 mt-2">12</p>
            </div>
            <div class="bg-red-50 dark:bg-red-900 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-red-900 dark:text-red-100">Pending</h3>
                <p class="text-3xl font-bold text-red-600 dark:text-red-300 mt-2">2</p>
            </div>
        </div>

        <!-- Delivery Table -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Recent Deliveries</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Delivery ID</th>
                            <th scope="col" class="px-6 py-3">Product</th>
                            <th scope="col" class="px-6 py-3">Destination</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">DLV-001</td>
                            <td class="px-6 py-4">Tractor TR-001</td>
                            <td class="px-6 py-4">Jakarta</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 bg-green-100 text-green-800 rounded">Delivered</span></td>
                            <td class="px-6 py-4">2024-01-15</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">DLV-002</td>
                            <td class="px-6 py-4">Tractor TR-002</td>
                            <td class="px-6 py-4">Surabaya</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">In Transit</span></td>
                            <td class="px-6 py-4">2024-01-16</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-sidebar>
<x-sidebar>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Inspection</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Quality Inspection Management System</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Inspection Overview</h2>
        </div>

        <!-- Content here -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">Total Inspections</h3>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-300 mt-2">85</p>
            </div>
            <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-green-900 dark:text-green-100">Passed</h3>
                <p class="text-3xl font-bold text-green-600 dark:text-green-300 mt-2">78</p>
            </div>
            <div class="bg-red-50 dark:bg-red-900 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-red-900 dark:text-red-100">Failed</h3>
                <p class="text-3xl font-bold text-red-600 dark:text-red-300 mt-2">7</p>
            </div>
        </div>

        <!-- Inspection Table -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Recent Inspections</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Product</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Inspector</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">INS-001</td>
                            <td class="px-6 py-4">Tractor TR-001</td>
                            <td class="px-6 py-4"><span class="px-2 py-1 bg-green-100 text-green-800 rounded">Passed</span></td>
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">2024-01-15</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-sidebar>

