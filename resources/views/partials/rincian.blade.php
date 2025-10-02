@php
    $groupedCart = [];
    $grand_total_belanja = 0;
    $grand_total_kurir = 0;
    $orderDisplayed = [];
@endphp

@foreach ($transaction as $row)
    @if (!isset($groupedCart[$row->kota_pengiriman])) 
        @php
            $groupedCart[$row->kota_pengiriman] = [
                'products' => [],
                'courier_cost' => $row->courier_cost,
                'courier_service' => $row->courier_service
            ];
        @endphp
    @endif

    @php
        $groupedCart[$row->kota_pengiriman]['products'][] = $row;
    @endphp

@endforeach

<h3 class="mt-4">Order ID : {{ $orderId }}</h3>

@forelse ($groupedCart as $kota => $data)
    @php
        $total_belanja_per_kota = 0;
    @endphp

    <h4 class="text-danger fw-bold mt-4">Lokasi Pengiriman : {{ $kota }}</h4>

    <table class="table table-bordered mt-3" style="border: 1px solid rgba(0,0,0,0.5)">
        <thead style="background-color: #920700;">
            <tr style="color: white">
                <th class="text-center">Nama Produk</th>
                <th class="text-center">Harga @</th>
                <th class="text-center">Discount</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['products'] as $row)
                @php
                    $sub_total = $row->priceafter * $row->qty;
                    $total_belanja_per_kota += $sub_total;
                @endphp
                <tr>
                    <td style="max-width: 500px; width: 500px; word-wrap: break-word; word-break: break-word; padding-bottom: 20px;">
                        {{ $row->productname }}<br>
                        <b>(SKU : {{ $row->sku }})</b>
                    </td>
                    <td class="text-center">Rp {{ number_format($row->priceafter, 0, ',', '.') }}</td>                           
                    <td class="text-center">0%</td>
                    <td class="text-center">{{ $row->qty }}</td>
                    <td class="text-center">Rp {{ number_format($sub_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"><b>Total Belanja</b></td>
                <td class="text-center"><b>Rp {{ number_format($total_belanja_per_kota, 0, ',', '.') }}</b></td>
            </tr>
            <tr>
                <td colspan="4">
                    <b>Biaya Pengiriman:</b> {{ $data['courier_service'] }}
                </td>
                <td class="text-center">Rp {{ number_format($data['courier_cost'], 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    @php
        $grand_total_belanja += $total_belanja_per_kota;
        $grand_total_kurir += $data['courier_cost'];
    @endphp

@empty
    <h1 class="text-center">Belum ada transaksi</h1>
@endforelse
</div>

{{-- TAMPILKAN GRAND TOTAL --}}
@if ($grand_total_belanja > 0 || $grand_total_kurir > 0)
    <div class="mt-4">
        <h4 class="text-end text-success">Total Pemasukan : <b>Rp {{ number_format($grand_total_belanja, 0, ',', '.') }}</b></h4>
    </div>
@endif
