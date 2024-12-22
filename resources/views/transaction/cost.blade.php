<script>
    window.addEventListener('load', loadCost);
    let totalCost = 0;

    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
    }
    
    function loadCost() {
        $.ajax({
            url: "{{ route('transaction.loadCost') }}",
            method: "GET",
            success: function (dataCost) {
                var costHTML = '';
                var counter = 1;
                totalCost = 0;
                dataCost.forEach(function (cost) {
                    var TotalCost = cost.price * cost.qty;
                    totalCost += TotalCost;
                    var formattedCost = formatRupiah(cost.price);
                    var formattedTotalCost = formatRupiah(TotalCost);
                    costHTML += `<tr id="item-${cost.item_id}">
                    <td>${counter}</td>
                    <td>${cost.nama_item}</td>
                    <td>${cost.qty}</td>
                    <td>${cost.satuan}</td>
                    <td>${formattedCost}</td>
                    <td>${formattedTotalCost}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" type="button" onclick="openModalCost(${cost.item_id}, ${cost.qty})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteCost(${cost.item_id})"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>`;
                    counter++;
                });
                $('#costTable tbody').html(costHTML);
                updateTotalCost();
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
        var totalCost = price * qty;
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
                total_cost: totalCost
            },
            success: function (dataCost) {
                $('#modalCost').modal('hide');
                updateTotalCost();
                loadCost();
                $('#total-cost').text('RP ' + response.totalCost('id-ID'));
            },
            error: function (xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }

    function update_cost() {
        var itemId = $('#item_id').val();
        var qtyCost = $('#qtyCost').val();

        $.ajax({
            url: "{{ route('updateCost') }}",
            method: "POST",
            data: {
                item_id: itemId,
                qty: qtyCost,
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
                loadCart();
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('Terjadi kesalahan saat menghapus cost');
            }
        });
    }
    
    function updateTotalCost() {
        const formattedTotalCost = formatRupiah(totalCost);
        const GrossProfit = totalPrice - totalCost;
        const pph = totalPrice * 0.02;
        const formattedPPH = formatRupiah(pph); 
        const Profit = totalPrice - totalCost - pph;
        const formattedGrossProfit = formatRupiah(GrossProfit);
        const formattedProfit = formatRupiah(Profit);
        document.getElementById('total-cost').textContent = formattedTotalCost;
        document.getElementById('gross-profit').textContent = formattedGrossProfit;
        document.getElementById('pph23').textContent = formattedPPH;
        document.getElementById('profit').textContent = formattedProfit;
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadCost();
        updateTotalCost();
    });
    
    function openModalCost(itemId, qtyCost) {
        $('#item_id').val(itemId);
        $('#qtyCost').val(qtyCost);
        $('#modalUbahCost').modal('show');
    }
</script>