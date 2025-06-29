<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Include jsPDF Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<style>
    .invoice-template {
        display: none;
        background: white;
        padding: 30px;
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #007bff;
    }
    
    .company-info h1 {
        color: #007bff;
        font-size: 28px;
        margin-bottom: 5px;
    }
    
    .invoice-number {
        text-align: right;
        color: #666;
    }
    
    .invoice-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }
    
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    
    .invoice-table th,
    .invoice-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .invoice-table th {
        background: #f8f9fa;
        font-weight: bold;
        color: #333;
    }
    
    .invoice-table .text-right {
        text-align: right;
    }
    
    .invoice-footer {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
        text-align: center;
        color: #666;
        font-size: 14px;
    }
    
    .btn-pdf {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 10px;
    }
    
    .btn-pdf:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
    }
</style>

<div class="row">
    <div class="col-lg-6">
        <!-- Vertical Form -->
      <?= form_open('buy', ['class' => 'row g-3', 'enctype' => 'multipart/form-data'], ['id' => 'checkout-form']) ?>

 <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga', 'value' => '']) ?>
        <div class="col-12">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo session()->get('username'); ?>">
        </div>
        <div class="col-12">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
        <div class="col-12">
            <label for="kelurahan" class="form-label">Kelurahan</label>
            <select class="form-control" id="kelurahan" name="kelurahan" required></select>
        </div>
        <div class="col-12">
            <label for="layanan" class="form-label">Layanan</label>
            <select class="form-control" id="layanan" name="layanan" required></select>
        </div>
        <div class="col-12">
            <label for="ongkir" class="form-label">Ongkir</label>
            <input type="text" class="form-control" id="ongkir" name="ongkir" readonly>
        </div>
        <div class="col-12">
    <label for="bukti_bayar" class="form-label">Upload Bukti Pembayaran</label>
    <input type="file" class="form-control" name="bukti_bayar" id="bukti_bayar" accept=".jpg,.jpeg,.png,.pdf" required>
</div>

    </div>
    <div class="col-lg-6">
        <!-- Vertical Form -->
        <div class="col-12">
            <!-- Default Table -->
            <table class="table" id="items-table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if (!empty($items)) :
                        foreach ($items as $index => $item) :
                    ?>
                            <tr>
                                <td><?php echo $item['name'] ?></td>
                                <td><?php echo number_to_currency($item['price'], 'IDR') ?></td>
                                <td><?php echo $item['qty'] ?></td>
                                <td><?php echo number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                    <tr>
                        <td colspan="2"></td>
                        <td>Subtotal</td>
                        <td><?php echo number_to_currency($total, 'IDR') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Ongkir</td>
                        <td><span id="ongkir-display">IDR 0</span></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td><strong>Total</strong></td>
                        <td><strong><span id="total"><?php echo number_to_currency($total, 'IDR') ?></span></strong></td>
                    </tr>
                </tbody>
            </table>
            <!-- End Default Table Example -->
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Buat Pesanan</button>
            <button type="button" class="btn-pdf" onclick="generatePDF()">
                📄 Download Invoice PDF
            </button>
        </div>
        </form><!-- Vertical Form -->
    </div>
</div>

<!-- Hidden Invoice Template for PDF Generation -->
<div id="invoice-template" class="invoice-template">
    <div class="invoice-header">
        <div class="company-info">
            <h1>TOKO SEMARANG JAYA</h1>
            <p>Jl. Contoh No. 123, Semarang</p>
            <p>Telp: (024) 123-4567</p>
            <p>Email: info@tokosemarangjaya.com</p>
        </div>
        <div class="invoice-number">
            <h2>INVOICE</h2>
            <p><strong>No: <span id="invoice-no">INV-<?= date('Ymd') ?>-001</span></strong></p>
            <p>Tanggal: <span id="invoice-date"><?= date('d/m/Y') ?></span></p>
        </div>
    </div>

    <div class="invoice-details">
        <div class="bill-to">
            <h4>Tagihan Kepada:</h4>
            <p><strong><span id="customer-name">-</span></strong></p>
            <p><span id="customer-address">-</span></p>
            <p><span id="customer-location">-</span></p>
        </div>
        <div class="ship-to">
            <h4>Dikirim Ke:</h4>
            <p><strong><span id="ship-name">-</span></strong></p>
            <p><span id="ship-address">-</span></p>
            <p><span id="ship-location">-</span></p>
            <p>Layanan: <span id="shipping-service">-</span></p>
        </div>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Sub Total</th>
            </tr>
        </thead>
        <tbody id="invoice-items">
            <!-- Items will be populated by JavaScript -->
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                <td class="text-right"><strong><span id="invoice-subtotal">-</span></strong></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>Ongkos Kirim:</strong></td>
                <td class="text-right"><strong><span id="invoice-shipping">-</span></strong></td>
            </tr>
            <tr style="border-top: 2px solid #333;">
                <td colspan="4" class="text-right" style="font-size: 18px;"><strong>TOTAL:</strong></td>
                <td class="text-right" style="font-size: 18px;"><strong><span id="invoice-total">-</span></strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="invoice-footer">
        <p><strong>Terima kasih atas pembelian Anda!</strong></p>
        <p>Untuk pertanyaan, hubungi kami di (024) 123-4567 atau info@tokosemarangjaya.com</p>
        <p><em>Invoice ini dibuat secara otomatis oleh sistem</em></p>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        var ongkir = 0;
        var total = 0;
        var selectedService = '';
        var selectedLocation = '';
        
        hitungTotal();

        $('#kelurahan').select2({
            placeholder: 'Ketik nama kelurahan...',
            ajax: {
                url: '<?= base_url('get-location') ?>',
                dataType: 'json',
                delay: 1500,
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.subdistrict_name + ", " + item.district_name + ", " + item.city_name + ", " + item.province_name + ", " + item.zip_code
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 3
        });

        $("#kelurahan").on('change', function() {
            var id_kelurahan = $(this).val();
            selectedLocation = $('#kelurahan option:selected').text();
            $("#layanan").empty();
            ongkir = 0;

            $.ajax({
                url: "<?= site_url('get-cost') ?>",
                type: 'GET',
                data: {
                    'destination': id_kelurahan,
                },
                dataType: 'json',
                success: function(data) {
                    data.forEach(function(item) {
                        var text = item["description"] + " (" + item["service"] + ") : estimasi " + item["etd"] + "";
                        $("#layanan").append($('<option>', {
                            value: item["cost"],
                            text: text,
                            'data-service': item["description"] + " (" + item["service"] + ")"
                        }));
                    });
                    hitungTotal();
                },
            });
        });

        $("#layanan").on('change', function() {
            ongkir = parseInt($(this).val()) || 0;
            selectedService = $(this).find(':selected').data('service') || '';
            hitungTotal();
        });

        function hitungTotal() {
            total = ongkir + <?= $total ?>;

            $("#ongkir").val(ongkir);
            $("#ongkir-display").html("IDR " + ongkir.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            $("#total").html("IDR " + total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            $("#total_harga").val(total);
        }

        // Fixed form submit handler
        $('#checkout-form').on('submit', function(e) {
            e.preventDefault();
            
            // Validate required fields
            if (!$('#nama').val().trim()) {
                alert('Mohon isi nama!');
                $('#nama').focus();
                return;
            }
            
            if (!$('#alamat').val().trim()) {
                alert('Mohon isi alamat!');
                $('#alamat').focus();
                return;
            }
            
            if (!$('#kelurahan').val()) {
                alert('Mohon pilih kelurahan!');
                $('#kelurahan').focus();
                return;
            }
            
            if (!$('#layanan').val()) {
                alert('Mohon pilih layanan pengiriman!');
                $('#layanan').focus();
                return;
            }
            
            // Validate file upload
            if (!$('#bukti_bayar')[0].files[0]) {
                alert('Mohon upload bukti pembayaran!');
                $('#bukti_bayar').focus();
                return;
            }
            
            // Validate file size (max 5MB)
            const fileSize = $('#bukti_bayar')[0].files[0].size;
            if (fileSize > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 5MB.');
                $('#bukti_bayar').focus();
                return;
            }
            
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
            const fileType = $('#bukti_bayar')[0].files[0].type;
            if (!allowedTypes.includes(fileType)) {
                alert('Format file tidak didukung! Gunakan JPG, PNG, atau PDF.');
                $('#bukti_bayar').focus();
                return;
            }
            
            // Show confirmation
            if (confirm('Apakah Anda yakin ingin membuat pesanan ini?')) {
                // Disable submit button to prevent double submission
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Memproses...');
                
                // Create FormData for file upload
                const formData = new FormData(this);
                
                // Submit form via AJAX
                $.ajax({
                    url: $(this).attr('action') || '<?= base_url('buy') ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('Pesanan berhasil dibuat!');
                        
                        // Generate PDF after successful submission
                        generatePDF();
                        
                        // Optional: redirect or reset form
                        // window.location.href = '<?= base_url('success') ?>';
                        
                        // Re-enable button
                        submitBtn.prop('disabled', false).text(originalText);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.');
                        
                        // Re-enable button
                        submitBtn.prop('disabled', false).text(originalText);
                    }
                });
            }
        });
        
        // Handle PDF button separately
        $('.btn-pdf').on('click', function() {
            generatePDF();
        });
    });

    function generatePDF() {
        // Validate required data
        if (!$('#nama').val() || !$('#alamat').val()) {
            alert('Mohon isi nama dan alamat terlebih dahulu!');
            return;
        }

        // Populate invoice template with current data
        populateInvoiceTemplate();
        
        // Show the template temporarily for PDF generation
        $('#invoice-template').show();
        
        // Generate PDF using jsPDF
        const { jsPDF } = window.jspdf;
        
        html2canvas(document.getElementById('invoice-template'), {
            scale: 2,
            useCORS: true,
            allowTaint: true,
            backgroundColor: '#ffffff'
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });
            
            const imgWidth = 210;
            const pageHeight = 295;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;
            let position = 0;
            
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
            
            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
            
            // Generate filename with timestamp
            const timestamp = new Date().toISOString().slice(0, 19).replace(/[:-]/g, '');
            const filename = `Invoice_${$('#nama').val().replace(/\s+/g, '_')}_${timestamp}.pdf`;
            
            pdf.save(filename);
            
            // Hide the template again
            $('#invoice-template').hide();
            
            alert('Invoice PDF berhasil di-download!');
        }).catch(error => {
            console.error('Error generating PDF:', error);
            alert('Terjadi error saat generate PDF. Silakan coba lagi.');
            $('#invoice-template').hide();
        });
    }

    function populateInvoiceTemplate() {
        // Generate invoice number
        const timestamp = Date.now().toString().slice(-6);
        $('#invoice-no').text(`INV-<?= date('Ymd') ?>-${timestamp}`);
        
        // Customer info
        $('#customer-name').text($('#nama').val() || '-');
        $('#customer-address').text($('#alamat').val() || '-');
        $('#customer-location').text($('#kelurahan option:selected').text() || '-');
        
        // Shipping info (same as customer for this example)
        $('#ship-name').text($('#nama').val() || '-');
        $('#ship-address').text($('#alamat').val() || '-');
        $('#ship-location').text($('#kelurahan option:selected').text() || '-');
        $('#shipping-service').text($('#layanan option:selected').text() || '-');
        
        // Populate items
        let itemsHTML = '';
        let no = 1;
        
        $('#items-table tbody tr').each(function() {
            const cells = $(this).find('td');
            if (cells.length === 4 && !$(this).find('td:first').attr('colspan')) {
                const name = cells.eq(0).text();
                const price = cells.eq(1).text();
                const qty = cells.eq(2).text();
                const subtotal = cells.eq(3).text();
                
                itemsHTML += `
                    <tr>
                        <td>${no}</td>
                        <td>${name}</td>
                        <td class="text-right">${price}</td>
                        <td class="text-right">${qty}</td>
                        <td class="text-right">${subtotal}</td>
                    </tr>
                `;
                no++;
            }
        });
        
        $('#invoice-items').html(itemsHTML);
        
        // Totals
        $('#invoice-subtotal').text('<?= number_to_currency($total, 'IDR') ?>');
        $('#invoice-shipping').text($('#ongkir-display').text());
        $('#invoice-total').text($('#total').text());
    }
</script>
<?= $this->endSection() ?>