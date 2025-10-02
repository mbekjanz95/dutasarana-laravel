@foreach ($transaction as $row )
    <div style="font-size: 18px; font-weight: bold; color: #333;">Detail Transaksi</div>
    <div style="font-size: 12px; font-weight: bold; color: #6e6d6d;">(Order ID : {{ $row->order_id }})</div>

    <div class="mt-3" style="font-size: 18px; font-weight: bold; color: #333;">Data Pembeli</div>
    <ul style="list-style: none;">
        <li>Nama Lengkap<br><b> {{$row->customername}}</b></li>
        <li class="mt-2">No. Telp/HP<br><b> {{$row->phone}}</b></li>
        <li class="mt-2">Alamat<br><b> {{$row->address}}, {{$row->district_name}}, {{$row->kelurahan_name}}, {{$row->city_name}}, {{$row->province}}</b></li>
    </ul>
@endforeach