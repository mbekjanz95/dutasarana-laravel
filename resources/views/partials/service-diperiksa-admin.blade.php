<div id="filter-value" class="d-flex">
            
          </div>
          <div class="mt-4 table-responsive">
            <table class="table table-bordered align-middle">
              <thead>
                <tr>
                  <th>No. SO</th>
                  <th>Nama Customer</th>
                  <th>No. Telepon</th>
                  <th>Email</th>
                  <th>Keluhan</th>
                  <th>Merk</th>
                  <th>Tipe Unit</th>
                  <th>Serial Number</th>
                  <th>Unit yang diterima</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="data-keseluruhan">
                @foreach ($service as $row)
                  <tr>
                    <td class="text-center">{{ $row->no_so }}</td>
                    <td class="text-center">{{ $row->customername }}</td>
                    <td class="text-center">{{ $row->phone }}</td>
                    <td class="text-center">{{ $row->email }}</td>
                    <td class="text-center">{{ $row->keluhan }}</td>
                    <td class="text-center">{{ $row->merk }}</td>
                    <td class="text-center">{{ $row->tipe_barang }}</td>
                    <td class="text-center">{{ $row->serial_number }}</td>
                    <td class="text-center">{{ $row->unit_diterima }}</td>
                    <td class="text-center">{{ $row->status }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>