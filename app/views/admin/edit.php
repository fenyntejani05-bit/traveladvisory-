<h1 class="fw-bold mb-4"><?= $data['page_title'] ?></h1>
<div class="card border-0 shadow-sm rounded-4" style="max-width: 600px;">
    <div class="card-body p-4">
        <form action="<?= BASEURL ?>/admin/updateStatus" method="POST">
            <!-- Kirim ID Transaksi secara tersembunyi -->
            <input type="hidden" name="id" value="<?= $data['tx']['id'] ?>">

            <div class="mb-3">
                <label class="form-label">Booking Code</label>
                <input type="text" class="form-control" value="<?= $data['tx']['order_id'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Total</label>
                <input type="text" class="form-control"
                    value="<?= Formatter::currency($data['tx']['total_amount']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Change Payment Status</label>
                <select name="status" class="form-select">
                    <option value="pending" <?= $data['tx']['payment_status'] == 'pending' ? 'selected' : '' ?>>Pending
                    </option>
                    <option value="paid" <?= $data['tx']['payment_status'] == 'paid' ? 'selected' : '' ?>>Paid
                    </option>
                    <option value="cancelled" <?= $data['tx']['payment_status'] == 'cancelled' ? 'selected' : '' ?>>
                        Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold mt-3">Update Transaction</button>
        </form>
    </div>
</div>
