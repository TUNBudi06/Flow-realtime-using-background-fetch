<?php

use Livewire\Volt\Component;

new class extends Component {
    public $dataTractor = null;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        // Load data from database and transform to match DataTable format
        $tractors = \App\Models\TractorListModel::all();

        // Transform data to match DataTable column names
        $this->dataTractor = $tractors->map(function ($tractor) {
            return [
                'no_tractor' => $tractor->No,
                'id_tractor' => $tractor->Model,
                'keterangan' => $tractor->Keterangan,
                'foto' => $tractor->image,
                'nama_user' => $tractor->name,
                'nik' => $tractor->nik,
                'created_at' => $tractor->created_at,
                'updated_at' => $tractor->updated_at,
            ];
        })->toArray();
    }

    // Method ini akan dipanggil dari JavaScript setiap 1 menit
    public function refreshData()
    {
        $this->loadData();
    }

    public function deleteTractor($tractorId)
    {
        try {
            // Find and delete the tractor by ID (Model field)
            $tractor = \App\Models\TractorListModel::where('Model', $tractorId)->first();

            if ($tractor) {
                $tractor->delete();
                $this->loadData(); // Reload data after delete

                // Dispatch success notification (optional - if you have toast/notification)
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
                {
                    data: 'no_tractor',
                    render: function(data, type, row) {
                        return `<span class="text-sm font-medium text-gray-900">${data}</span>`;
                    }
                },
                {
                    data: 'id_tractor',
                    render: function(data, type, row) {
                        return `<span class="text-sm text-gray-700">${data}</span>`;
                    }
                },
                {
                    data: 'keterangan',
                    render: function(data, type, row) {
                        return `<div class="text-sm text-gray-700 max-w-xs">${data}</div>`;
                    }
                },
                {
                    data: 'foto',
                    render: function(data, type, row) {
                        return `<div class="flex items-center justify-center">
                                    <img src="${data}"
                                         alt="Foto Tractor ${row.no_tractor}"
                                         class="h-48 w-96 object-cover rounded-lg border border-gray-200 hover:border-gray-300 transition-all cursor-pointer"
                                         onclick="window.open(this.src, '_blank')">
                                </div>`;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<div class="text-sm">
                                    <div class="font-medium text-gray-900">${row.nama_user}</div>
                                    <div class="text-gray-500">NIK: ${row.nik}</div>
                                </div>`;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<button
                                    type="button"
                                    class="btn-delete inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                    data-no-tractor="${row.no_tractor}"
                                    data-id-tractor="${row.id_tractor}">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            order: [[0, 'asc']],
            columnDefs: [
                {
                    orderable: false,
                    targets: [3, 5] // Disable sorting for Foto and Action columns
                },
                {
                    width: '8%',
                    targets: [0, 1]
                },
                {
                    width: '25%',
                    targets: 2
                },
                {
                    width: '15%',
                    targets: 3,
                    className: 'text-center'
                },
                {
                    width: '15%',
                    targets: 4
                },
                {
                    width: '10%',
                    targets: 5,
                    className: 'text-center'
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
                // Apply Tailwind classes to DataTables elements
                $('.dataTables_wrapper').addClass('px-4 pb-4');
                $('.dataTables_filter input').addClass('ml-2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent');
                $('.dataTables_length select').addClass('px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent');
                $('.dataTables_paginate .paginate_button').addClass('px-3 py-1 mx-1 border border-gray-300 rounded hover:bg-gray-100');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-500 text-white border-blue-500 hover:bg-blue-600');
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
@endassets

@pushonce('scripts')
    <script src="{{asset('js/DataTables/datatables.js')}}"></script>
@endpushonce
