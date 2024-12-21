<script>
    window.addEventListener('load', loadCost);

    function loadCost() {
        $.ajax({
            url: "{{ route('transaction.loadCost') }}",
            method: "GET",
            success: function (dataCost) {
                var costHTML = '';
                var counter = 1;
                var totalCost = 0;
                dataCost.forEach(function (cost) {
                    var costTotalPrice = cost.price * cost.qty;
                    totalCost += costTotalPrice;
                    var formattedPrice = formatRupiah(cost.price);
                    var formattedTotalPrice = formatRupiah(costTotalPrice);
                    costHTML += `<tr id="item-${cost.item_id}">
                    <td>${counter}</td>
                    <td>${cost.nama_item}</td>
                    <td>${cost.qty}</td>
                    <td>${cost.satuan}</td>
                    <td>${formattedPrice}</td>
                    <td>${formattedTotalPrice}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" type="button" onclick="openModalCost(${cost.item_id}, ${cost.qty})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteCost(${cost.item_id})"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>`;
                    counter++;
                });
                $('#costTable tbody').html(costHTML);
            },
            error: function (xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function add_cost(item_id, nama_item, satuan) {
        var price = document.getElementById('cost-price-' + item_id).value;
        if (price === "" || price <= 0) {
            alert("Silahkan Masukkan Harga!");
            return;
        }
        price = parseInt(price.replace(/[^0-9]/g, ''), 10);
        var qty = 1;
        var totalPriceCost = price * qty;

        $.ajax({
            url: "{{ route('addCost') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                item_id: item_id,
                nama_item: nama_item,
                qty: 1,
                satuan: satuan,
                price,
                total_price: totalPriceCost
            },
            success: function (dataCost) {
                $('#modalCost').modal('hide');
                loadCost();
            },
            error: function (xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function update_cost() {
        var itemId = $('#item_id').val();
        var qty = $('#qty').val();

        $.ajax({
            url: "{{ route('updateCost') }}",
            method: "POST",
            data: {
                item_id: itemId,
                qty: qty,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                console.log('Jumlah cost berhasil diperbarui');
                $('#modalUbahCost').modal('hide');
                loadCost();
            },
            error: function (xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function deleteCost(itemId) {
        $.ajax({
            url: "{{ route('deleteCost') }}",
            method: "POST",
            data: {
                item_id: itemId,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                alert(response.message);
                $('#item-' + itemId).remove();
                loadCost();
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('Terjadi kesalahan saat menghapus cost');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadCart();
        loadCost();
        updateTaxValue();
    });
    
    function openModalCost(itemId, qty) {
        $('#item_id').val(itemId);
        $('#qty').val(qty);
        $('#modalUbahCost').modal('show');
    }
</script>