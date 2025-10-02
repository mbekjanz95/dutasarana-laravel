<div class="d-block">
                           {{--  <div class="text-end">
                                Tanggal Servis : <input value="{{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('Y-m-d') }}" class="ms-3" type="date" style="font-weight: 500">
                            </div> --}}
                            @if ($groupedData->isEmpty())
                                <h2 class="mt-1 text-center">Belum ada data !</h2>
                            @else
                            <div id="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div style="font-size: 20px;">No. SO :</div>
                                        <select class="ms-2 form-select w-auto" name="no_so" id="no_so">
                                        @foreach ($groupedData as $no_so => $items)
                                            <option value="{{ $no_so }}">{{ $no_so }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="sparepart-list" class="mt-3">
                
                                </div>
                                
                                <div id="harga-container" class="mb-3">
                                    <strong>Harga Servis :</strong> <span id="harga-value"></span>
                                </div>
                            </div>
                            @endif
                </div>


