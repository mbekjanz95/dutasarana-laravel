@foreach ($transaction as $row )
    <div style="font-size: 18px; font-weight: bold; color: #333;">Detail Transaksi</div>
    <div style="font-size: 12px; font-weight: bold; color: #6e6d6d;">(Order ID : {{ $row->order_id }})</div>

    <div class="mt-3" style="font-size: 18px; font-weight: bold; color: #333;">Data Pembeli</div>
    <ul style="list-style: none;">
        <li>Nama Lengkap<span style="margin-left: 30px">:</span><b class="ms-2"> {{$row->customername}}</b></li>
        <li>No. Telp/HP<span style="margin-left: 51px">:</span><b class="ms-2"> {{$row->phone}}</b></li>
        <li>Alamat<span style="margin-left: 88px">:</span><b class="ms-2"> {{$row->address}}, {{$row->district_name}}, {{$row->kelurahan_name}}, {{$row->city_name}}, {{$row->province}}</b></li>
    </ul>
@endforeach