<div class="modal fade" id="modalItem" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1"> 
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">DATA ITEM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel Buku -->
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Item</th>
                            <th width="30%">Quantity</th>
                            <th width="30%">Satuan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($item as $items)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $items->nama_item }}</td>
                            <td>{{ $items->qty }}</td>
                            <td>{{ $items->satuan }}</td>
                            <td>
                                <!-- Tombol Tambah Item ke Keranjang -->
                                <button onclick="add_cart('{{ $items->id }}', '{{ $items->nama_item }}', '{{ $items->qty }}', '{{ $items->satuan }}')" class="btn btn-success">
                                    <i class="fas fa-cart-plus"></i> Tambahkan
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Fungsi untuk menambah item ke keranjang
function add_cart(id, name, qty, satuan) {
    $.ajax({
        url: "/invoice/addItem",  // Pastikan URL sesuai dengan route yang ada
        method: "POST",
        data: {
            _token: '{{ csrf_token() }}',  // CSRF token untuk melindungi dari serangan
            id: id,
            nama_item: name,
            quantity: 1,  // Menggunakan quantity default 1, Anda bisa menambah input untuk quantity
            satuan: satuan,
        },
        success: function(data) {
            // Menutup modal setelah menambahkan item
            $('#modalItem').modal('hide');
            // Memuat ulang keranjang atau melakukan pembaruan tampilan di halaman
            loadCart();
        },
        error: function(xhr, status, error) {
            console.log("Terjadi kesalahan: " + error);
        }
    });
}

</script>