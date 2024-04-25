<p>Logo Perusahaan</p>
<p><img src="{{ $data->logo ? asset('storage/images/' . $data->logo) : '/no-logo.png' }}" class="img-fluid" alt="{{ $data->nama_perusahaan }}"></p>
<table class="table">
    <tr>
        <td width="30%"></td>
        <td width="70%"></td>
    </tr>
    <tr>
        <td>NOMOR REGISTRASI</td>
        <td>: {{$data->nomor_registrasi}}</td>
    </tr>
    <tr>
        <td>NIB</td>
        <td>: {{$data->nib}}</td>
    </tr>
    <tr>
        <td>NPWP</td>
        <td>: {{$data->npwp}}</td>
    </tr>
    <tr>
        <td>NAMA PERUSAHAAN</td>
        <td>: {{$data->nama_perusahaan}}</td>
    </tr>
    <tr>
        <td>NAMA MERK USAHA</td>
        <td>: {{$data->brand}}</td>
    </tr>
    <tr>
        <td>ALAMAT KANTOR</td>
        <td>: {{$data->alamat}}</td>
    </tr>
    <tr>
        <td>DESA/KELURAHAN</td>
        <td>: {{($data->desa) ? $data->desa->name: ''}}</td>
    </tr>
    <tr>
        <td>KECAMATAN</td>
        <td>: {{($data->kecamatan) ? $data->kecamatan->name : ''}}</td>
    </tr>
    <tr>
        <td>KABUPATEN/KOTA</td>
        <td>: {{($data->kabupaten) ? $data->kabupaten->name : ''}}</td>
    </tr>
    <tr>
        <td>PROVINSI</td>
        <td>: {{($data->provinsi) ? $data->provinsi->name : ''}}</td>
    </tr>
    <tr>
        <td>NOMOR TELPON/WA</td>
        <td>: {{$data->telepon}}</td>
    </tr>
    <tr>
        <td>EMAIL</td>
        <td>: {{$data->email}}</td>
    </tr>
    <tr>
        <td>WEBSITE</td>
        <td>: {{$data->website}}</td>
    </tr>
</table>