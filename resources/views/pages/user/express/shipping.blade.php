@extends('pages.user.express.index')
@section('active1', 'active')

@section('expressContent')
<style>
    .datatable-container {
        overflow-x: auto;
        white-space: nowrap; /* Prevents text wrapping */
    }
    .bg-under-review
    {
        background-color: #91948B !important
    }
    .bg-under-delivery
    {
        background-color: lightgreen !important
    }
    .bg-postpone
    {
        background-color: yellow !important;
    }
    .bg-notes
    {
        background-color: orangered !important;
    }
    
</style>

    {{-- <h2 class="mb-4">{{ __('Local Shipping') }}</h2> --}}
    <h2 class="mb-4"> الشحنات </h2>
    @if (session()->has('error'))
        <div class="text-center py-4 text-light my-3 bg-danger">{{ session()->get('error') }}</div>
    @endif
    @if (session()->has('success'))
        <div class="text-center py-4 text-light my-3 bg-success">{{ session()->get('success') }}</div>
    @endif
    
    
    @php 
        $status_numbers = config('constants.STATUS_NUMBER');
    @endphp 
 

    <div class="card p-3">

       <div class="row">
            <div class="col-sm-12 col-md-4">
                <select class="form-select m-1" id="shipment_status_select">
                    <option value="">اختر حالةالشحنة</option>
                    @foreach($shipment_statuses as $shipment_status)
                    <option value="{{ $shipment_status->id }}">{{ __($shipment_status->name) }}</option>
                    @endforeach
                </select>
            </div>
       </div>

     
       <div class="card-body datatable-container" id="myTabContent">
            {{ $dataTable->table() }}
       </div>

         
    </div>

    @push('scripts')
    {{ $dataTable->scripts() }}      
   @endpush
   

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() 
    {

        var dataTable = $('#express-table').DataTable();
       
        
        $('#shipment_status_select').on('change',function(){
            var columnName = 'shipment_status_id'; // Replace 'columnName' with the actual name of your column
            var columnIndex = dataTable.column(columnName + ':name').index();
            var search_value = $(this).val();
            
            dataTable.column(columnIndex).search(search_value).draw();
 
        })
        
    });

</script>
@endpush 
