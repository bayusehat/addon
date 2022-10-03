<h1 class="h3 mb-2 text-gray-800">Combat Churn List</h1>
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">WITEL</label>
                    <select name="witel" id="witel" class="form-control select2">
                        <option value="ALL">ALL</option>

                        @foreach ($witel as $w)
                        <option value="{{ $w->cwitel }}">{{ $w->area }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">FLAG</label>
                    <select name="flag" id="flag" class="form-control select2">
                        <option value="ALL">ALL</option>
                        <option value="caps">CAPS</option>
                        <option value="ct0">CT0</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">STATUS</label>
                    <select name="status" id="status" class="form-control select2">
                        <option value="ALL">ALL</option>
                        <option value="visited">VISITED</option>
                        <option value="not visited">NOT VISITED</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <br>
                    <button class="btn btn-primary" type="button" onclick="loadData()"><i class="fas fa-refres"></i> Reload</button>
                </div>
            </div>
            {{--  <div class="col-sm-12 col-md-12 col-xl-12">
                <a href="{{ url('cc/create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Combat Churn Form</a>
            </div>  --}}
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>No</th>
                    <th>WITEL</th>
                    <th>STO</th>
                    <th>ND INTERNET</th>
                    <th>NAMA</th>
                    <th>NO. HP</th>
                    <th>ALAMAT</th>
                    <th>CREATED DATE</th>
                    <th>CHANNEL</th>
                    <th>STATUS</th>
                    <th>Action</th>
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
        
    });

    function loadData(){
        var witel = $("#witel").val();
        var flag = $("#flag").val();
        var vis = $("#status").val();
        $('#dataTable').DataTable({
            asynchronous: true,
            processing: true,
            destroy: true,
            ajax: {
                url: "{{ url('cc/cn/load') }}?witel="+witel+"&flag="+flag+"&status="+vis,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'GET'
            },
            columns: [
                { name: 'id', searchable: false, orderable: true, className: 'text-center' },
                { name: 'witel'},
                { name: 'sto'},
                { name: 'nd_internet'},
                { name: 'nama'},
                { name: 'hp'},
                { name: 'alamat'},
                { name: 'creatd'},
                { name: 'channel'},
                { name: 'status'},
                { name: 'action', searchable: false, orderable: false, className: 'text-center' }
            ],
            order: [[5, 'desc']],
            iDisplayInLength: 10
        });
    }

    function resetForm(nd,flag){
        if(flag == 1){
            fb = 'caps';
        }else{
            fb = 'ct0';
        }
        $.ajax({
            url : "{{ url('cc/cn/reset') }}/"+nd+"/"+fb,
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
                    swal ( "Wohoo!" ,  e.message ,  "success" )
                }else{
                    swal ( "Oops" ,  e.message ,  "error" )
                }
            }
        })
    }
</script>
