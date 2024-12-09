function loadCart() {
    $.ajax({
        url: "{{ route('loadCart') }}",
        method: "GET",
        success: function (data) {
            var cartHTML = '';
            var counter = 1;
            var grandTotal = 0;

            data.forEach(function (item) {
                var totalPrice = item.price * item.qty;
                grandTotal += totalPrice;
                var formattedPrice = formatRupiah(item.price);
                var formattedTotalPrice = formatRupiah(totalPrice);
                cartHTML += `<tr id="item-${item.item_id}">
                <td>${counter}</td>
                <td>${item.nama_item}</td>
                <td>${item.qty}</td>
                <td>${formattedPrice}</td>
                <td>${formattedTotalPrice}</td>
                <td><button class="btn btn-warning btn-sm" onclick="openModal(${item.item_id}, ${item.qty})"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteItem(${item.item_id})"><i class="fa fa-trash"></i></button></td>
            </tr>`;
                counter++;
            });
            $('#cartTable tbody').html(cartHTML);
            updateTotalPrice();
            var formattedGrandTotal = formatRupiah(grandTotal);

            // Update elemen dengan ID total-price
            $('#total-price').text(formattedGrandTotal);
        },
        error: function (xhr, status, error) {
            console.log("Terjadi kesalahan: " + error);
        }
    });
}

function updateTaxValue() {
const selectedTax = parseFloat(document.querySelector('input[name="flexRadioDefault"]:checked').value) || 0;
const formattedTax = formatRupiah(selectedTax);
document.getElementById('tax-value').textContent = formattedTax;

// Perbarui Grand Total setelah pajak diperbarui
updateTotalPrice();
}

function updateTotalPrice() {
// Ambil nilai Total Price
const totalPriceText = document.getElementById('total-price').textContent.replace(/[^\d]/g, '');
const totalPrice = parseFloat(totalPriceText) || 0;

// Ambil nilai pajak
const selectedTax = parseFloat(document.querySelector('input[name="flexRadioDefault"]:checked').value) || 0;

// Hitung Grand Total
const grandTotal = totalPrice + selectedTax;

// Tampilkan Grand Total dengan format Rupiah
const formattedGrandTotal = formatRupiah(grandTotal);
document.getElementById('grand-total').textContent = formattedGrandTotal;
}

// Pasang event listener pada semua radio button
const taxRadios = document.querySelectorAll('.tax-radio');
taxRadios.forEach(radio => {
radio.addEventListener('change', updateTaxValue);
});

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
updateTaxValue();
updateTotalPrice();
});

function openModal(itemId, qty) {
    $('#item_id').val(itemId);
    $('#qty').val(qty);
    $('#modalUbah').modal('show');
}

$(document).ready(function () {
    loadCart();
});

function add_cart(id, name, satuan) {
    var price = document.getElementById('price-' + id).value;
    if (price === "" || price <= 0) {
        alert("Silahkan Masukkan Harga!");
        return;
    }
    price = parseInt(price.replace(/[^0-9]/g, ''), 10);
    var totalPrice = price * qty
    $.ajax({
        url: "{{ route('addItem') }}",
        method: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            item_id: id,
            nama_item: name,
            qty: 1,
            satuan: satuan,
            price,
            total_price: totalPrice
        },
        success: function (data) {
            $('#modalCart').modal('hide');
            updateTotalPrice();
            loadCart();
            $('#total-price').text('RP ' + response.totalPrice('id-ID'));

        },
        error: function (xhr, status, error) {
            console.log("Terjadi kesalahan: " + error);
        }
    });
}

function update_cart() {
    var itemId = $('#item_id').val();
    var qty = $('#qty').val();

    $.ajax({
        url: "{{ route('updateCart') }}",
        method: "POST",
        data: {
            item_id: itemId,
            qty: qty,
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            console.log('Jumlah item berhasil diperbarui');
            $('#modalUbah').modal('hide');
            loadCart();
        },
        error: function (xhr, status, error) {
            console.log("Terjadi kesalahan: " + error);
        }
    });
}

function deleteItem(itemId) {
    $.ajax({
        url: "{{ route('deleteItem') }}",
        method: "POST",
        data: {
            item_id: itemId,
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            alert(response.message);

            $('#item-' + itemId).remove();
            loadCart();

        },
        error: function (xhr, status, error) {
            console.error(error);
            alert('Terjadi kesalahan saat menghapus item');
        }
    });
}

function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);

    ribuan = ribuan.join('.').split('').reverse().join('');
    return 'Rp ' + ribuan;
}