<style>
    .border-bottom{
        border: none;
        border-bottom : 1px solid grey;
        padding: 0;
    }
    .voc1_value, .voc3_value, .voc4_value, .voc5_value, .voc6_value, .voc7_value{
        display: none;
    }
    .val{
        margin-top: 10px
    }
</style>
<h1 class="h3 mb-2 text-gray-800">Combat Churn Input Result</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Result</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <a href="{{ url('cc') }}" class="btn btn-danger btn-sm float-right"><i class="fas fa-arrow-left"></i> Kembali ke Data Combat Churn list</a>
            </div>
        </div>
        <hr>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ url('cc/cn/insert') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                Data WO
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Channel <span class="text-danger">*</span></label>
                                    <select name="channel" id="channel" class="form-control select2" readonly>
                                        <option value="ALL">ALL</option>
                                        <option value="SOCMED" {{ $cn->channel == 'SOCMED' ? 'selected' : '' }}>SOCMED</option>
                                        <option value="INBOUND" {{ $cn->channel == 'INBOUND' ? 'selected' : '' }}>INBOUND / 147</option>
                                    </select>
                                    <input type="hidden" name="flag" id="flag" value="{{ $cn->flag_data }}">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xl-12">
                                            <label for="">ND Internet : <span class="text-danger">*</span></label>
                                            <input type="text" name="nd_internet" id="nd_internet" class="form-control" value="{{ $cn->nd_internet }}" required readonly>
                                        </div>
                                    </div>
                                    @error('nd_internet') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nama : <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $cn->nama }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">No. HP : <span class="text-danger">*</span></label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $cn->hp }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat : <span class="text-danger">*</span></label>
                                    <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $cn->alamat }}" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="">Nama CP : <span class="text-danger">*</span></label>
                                            <input type="text" name="cp_nama" id="cp_nama" value="{{ $cn->cp_nama }}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">CP : <span class="text-danger">*</span></label>
                                            <input type="text" name="cp_num" id="cp_num" value="{{ $cn->hp }}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kecepatan Terakhir : <span class="text-danger">*</span></label>
                                            <input type="text" name="speed" id="speed" value="{{ $cn->speed }}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Paket Terakhir : <span class="text-danger">*</span></label>
                                            <input type="text" name="paket" id="paket" value="{{ $cn->paket }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="">Tagihan : <span class="text-danger">*</span></label>
                                            <input type="text" name="tagihan" id="tagihan" value="{{ $cn->tagihan }}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">LoS : <span class="text-danger">*</span></label>
                                            <input type="text" name="los_cat" id="los_cat" value="{{ $cn->los_cat }}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">KContact : <span class="text-danger">*</span></label>
                                            <textarea name="kcontact" id="kcontact" cols="30" rows="10" class="form-control" readonly>{!! $cn->kcontact !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-sm-12 col-md-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            Voice of Customer
                        </div>
                        <div class="card-body">
                            <div class="title">
                                <h5>1. Alasan Cabut Indihome : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @foreach ($voc as $no1 => $voc1)
                                    @if($voc1->voc == 1)
                                        <tr>
                                            <td>{{ ++$no1 }}</td>
                                            @if ($voc1->jawaban == 'Lain-lain')
                                                <td>{{ $voc1->jawaban .' : '.$voc1->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc1->jawaban }}</td>
                                            @endif
                                            
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <hr>
                            <div class="title">
                                <h5>2. Apakah perangkat (seperti ONT, STB) masih ada di pelanggan? : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @foreach ($voc as $no1 => $voc1)
                                    @if($voc1->voc == 2)
                                        <tr>
                                            {{-- <td>{{ ++$no1 }}</td> --}}
                                            @if ($voc1->jawaban == 'Lain-lain')
                                                <td>{{ $voc1->jawaban .' : '.$voc1->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc1->jawaban }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <hr>
                            <div class="title">
                                <h5>3. Pengalman baik menggunakan Indihome : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @php
                                    $no3 = 1;
                                @endphp
                                @foreach ($voc as $voc3)
                                    @if($voc3->voc == 3)
                                        <tr>
                                            <td>{{ $no3++ }}</td>
                                            @if ($voc3->jawaban == 'Lain-lain')
                                                <td>{{ $voc3->jawaban .' : '.$voc3->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc3->jawaban }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <hr>
                            <div class="title">
                                <h5>4. Pengalman kurang baik menggunakan Indihome : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @php
                                    $no4 = 1;
                                @endphp
                                @foreach ($voc as $voc4)
                                    @if($voc4->voc == 4)
                                        <tr>
                                            <td>{{ $no4++ }}</td>
                                            @if ($voc4->jawaban == 'Lain-lain')
                                                <td>{{ $voc4->jawaban .' : '.$voc4->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc4->jawaban }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <hr>
                            <div class="title">
                                <h5>5. Provider internet yang digunakan saat ini : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @foreach ($voc as $voc5)
                                    @if($voc5->voc == 5)
                                        @php
                                            $q_provider = DB::select('select * from cc_provider where id = '.$voc5->jawaban);
                                        @endphp
                                        <tr>
                                            {{-- <td>{{ $no5++ }}</td> --}}
                                            @if ($voc5->jawaban == 'Lain-lain')
                                                <td>{{ $voc5->jawaban .' : '.$voc5->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $q_provider[0]->provider }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <hr>
                            <div class="title">
                                <h5>6. Pengalaman baik selama menggunakan provider saat ini : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @php
                                    $no11 = 1;
                                @endphp
                                @foreach ($voc as $voc11)
                                    @if($voc11->voc == 11)
                                        <tr>
                                            <td>{{ $no11++ }}</td>
                                            @if ($voc11->jawaban == 'Lain-lain')
                                                <td>{{ $voc11->jawaban .' : '.$voc11->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc11->jawaban }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <hr>
                            <div class="title">
                                <h5>7. Pengalaman kurang baik selama menggunakan provider saat ini : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @php
                                    $no12 = 1;
                                @endphp
                                @foreach ($voc as $voc12)
                                    @if($voc12->voc == 12)
                                        <tr>
                                            <td>{{ $no12++ }}</td>
                                            @if ($voc12->jawaban == 'Lain-lain')
                                                <td>{{ $voc12->jawaban .' : '.$voc12->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc12->jawaban }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <hr>
                            <div class="title">
                                <h5>8. Kebutuhan penggunaan Internet/IndiHome : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @php
                                    $no6 = 1;
                                @endphp
                                @foreach ($voc as $voc6)
                                    @if($voc6->voc == 6)
                                        <tr>
                                            <td>{{ $no6++ }}</td>
                                            @if ($voc6->jawaban == 'Lain-lain')
                                                <td>{{ $voc6->jawaban .' : '.$voc6->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc6->jawaban }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <hr>
                            <div class="title">
                                <h5>9. Jumlah pengguna Internet di lokasi : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                {{-- @php
                                    $no9 = 1;
                                @endphp --}}
                                @foreach ($voc as $voc7)
                                    @if($voc7->voc == 7)
                                        <tr>
                                            {{-- <td>{{ $no7++ }}</td> --}}
                                            @if ($voc7->jawaban == 'Lain-lain')
                                                <td>{{ $voc7->jawaban .' : '.$voc7->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc7->jawaban }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <hr>
                            <div class="title">
                                <h5>10. Apakah ada keinginan untuk kembali menggunakan Indihome : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                {{-- @php
                                    $no9 = 1;
                                @endphp --}}
                                @foreach ($voc as $voc8)
                                    @if($voc8->voc == 8)
                                        <tr>
                                            {{-- <td>{{ $no7++ }}</td> --}}
                                            @if ($voc8->jawaban == 'Lain-lain')
                                                <td>{{ $voc8->jawaban .' : '.$voc8->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $voc8->jawaban }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            @if ($voc[0]->voc == 8 && $voc[0]->jawaban == 'YA')
                            <hr>
                            <div class="title">
                                <h5>9. Paket Yang disetujui : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                @foreach ($voc as $voc9)
                                    @if($voc9->voc == 9)
                                        @php
                                            $q_paket = DB::select('select * from cc_jenis_paket where id = '.$voc9->jawaban);
                                        @endphp
                                        <tr>
                                            {{-- <td>{{ $no5++ }}</td> --}}
                                            @if ($voc9->jawaban == 'Lain-lain')
                                                <td>{{ $voc9->jawaban .' : '.$voc9->jawaban_lain }}</td>
                                            @else
                                                <td>{{ $q_paket[0]->nama_paket }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            <table>
                                <tr>
                                    <td>CP :</td>
                                    <td>{{ $voc[0]->voc == 10 ? $voc[0]->jawaban : '' }}</td>
                                </tr>
                            </table>
                            @endif
                            <hr>
                            <div class="title">
                                <h5>10. Eviden Foto : </h5>
                            </div>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td>
                                        <img src="{{ asset('backend/combat_churn/'.$cn->attachment) }}" alt="" class="img img-responsive">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-sm-12 col-md-12 col-xl-12">
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
                </div>
            </div> --}}
        </form>
    </div>
</div>
<script>
    // $(document).ready(function(){
    //     wb = $("#voc8").val();
    //     makeRules(wb);
    // })
    // function searchPelanggan(){
    //     nd = $("#nd_internet").val();
    //     channel = $("#channel").val();
    //     $.ajax({
    //         url : "{{ url('cc/search') }}?channel="+channel+"&nd="+nd,
    //         method : "GET",
    //         dataType : "JSON",
    //         beforeSend:function(){
    //             $('body').loading()
    //         },
    //         complete:function(){
    //             $('body').loading('stop');
    //         },
    //         success:function(e){
    //             if(e.status == 200){
    //                 $("#nama").val(e.data[0].nama)
    //                 $("#alamat").val(e.data[0].alamat)
    //                 $("#no_hp").val(e.data[0].hp)
    //                 $("#cp_nama").val(e.data[0].cp_nama)
    //                 $("#cp_num").val(e.data[0].hp)
    //                 $("#tagihan").val(e.data[0].tagihan)
    //                 $("#speed").val(e.data[0].speed)
    //                 $("#paket").val(e.data[0].paket)
    //                 $("#los_cat").val(e.data[0].los_cat)
    //                 $("#kcontact").val(e.data[0].kcontact)

    //             }else{
    //                 swal ( "Oops" ,  "Data tidak ditemukan!" ,  "error" )
    //             }

    //         }
    //     })
    // }

    // function valueChange(e,a){
    //     val = $("#voc"+a).val();
    //     if(e.checked == true){
    //         $(".voc"+a+"_value").show()
    //     }else{
    //         $(".voc"+a+"_value").hide()
    //     }
    //     //if(a == 4){
    //     //    if(e.checked == true){
    //     //        $(".voc"+a+"_value").show()
    //     //    }else{
    //     //        $(".voc"+a+"_value").hide()
    //     //    }
    //     //}else{
    //     //    if(val == 'Lain-lain'){
    //     //        $(".voc"+a+"_value").show()
    //     //    }else{
    //    //         $(".voc"+a+"_value").hide()
    //     //    }
    //     //}
    // }

    // function makeRules(e){
    //     val = $(e).val();
    //     if(val != 'YA'){
    //         $("#voc9").attr('required',false);
    //         $("#voc10").attr('required',false);
    //         $(".form-hide").hide();

    //     }else{
    //         $("#voc9").attr('required',true);
    //         $("#voc10").attr('required',true);
    //         $(".makeRule").show();
    //         $(".form-hide").show();
    //     }
    // }
</script>
