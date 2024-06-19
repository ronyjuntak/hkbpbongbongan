@include('layouts.forms.header')
@include('layouts.forms.navbar')
@include('layouts.forms.sidebar')
@include('layouts.forms.footer')

<div class="content-wrapper"><br><br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header" style="height:6rem">
                            <h3 class="card-title" id="textHeader">Detail Data Jemaat</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Bio Data</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nomor Registrasi</td>
                                        <td><option value="{{ $bjemaat->id_registrasi }}">{{ $bjemaat->no_registrasi }}</option></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>{{ $bjemaat->nama_depan }} {{ $bjemaat->nama_belakang }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat, Tanggal Lahir</td>
                                        <td>{{ $bjemaat->tempat_lahir }} , {{ $bjemaat->tanggal_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td>Foto</td>
                                        <td>
                                            <a href="{{ asset('storage/foto/'. $bjemaat->foto) }}" target="_blank">
                                                <img src="{{ asset('storage/foto/'.$bjemaat->foto) }}" alt="" width="100"/>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Surat Baptis</td>
                                        <td>
                                            <a href="{{ asset('storage/sbks/'. $bjemaat->sbk) }}" target="_blank">
                                                <img src="{{ asset('storage/sbks/'.$bjemaat->sbk) }}" alt="" width="100"/>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Surat Sidi</td>
                                        <td>
                                            @if(!empty($bjemaat->sns))
                                            <a href="{{ asset('storage/snss/'. $bjemaat->sns) }}" target="_blank">
                                                <img src="{{ asset('storage/snss/'.$bjemaat->sns) }}" alt="" width="100"/>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>{{ $bjemaat->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Keluarga</td>
                                        <td>{{ $bjemaat->nama_keluarga }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Keluarga</td>
                                        <td>{{ $bjemaat->nama_hub_keluarga }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pendidikan</td>
                                        <td>{{ $bjemaat->pendidikan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan</td>
                                        <td>{{ $bjemaat->pekerjaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan Lainnya</td>
                                        <td>{{ $bjemaat->nama_pekerjaan_lain }}</td>
                                    </tr>
                                    <tr>
                                        <td>Golongan Darah</td>
                                        <td>{{ $bjemaat->gol_darah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>{{ $bjemaat->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Telepon</td>
                                        <td>{{ $bjemaat->no_telepon }}</td>
                                    </tr>
                                    {{--  <tr>
                                        <td>Keterangan</td>
                                        <td>{{ $bjemaat->keterangan }}</td>
                                    </tr>  --}}
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <a class="btn btn-default" href="{{ route('jemaat') }}" id="buttonKembali">Kembali</a>
                            <a href="{{ route('editJemaat',$bjemaat->id_jemaat) }}" class="btn btn-warning" id="buttonEdit">Edit</a>
                        </div><br><br>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



