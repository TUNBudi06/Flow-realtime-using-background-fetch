<h1 class="text-2xl font-bold">Dashboard Production</h1>
<span class="text-sm text-gray-500">List of tractor (last refreshed: <span id="last_scanned"></span>)</span>

<div class="mt-8 w-full">
    <div class="bg-[#D0E3C4] dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="tractorTable" class="w-full display" style="width:100%">
                <thead>
                <tr class="bg-[#ADC698] dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#1A5E63] dark:text-gray-200 uppercase tracking-wider">No Tractor</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#1A5E63] dark:text-gray-200 uppercase tracking-wider">ID Tractor</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#1A5E63] dark:text-gray-200 uppercase tracking-wider">Keterangan</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#1A5E63] dark:text-gray-200 uppercase tracking-wider">Foto Tractor</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#1A5E63] dark:text-gray-200 uppercase tracking-wider">User Upload / NIK</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-[#1A5E63] dark:text-gray-200 uppercase tracking-wider">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <!-- Data will be rendered by DataTables -->
                </tbody>
            </table>
        </div>
    </div>
    <livewire:production.tablelist />
</div>
