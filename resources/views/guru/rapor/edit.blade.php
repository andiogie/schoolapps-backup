@extends('layouts.guru')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Isi / Edit Rapor Siswa</h1>
    <p class="mb-4">Lengkapi nilai dan deskripsi untuk siswa <strong>{{ $siswa->nama }}</strong>.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('guru.rapor.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th>Mata Pelajaran</th>
                                <th width="10%">Nilai</th>
                                <th>Deskripsi Capaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mapels as $index => $mapel)
                                @php
                                    // Cari detail rapor yang sesuai untuk mapel ini
                                    $detail = $raporDetails->firstWhere('mapel_id', $mapel->id);
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $mapel->nama_mapel }}</td>
                                    <td>
                                        <input type="hidden" name="details[{{ $mapel->id }}][mapel_id]" value="{{ $mapel->id }}">
                                        <input type="number" 
                                               class="form-control"
                                               name="details[{{ $mapel->id }}][nilai]" 
                                               value="{{ old('details.'.$mapel->id.'.nilai', $detail->nilai ?? '') }}" 
                                               placeholder="0-100">
                                    </td>
                                    <td>
                                        <textarea class="form-control" 
                                                  name="details[{{ $mapel->id }}][deskripsi]"
                                                  rows="2">{{ old('details.'.$mapel->id.'.deskripsi', $detail->deskripsi ?? '') }}</textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Catatan Wali Kelas</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <textarea class="form-control" id="catatan_wali_kelas" name="catatan_wali_kelas" rows="4">{{ old('catatan_wali_kelas', $rapor->catatan_wali_kelas ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('guru.rapor.index') }}" class="btn btn-secondary">Batal</a>
    </form>

</div>
@endsection
