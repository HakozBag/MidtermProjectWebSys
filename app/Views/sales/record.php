<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Record New Sale</h1>

<div class="row">
    <!-- Item Selection Form -->
    <div class="col-md-7">
        <div class="card p-4">
            <h3 class="mb-3">Transaction Details</h3>
            
            <form action="<?= base_url('sales/process') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Select Customer (Optional)</label>
                    <select name="customer_id" class="form-select">
                        <option value="">Walk-in Customer</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer['id'] ?>"><?= esc($customer['full_name']) ?> (<?= esc($customer['phone']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Product</label>
                    <select name="product_id" id="productSelect" class="form-select" required>
                        <option value="" data-price="0" data-stock="0">-- Choose Product --</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product['id'] ?>" data-price="<?= $product['price'] ?>" data-stock="<?= $product['stock_quantity'] ?>">
                                <?= esc($product['name']) ?> - ₱<?= number_format($product['price'], 2) ?> (Stock: <?= $product['stock_quantity'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantityInput" class="form-control" value="1" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3">
                    <i class="fas fa-check-circle me-2"></i> Complete Transaction
                </button>
            </form>
        </div>
    </div>

    <!-- Live Calculation Summary Card -->
    <div class="col-md-5">
        <div class="card p-4">
            <h3 class="mb-3">Order Summary</h3>
            <hr style="border-color: rgba(255,255,255,0.1);">
            
            <div class="d-flex justify-content-between mb-2">
                <span class="text-secondary">Unit Price:</span>
                <span class="fw-bold" id="unitPriceDisplay">₱0.00</span>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span class="text-secondary">Available Stock:</span>
                <span class="fw-bold" id="stockDisplay">0</span>
            </div>

            <hr style="border-color: rgba(255,255,255,0.1);">

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4>Total Due:</h4>
                <h2 class="text-success mb-0" id="totalPriceDisplay">₱0.00</h2>
            </div>
        </div>
    </div>
</div>

<!-- Inline script for live calculations -->
<script>
    const productSelect = document.getElementById('productSelect');
    const quantityInput = document.getElementById('quantityInput');
    const unitPriceDisplay = document.getElementById('unitPriceDisplay');
    const stockDisplay = document.getElementById('stockDisplay');
    const totalPriceDisplay = document.getElementById('totalPriceDisplay');

    function updateSummary() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        const stock = selectedOption.getAttribute('data-stock') || 0;
        const qty = parseInt(quantityInput.value) || 0;

        unitPriceDisplay.textContent = '₱' + price.toFixed(2);
        stockDisplay.textContent = stock;
        totalPriceDisplay.textContent = '₱' + (price * qty).toFixed(2);
    }

    productSelect.addEventListener('change', updateSummary);
    quantityInput.addEventListener('input', updateSummary);
</script>
<?= $this->endSection() ?>