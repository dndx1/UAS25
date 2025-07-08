<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Include jsPDF Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<style>
    /* Invoice Template Styles */
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
    
    /* Button Styles */
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

<!-- Main Content -->
<div class="row">
    <!-- Left Column - Form -->
    <div class="col-lg-6">
        <?= form_open('buy', ['class' => 'row g-3', 'enctype' => 'multipart/form-data', 'id' => 'checkout-form']) ?>
        
        <!-- Hidden Fields -->
        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga', 'value' => '']) ?>
        
        <!-- Customer Information -->
        <div class="col-12">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" 
                   value="<?= session()->get('username') ?>" required>
        </div>
        
        <div class="col-12">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        
        <div class="col-12">
            <label for="kelurahan" class="form-label">Kelurahan</label>
            <select class="form-control" id="kelurahan" name="kelurahan" required>
                <option value="">Pilih Kelurahan...</option>
            </select>
        </div>
        
        <!-- Shipping Information -->
        <div class="col-12">
            <label for="layanan" class="form-label">Layanan</label>
            <select class="form-control" id="layanan" name="layanan" required>
                <option value="">Pilih Layanan...</option>
            </select>
        </div>
        
        <div class="col-12">
            <label for="ongkir" class="form-label">Ongkir</label>
            <input type="text" class="form-control" id="ongkir" name="ongkir" readonly>
        </div>
        
        <!-- Payment Proof -->
        <div class="col-12">
            <label for="bukti_bayar" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" class="form-control" name="bukti_bayar" id="bukti_bayar" 
                   accept=".jpg,.jpeg,.png,.pdf" required>
        </div>
        
        <!-- Submit Button -->
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" id="submit-btn">Buat Pesanan</button>
        </div>
        
        <?= form_close() ?>
    </div>
    
    <!-- Right Column - Order Summary -->
    <div class="col-lg-6">
        <div class="col-12">
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
                    <!-- Cart Items -->
                    <?php if (!empty($items)) : ?>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td><?= $item['name'] ?></td>
                                <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                    <!-- Order Summary -->
                    <tr>
                        <td colspan="2"></td>
                        <td>Subtotal</td>
                        <td><?= number_to_currency($total, 'IDR') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Ongkir</td>
                        <td><span id="ongkir-display">IDR 0</span></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td><strong>Total</strong></td>
                        <td><strong><span id="total"><?= number_to_currency($total, 'IDR') ?></span></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Invoice Template (Hidden) -->
<div id="invoice-template" class="invoice-template">
    <!-- Invoice Header -->
    <div class="invoice-header">
        <div class="company-info">
            <h1>Blangkis</h1>
            <p>Jl. Contoh No. 123, Semarang</p>
            <p>Telp: (024) 123-4567</p>
            <p>Email: info@Blangkis.com</p>
        </div>
        <div class="invoice-number">
            <h2>INVOICE</h2>
            <p><strong>No: <span id="invoice-no">INV-<?= date('Ymd', strtotime('+7 hours')) ?>-001</span></strong></p>
            <p>Tanggal: <span id="invoice-date"><?= date('d/m/Y', strtotime('+7 hours')) ?></span></p>
        </div>
    </div>

    <!-- Invoice Details -->
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

    <!-- Invoice Items Table -->
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

    <!-- Invoice Footer -->
    <div class="invoice-footer">
        <p><strong>Terima kasih atas pembelian Anda!</strong></p>
        <p>Untuk pertanyaan, hubungi kami di (024) 123-4567 atau info@Blangkis.com</p>
        <p><em>Invoice ini dibuat secara otomatis oleh sistem</em></p>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    // Global Variables
    let ongkir = 0;
    let total = 0;
    let selectedService = '';
    let selectedLocation = '';
    
    // Initialize
    calculateTotal();
    initializeSelect2();
    
    // Event Handlers
    setupEventHandlers();
    
    /**
     * Initialize Select2 for Kelurahan dropdown
     */
    function initializeSelect2() {
        $('#kelurahan').select2({
            placeholder: 'Ketik nama kelurahan...',
            ajax: {
                url: '<?= base_url('get-location') ?>',
                dataType: 'json',
                delay: 1500,
                data: function(params) {
                    return { search: params.term };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: `${item.subdistrict_name}, ${item.district_name}, ${item.city_name}, ${item.province_name}, ${item.zip_code}`
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 3
        });
    }
    
    /**
     * Setup all event handlers
     */
    function setupEventHandlers() {
        // Kelurahan change handler
        $('#kelurahan').on('change', handleKelurahanChange);
        
        // Layanan change handler
        $('#layanan').on('change', handleLayananChange);
        
        // Form submit handler
        $('#checkout-form').on('submit', handleFormSubmit);
    }
    
    /**
     * Handle kelurahan selection change
     */
    function handleKelurahanChange() {
        const id_kelurahan = $(this).val();
        selectedLocation = $('#kelurahan option:selected').text();
        
        // Reset layanan dropdown
        $('#layanan').empty().append('<option value="">Pilih Layanan...</option>');
        ongkir = 0;

        if (id_kelurahan) {
            fetchShippingCost(id_kelurahan);
        }
        
        calculateTotal();
    }
    
    /**
     * Handle layanan selection change
     */
    function handleLayananChange() {
        ongkir = parseInt($(this).val()) || 0;
        selectedService = $(this).find(':selected').data('service') || '';
        calculateTotal();
    }
    
    /**
     * Fetch shipping cost from API
     */
    function fetchShippingCost(destination) {
        $.ajax({
            url: '<?= site_url('get-cost') ?>',
            type: 'GET',
            data: { destination: destination },
            dataType: 'json',
            success: function(data) {
                if (data && data.length > 0) {
                    data.forEach(function(item) {
                        const text = `${item.description} (${item.service}) : estimasi ${item.etd}`;
                        $('#layanan').append($('<option>', {
                            value: item.cost,
                            text: text,
                            'data-service': `${item.description} (${item.service})`
                        }));
                    });
                }
                calculateTotal();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching shipping cost:', error);
                alert('Gagal mengambil data ongkir. Silakan coba lagi.');
            }
        });
    }
    
    /**
     * Calculate and update total
     */
    function calculateTotal() {
        total = ongkir + <?= $total ?>;

        $('#ongkir').val(ongkir);
        $('#ongkir-display').html(formatCurrency(ongkir));
        $('#total').html(formatCurrency(total));
        $('#total_harga').val(total);
    }
    
    /**
     * Format number to currency
     */
    function formatCurrency(amount) {
        return 'IDR ' + amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    
    /**
     * Get current Indonesian time
     */
    function getCurrentIndonesianTime() {
    return new Date(); // Ambil waktu lokal
}


console.log("Real local:", new Date());
console.log("Asia/Jakarta:", getCurrentIndonesianTime());
    
    /**
     * Format date to Indonesian format
     */
    function formatIndonesianDate(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }
    
    /**
     * Format date for invoice number
     */
    function formatDateForInvoice(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${year}${month}${day}`;
    }
    
    /**
     * Validate form data
     */
    function validateForm(skipFileValidation = false) {
        const validations = [
            { field: '#nama', message: 'Mohon isi nama!' },
            { field: '#alamat', message: 'Mohon isi alamat!' },
            { field: '#kelurahan', message: 'Mohon pilih kelurahan!' },
            { field: '#layanan', message: 'Mohon pilih layanan pengiriman!' }
        ];
        
        // Check basic fields
        for (const validation of validations) {
            if (!$(validation.field).val()?.trim()) {
                alert(validation.message);
                $(validation.field).focus();
                return false;
            }
        }
        
        // File validation
        if (!skipFileValidation) {
            const fileInput = $('#bukti_bayar')[0];
            if (!fileInput.files[0]) {
                alert('Mohon upload bukti pembayaran!');
                $('#bukti_bayar').focus();
                return false;
            }
            
            if (!validateFile(fileInput.files[0])) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Validate uploaded file
     */
    function validateFile(file) {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal 5MB.');
            return false;
        }
        
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung! Gunakan JPG, PNG, atau PDF.');
            return false;
        }
        
        return true;
    }
    
    /**
     * Handle form submission
     */
    function handleFormSubmit(e) {
        e.preventDefault();
        
        if (!validateForm()) return false;
        
        if (!confirm('Apakah Anda yakin ingin membuat pesanan ini?')) return false;
        
        const submitBtn = $('#submit-btn');
        const originalText = submitBtn.text();
        
        // Disable submit button
        submitBtn.prop('disabled', true).text('Memproses...');
        
        // Submit form
        $.ajax({
            url: $(this).attr('action') || '<?= base_url('buy') ?>',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                // Generate PDF after successful submission
                generatePDF(true)
                    .then(() => {
                        alert('Pesanan berhasil dibuat dan Invoice telah di-download!');
                        // Redirect back to checkout page
                        window.location.href = '<?= base_url('keranjang') ?>';
                    })
                    .catch(error => {
                        console.error('PDF generation failed:', error);
                        alert('Pesanan berhasil dibuat, tetapi gagal men-download invoice.');
                        // Redirect back to checkout page even if PDF failed
                        window.location.href = '<?= base_url('checkout') ?>';
                    })
                    .finally(() => {
                        submitBtn.prop('disabled', false).text(originalText);
                    });
            },
            error: function(xhr, status, error) {
                console.error('Form submission error:', error);
                alert('Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.');
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    }
    
    /**
     * Generate PDF Invoice
     */
    function generatePDF(isAutoDownload = false) {
        return new Promise((resolve, reject) => {
            // Validate required libraries
            if (typeof window.jspdf === 'undefined' || typeof html2canvas === 'undefined') {
                reject(new Error('Required libraries not loaded'));
                return;
            }
            
            // Validate required data
            if (!$('#nama').val() || !$('#alamat').val()) {
                reject(new Error('Nama dan alamat harus diisi!'));
                return;
            }
            
            try {
                // Populate and show invoice template
                populateInvoiceTemplate();
                $('#invoice-template').show();
                
                // Generate PDF
                setTimeout(() => {
                    const element = document.getElementById('invoice-template');
                    
                    html2canvas(element, {
                        scale: 2,
                        useCORS: true,
                        allowTaint: true,
                        backgroundColor: '#ffffff',
                        width: element.offsetWidth,
                        height: element.offsetHeight
                    }).then(canvas => {
                        try {
                            const { jsPDF } = window.jspdf;
                            const pdf = new jsPDF('portrait', 'mm', 'a4');
                            
                            const imgData = canvas.toDataURL('image/png');
                            const imgWidth = 210;
                            const imgHeight = (canvas.height * imgWidth) / canvas.width;
                            
                            pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                            
                            // Generate filename with Indonesian time
                            const indonesianTime = getCurrentIndonesianTime();
                            const yyyy = indonesianTime.getFullYear();
const mm = String(indonesianTime.getMonth() + 1).padStart(2, '0');
const dd = String(indonesianTime.getDate()).padStart(2, '0');
const hh = String(indonesianTime.getHours()).padStart(2, '0');
const mi = String(indonesianTime.getMinutes()).padStart(2, '0');
const ss = String(indonesianTime.getSeconds()).padStart(2, '0');

const timestamp = `${yyyy}${mm}${dd}${hh}${mi}${ss}`;

                            const customerName = $('#nama').val().replace(/[^a-zA-Z0-9]/g, '_');
                            const filename = `Invoice_${customerName}_${timestamp}.pdf`;
                            
                            pdf.save(filename);
                            $('#invoice-template').hide();
                            
                            if (!isAutoDownload) {
                                alert('Invoice PDF berhasil di-download!');
                            }
                            
                            resolve();
                        } catch (error) {
                            $('#invoice-template').hide();
                            reject(error);
                        }
                    }).catch(error => {
                        $('#invoice-template').hide();
                        reject(error);
                    });
                }, 200);
                
            } catch (error) {
                $('#invoice-template').hide();
                reject(error);
            }
        });
    }
    
    /**
     * Populate invoice template with form data
     */
    function populateInvoiceTemplate() {
        // Get current Indonesian time
        const indonesianTime = getCurrentIndonesianTime();
        
        // Generate invoice number with Indonesian time
        const dateForInvoice = formatDateForInvoice(indonesianTime);
        const timestamp = Date.now().toString().slice(-6);
        const invoiceNo = `INV-${dateForInvoice}-${timestamp}`;
        $('#invoice-no').text(invoiceNo);
        
        // Set current date in Indonesian format
        $('#invoice-date').text(formatIndonesianDate(indonesianTime));
        
        // Customer information
        const customerName = $('#nama').val() || '-';
        const customerAddress = $('#alamat').val() || '-';
        const customerLocation = $('#kelurahan option:selected').text() || '-';
        const shippingService = $('#layanan option:selected').text() || '-';
        
        $('#customer-name, #ship-name').text(customerName);
        $('#customer-address, #ship-address').text(customerAddress);
        $('#customer-location, #ship-location').text(customerLocation);
        $('#shipping-service').text(shippingService);
        
        // Populate items
        let itemsHTML = '';
        let itemNo = 1;
        
        $('#items-table tbody tr').each(function() {
            const cells = $(this).find('td');
            if (cells.length === 4 && !cells.first().attr('colspan')) {
                const name = cells.eq(0).text().trim();
                const price = cells.eq(1).text().trim();
                const qty = cells.eq(2).text().trim();
                const subtotal = cells.eq(3).text().trim();
                
                if (name && price && qty && subtotal) {
                    itemsHTML += `
                        <tr>
                            <td>${itemNo}</td>
                            <td>${name}</td>
                            <td class="text-right">${price}</td>
                            <td class="text-right">${qty}</td>
                            <td class="text-right">${subtotal}</td>
                        </tr>
                    `;
                    itemNo++;
                }
            }
        });
        
        $('#invoice-items').html(itemsHTML);
        
        // Set totals
        $('#invoice-subtotal').text('<?= number_to_currency($total, 'IDR') ?>');
        $('#invoice-shipping').text($('#ongkir-display').text());
        $('#invoice-total').text($('#total').text());
    }
});
</script>
<?= $this->endSection() ?>