<h1 class="h3 mb-2 text-gray-800">Combat Churn Report</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data</h6>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ Session::get('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <br>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <a href="{{ url('cc/cn/load/download?witel=ALL') }}" class="btn btn-success"><i class="fas fa-download"></i> Download All</a>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2" class="text-center">WITEL</th>
                    <th colspan="2" class="text-center">VISIT</th>
                    <th rowspan="2">Action</th>
                </tr>
                <tr>
                    <th class="text-center">CAPS</th>
                    <th class="text-center">CT0</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        loadData();
    });

    function loadData(){
        $('#dataTable').DataTable({
            asynchronous: true,
            processing: true,
            destroy: true,
            ajax: {
                url: "{{ url('cc/cn/load/report') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET'
            },
            columns: [
                { name: 'id', searchable: false, orderable: true, className: 'text-center' },
                { name: 'witel'},
                { name: 'caps'},
                { name: 'ct0'},
                { name: 'action', searchable: false, orderable: false, className: 'text-center' }
            ],
            order: [[1, 'desc']],
            iDisplayInLength: 10
        });
    }

    function deleteForm(id){
        $.ajax({
            url : "{{ url('cc/cn/delete') }}/"+id,
            method : 'GET',
            dataType : 'JSON',
            beforeSend:function(){
                $('body').loading()
            },
            complete:function(){
                $('body').loading('stop');
            },
            success:function(e){
                if(e.status == 200){
                    $('#dataTable').DataTable().ajax.reload(null, false)
                    swal ( "Wohoo!" ,  "Data berhasil dihapus!" ,  "success" )
                }else{
                    swal ( "Oops" ,  "Gagal menghapus data!" ,  "error" )
                }
            }
        })
    }
</script>
