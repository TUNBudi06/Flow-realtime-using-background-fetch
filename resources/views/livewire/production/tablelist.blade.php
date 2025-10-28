<?php

use Livewire\Volt\Component;

new class extends Component {
    public $dataTractor = null;

}; ?>

<div>

</div>

@script
    <script type="text/javascript" >
        $(document).ready(function () {
            console.log('jQuery loaded:', typeof $);
            console.log('DataTable available:', typeof $.fn.DataTable);
        });
    </script>
@endscript


@assets
    <link href="{{asset('js/DataTables/datatables.css')}}" rel="stylesheet" type="text/css" />
@endassets

@pushonce('scripts')
    <script src="{{asset('js/DataTables/datatables.js')}}"></script>
@endpushonce
