<h1 class="text-2xl font-bold">Dashboard Production</h1>
<span class="text-sm text-gray-500">List of tractor (last refreshed: <span id="last_scanned"></span>)</span>

<div class="mt-8 w-full">
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="tractorTable" class="w-full display" style="width:100%">
                <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">No Tractor</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID Tractor</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Keterangan</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Foto Tractor</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">User Upload / NIK</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Data will be rendered by DataTables -->
                </tbody>
            </table>
        </div>
    </div>
    <livewire:production.tablelist />
</div>
