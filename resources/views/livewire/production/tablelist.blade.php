<?php

use Livewire\Volt\Component;

new class extends Component {
    public $dataTractor = null;
    public $countTractor = [0,0,0];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        // Reset counter before counting
        $this->countTractor = [0,0,0];

        $tractors = \App\Models\TractorListModel::orderBy('created_at','desc')->get();

        $this->dataTractor = $tractors->map(function ($tractor, $index) {
            if($tractor->prod_type == 'mainline'){
                $this->countTractor[0]++;
            } elseif($tractor->prod_type == 'delivery'){
                $this->countTractor[1]++;
            } elseif($tractor->prod_type == 'inspeksi'){
                $this->countTractor[2]++;
            }

            return [
                'no_tractor' => $tractor->No,
                'id_tractor' => $tractor->Model,
                'keterangan' => $tractor->Keterangan,
                'foto' => $tractor->image,
                'nama_user' => $tractor->name,
                'nik' => $tractor->nik,
                'alarm' => $tractor->alarm_status,
                'prod_type' => $tractor->prod_type,
                'created_at' => $tractor->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $tractor->updated_at->format('Y-m-d H:i:s'),
                'sort_order' => $index, // Preserve array order
            ];
        })->values()->toArray(); // Use values() to reset array keys
    }

    public function refreshData()
    {
        $tractorsWithAlarm = \App\Models\TractorListModel::where('alarm_status', true)->get();

        foreach ($tractorsWithAlarm as $tractor) {
            $prodType = $tractor->prod_type ?? 'unknown';

            $prodTypeDisplay = match($prodType) {
                'mainline' => 'Mainline',
                'inspeksi' => 'Inspeksi',
                'delivery' => 'Delivery',
                default => ucfirst($prodType)
            };

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => "Tractor No {$tractor->No} telah discan dari {$prodTypeDisplay}"
            ]);

            $tractor->alarm_status = false;
            $tractor->save();
        }

        $this->loadData();
    }

    public function deleteTractor($tractorId)
    {
        try {
            $tractor = \App\Models\TractorListModel::where('Model', $tractorId)->first();

            if ($tractor) {
                $tractor->delete();
                $this->loadData();

                $this->dispatch('notify', [
                    'type' => 'success',
                    'message' => 'Tractor berhasil dihapus!'
                ]);

                return true;
            }

            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Tractor tidak ditemukan!'
            ]);

            return false;
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Gagal menghapus tractor: ' . $e->getMessage()
            ]);

            return false;
        }
    }

}; ?>
<div></div>
@script
    <script type="text/javascript">
        let table = null;
        let IdTable = $('#tractorTable');

        const option = {
            data: [],
            columns: [
                // Column 0: No Tractor
                {
                    data: 'no_tractor',
                    render: function(data, type, row) {
                        return `<span class="text-sm font-semibold text-[#1A5E63] dark:text-gray-100">${data}</span>`;
                    }
                },
                // Column 1: ID Tractor
                {
                    data: 'id_tractor',
                    render: function(data, type, row) {
                        return `<span class="text-sm font-medium text-gray-800 dark:text-gray-200">${data}</span>`;
                    }
                },
                // Column 2: Keterangan
                {
                    data: 'keterangan',
                    render: function(data, type, row) {
                        return `<div class="text-sm text-gray-700 dark:text-gray-300 max-w-xs">${data}</div>`;
                    }
                },
                // Column 3: Foto Tractor
                {
                    data: 'foto',
                    render: function (data, type, row) {
                        if (typeof data === 'string' && data.includes('http')) {
                            // If already a full URL
                            data = data;
                        } else {
                            // Prepend Laravel storage URL (ensure trailing slash)
                            data = `{{ asset('storage') }}/${data}`;
                        }

                        return `
                            <div class="flex items-center justify-center">
                                <img src="${data}"
                                     alt="Foto Tractor ${row.no_tractor || ''}"
                                     class="h-48 w-96 object-cover rounded-lg border-2 border-[#ADC698] dark:border-gray-600 hover:border-[#1A5E63] dark:hover:border-gray-400 transition-all cursor-pointer shadow-md"
                                     onclick="window.open(this.src, '_blank')">
                            </div>
                        `;
                    }
                },
                // Column 4: User Upload / NIK
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="text-sm">
                                    <div class="font-semibold text-[#1A5E63] dark:text-gray-100">${row.nama_user}</div>
                                    <div class="text-gray-600 dark:text-gray-400">NIK: ${row.nik}</div>
                                </div>`;
                    }
                },
                // Column 5: Action
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<button
                                    type="button"
                                    class="btn-delete inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 shadow-md hover:shadow-lg"
                                    data-no-tractor="${row.no_tractor}"
                                    data-id-tractor="${row.id_tractor}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>`;
                    }
                }
            ],
            responsive: true,
            scrollX: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
            order: [], // Keep array order from database (newest first)
            ordering: true, // Allow sorting but don't apply initial sort
            columnDefs: [
                {
                    orderable: false,
                    targets: [3, 5] // Disable sorting for Foto and Action columns
                },
                {
                    width: '12%',
                    targets: 0, // No Tractor
                    className: 'px-6 py-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700'
                },
                {
                    width: '15%',
                    targets: 1, // ID Tractor
                    className: 'px-6 py-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700'
                },
                {
                    width: '18%',
                    targets: 2, // Keterangan
                    className: 'px-6 py-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700'
                },
                {
                    width: '25%',
                    targets: 3, // Foto Tractor
                    className: 'px-6 py-4 text-center bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700'
                },
                {
                    width: '18%',
                    targets: 4, // User Upload / NIK
                    className: 'px-6 py-4 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700'
                },
                {
                    width: '12%',
                    targets: 5, // Action
                    className: 'px-6 py-4 text-center bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700'
                }
            ],
            language: {
                "emptyTable": "Tidak ada data tractor",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "lengthMenu": "Tampilkan _MENU_ data",
                "loadingRecords": "Memuat...",
                "processing": "Memproses...",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            drawCallback: function() {
                // Apply Tailwind classes to DataTables elements matching parent theme
                $('.dataTables_wrapper').addClass('px-6 pb-6');
                $('.dataTables_filter input').addClass('ml-2 px-4 py-2 border-2 border-[#ADC698] dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#1A5E63] focus:border-[#1A5E63] dark:focus:ring-blue-500 dark:focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100');
                $('.dataTables_length select').addClass('px-4 py-2 border-2 border-[#ADC698] dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#1A5E63] focus:border-[#1A5E63] dark:focus:ring-blue-500 dark:focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100');
                $('.dataTables_paginate .paginate_button').addClass('px-4 py-2 mx-1 border-2 border-[#ADC698] dark:border-gray-600 rounded-lg hover:bg-[#ADC698] dark:hover:bg-gray-600 text-[#1A5E63] dark:text-gray-300 font-medium transition-colors');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-[#1A5E63] dark:bg-blue-600 text-white border-[#1A5E63] dark:border-blue-600 hover:bg-[#0F4C51] dark:hover:bg-blue-700 shadow-md');


                $('.dataTables_info').addClass('text-[#1A5E63] dark:text-gray-300 font-medium');
                $('.dataTables_filter label').addClass('text-[#1A5E63] dark:text-gray-300 font-medium');
                $('.dataTables_length label').addClass('text-[#1A5E63] dark:text-gray-300 font-medium');
            }
        };

        // Event delegation untuk delete button (tetap aktif setelah data update)
        function setupEventHandlers() {
            // Remove existing handlers to prevent duplicates
            $(document).off('click', '.btn-delete');

            // Add event delegation for delete buttons
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const noTractor = $(this).data('no-tractor');
                const idTractor = $(this).data('id-tractor');

                if(confirm(`Apakah Anda yakin ingin menghapus data tractor ${noTractor}?`)) {
                    console.log('Deleting tractor ' + idTractor);
                    $wire.call('deleteTractor', idTractor).then(() => {
                        console.log('Tractor deleted successfully');
                    }).catch((error) => {
                        console.error('Error deleting tractor:', error);
                    });
                }
            });
        }

        function mapRow(row) {
            return {
                no_tractor: row?.no_tractor ?? row?.No ?? '',
                id_tractor: row?.id_tractor ?? row?.Model ?? '',
                keterangan: row?.keterangan ?? row?.Keterangan ?? '',
                foto: row?.foto ?? row?.image ?? '',
                nama_user: row?.nama_user ?? row?.name ?? '',
                nik: row?.nik ?? ''
            };
        }

        function updateTableData(data) {
            console.log('Updating table with data:', data);
            if (table && $.fn.DataTable.isDataTable(IdTable)) {
                // Update data tanpa destroy table
                table.clear();
                if (data && data.length > 0) {
                    // Use rows.add() instead of row.add() for multiple rows
                    table.rows.add(data);
                }
                table.draw();
                console.log('Table updated successfully');
            } else {
                console.error('Table not initialized or data is empty');
            }
        }

        function initDataTable() {
            // Pastikan table belum di-initialize
            if ($.fn.DataTable.isDataTable(IdTable)) {
                console.log('Table already initialized, skipping...');
                return;
            }

            // Initialize DataTable
            console.log('Initializing DataTable...');
            table = IdTable.DataTable(option);

            // Load initial data dari Livewire
            let initialData = $wire.get('dataTractor');
            console.log('Initial data from Livewire:', initialData);

            if (initialData && initialData.length > 0) {
                table.rows.add(initialData).draw();
            }
        }

        $(document).ready(function () {
            console.log('jQuery loaded:', typeof $);
            console.log('DataTable available:', typeof $.fn.DataTable);

            $('#mainline-count').text($wire.get('countTractor')[0]);
            $('#delivery-count').text($wire.get('countTractor')[1]);
            $('#inspeksi-count').text($wire.get('countTractor')[2]);

            // Setup event handlers with delegation
            setupEventHandlers();

            // Initialize DataTable setelah DOM ready
            initDataTable();

            // Setup watcher untuk perubahan data (hanya sekali)
            $wire.watch('dataTractor', (newValue) => {
                console.log('Data changed, new value:', newValue);
                updateTableData(newValue);
            });

            // Auto refresh data setiap 60 detik (1 menit)
            setInterval(() => {
                console.log('Refreshing data from server...');
                $('#last_scanned').text(new Date().toLocaleTimeString());
                $wire.call('refreshData').then(() => {
                    console.log('Data refreshed from server');
                }).catch((error) => {
                    console.error('Error refreshing data:', error);
                });
            }, 60000); // 60000ms = 1 menit
        });
    </script>
@endscript


@assets
    <link href="{{asset('js/DataTables/datatables.css')}}" rel="stylesheet" type="text/css" />
    <style>
        /* Custom DataTable styling to match parent theme */
        #tractorTable tbody tr {
            background-color: #fff !important;
            border-bottom: 1px solid #e5e7eb !important;
            transition: background-color 0.2s ease;
        }

        #tractorTable tbody tr:nth-child(even) {
            background-color: #f9fafb !important;
        }

        #tractorTable tbody tr:hover {
            background-color: #f0f9ff !important;
        }

        /* Dark mode styles */
        .dark #tractorTable tbody tr {
            background-color: #1f2937 !important;
            border-bottom: 1px solid #374151 !important;
        }

        .dark #tractorTable tbody tr:nth-child(even) {
            background-color: #111827 !important;
        }

        .dark #tractorTable tbody tr:hover {
            background-color: #1e3a8a !important;
        }

        /* DataTables controls styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin: 0 2px !important;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 1rem !important;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem !important;
        }
    </style>
@endassets

@pushonce('scripts')
    <script src="{{asset('js/DataTables/datatables.js')}}"></script>
@endpushonce
