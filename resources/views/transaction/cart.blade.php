<script>
    window.addEventListener('load', loadCart);
    let totalPrice = 0;

    function formatRupiah(angka) {
        const number = Number(angka);
        if (isNaN(number)) {
            return 'Rp 0';
        }
        return number.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
    }

    function loadCart() {
        $.ajax({
            url: "{{ route('transaction.loadCart') }}",
            method: "GET",
            success: function (data) {
                var cartHTML = '';
                var counter = 1;
                totalPrice = 0;
                data.forEach(function (item) {
                var TotalPrice = item.price * item.qty;
                totalPrice += TotalPrice;
                var formattedPrice = formatRupiah(Number(item.price));
                var formattedTotalPrice = formatRupiah(Number(TotalPrice));
                    cartHTML += `<tr id="item-${item.item_id}">
                            <td>${counter}</td>
                            <td>${item.nama_item}</td>
                            <td>${item.qty}</td>
                            <td>${item.satuan}</td>
                            <td>${formattedPrice}</td>
                            <td>${formattedTotalPrice}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" type="button" onclick="openModal(${item.item_id}, ${item.qty})"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" type="button" onclick="deleteItem(${item.item_id})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;
                    counter++;
                });
                $('#cartTable tbody').html(cartHTML);
                updateTotalPrice();
            updateTaxValue();
            updateTotalCost();
            },
            error: function (xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function add_cart(item_id, name, satuan) {
        var price = document.getElementById('price-' + item_id).value;
        if (price === "" || price <= 0) {
            alert("Silahkan Masukkan Harga!");
            return;
        }
        price = parseInt(price.replace(/[^0-9]/g, ''), 10);
        var totalPrice = price * qty;
        $.ajax({
            url: "{{ route('addItem') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                item_id: item_id,
                nama_item: name,
                qty: 1,
                satuan: satuan,
                price,
                total_price: totalPrice
            },
            success: function (data) {
                $('#modalCart').modal('hide');
                updateTotalPrice();
        updateTaxValue();
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


    function updateTaxValue() {
        const selectedTax = parseFloat(document.querySelector('input[name="tax"]:checked').value) || 0;
        const taxLabel = document.getElementById('tax-label');
        
        if (selectedTax === 0) {
            taxLabel.textContent = 'No PPN';
        } else {
            taxLabel.textContent = `TAX ${selectedTax}%`;
        }

        const taxAmount = (totalPrice * selectedTax) / 100;
        const formattedTax = formatRupiah(taxAmount);
        document.getElementById('tax-value').textContent = formattedTax;
        document.getElementById('tax-price-input').value = taxAmount;
        updateTotalPrice();
        updateTotalCost();
    }

    function updateTotalPrice() {
        const selectedTaxPercentage = parseFloat(document.querySelector('input[name="tax"]:checked').value) || 0;
        const taxAmount = (totalPrice * selectedTaxPercentage) / 100;
        const grandTotal = totalPrice + taxAmount;
        const formattedTotalPrice = formatRupiah(totalPrice);
        const formattedGrandTotal = formatRupiah(grandTotal);
        document.getElementById('total-harga').textContent = formattedTotalPrice;
        document.getElementById('grand-total').textContent = formattedGrandTotal;
    }

    const taxRadios = document.querySelectorAll('.tax-radio');
    taxRadios.forEach(radio => {
        radio.addEventListener('change', updateTaxValue);
    });

    document.addEventListener('DOMContentLoaded', () => {
        loadCart();
        updateTaxValue();
        updateTotalPrice();
    });

    function openModal(itemId, qty) {
        $('#item_id').val(itemId);
        $('#qty').val(qty);
        $('#modalUbah').modal('show');
    }

        // function formatRupiah(angka) {
        //     var reverse = angka.toString().split('').reverse().join(''),
        //         ribuan = reverse.match(/\d{1,3}/g);

        //     ribuan = ribuan.join('.').split('').reverse().join('');
        //     return 'Rp ' + ribuan;
        // }
</script>
