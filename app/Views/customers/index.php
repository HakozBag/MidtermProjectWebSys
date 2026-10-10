<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <h1 style="margin: 0; font-size: 28px; font-weight: bold; color: #ffffff;">Customer Management</h1>
    <button type="button" class="button-link" style="margin: 0; padding: 10px 20px; font-size: 14px; cursor: pointer; border: none; border-radius: 6px;" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
        + Add New Customer
    </button>
</div>

<!-- Success and Error Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="success-message" style="background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid rgba(16, 185, 129, 0.4);"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="error-message" style="background: rgba(239, 68, 68, 0.2); color: #f87171; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.4);"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($customersList)): ?>
            <?php foreach ($customersList as $customer): ?>
                <tr>
                    <td><?= $customer['id'] ?></td>
                    <td><strong><?= esc($customer['full_name']) ?></strong></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                    <td><?= $customer['created_at'] ?></td>
                    <td>
                        <div class="actions" style="display: flex; gap: 8px;">
                            <!-- Edit Trigger Modal -->
                            <button type="button" class="button-link" style="padding: 6px 12px; font-size: 12px; cursor: pointer;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editCustomerModal"
                                data-id="<?= $customer['id'] ?>"
                                data-name="<?= esc($customer['full_name']) ?>"
                                data-email="<?= esc($customer['email']) ?>"
                                data-phone="<?= esc($customer['phone']) ?>">
                                Edit
                            </button>

                            <!-- Delete Trigger Modal -->
                            <button type="button" class="archive-button" style="padding: 6px 12px; font-size: 12px; cursor: pointer; background: #ef4444; color: white; border: none; border-radius: 6px;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteConfirmModal"
                                data-deleteurl="<?= base_url('customers/delete/' . $customer['id']) ?>">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center; color: #69778e; padding: 25px;">No customers found in the database.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #111827; border: 1px solid rgba(6, 182, 212, 0.3); color: #ffffff;">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('customers/store') ?>" method="post">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #111827; border: 1px solid rgba(6, 182, 212, 0.3); color: #ffffff;">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCustomerForm" method="post">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" id="editFullName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" id="editPhone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #111827; border: 1px solid rgba(239, 68, 68, 0.4); color: #ffffff;">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="fs-5 mb-0">Are you sure you want to delete this customer?</p>
                <p class="text-secondary small mt-1">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-top border-secondary justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger px-4">Confirm Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Handlers -->
<script>
    const editCustomerModal = document.getElementById('editCustomerModal');
    editCustomerModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');

        const form = document.getElementById('editCustomerForm');
        form.action = "<?= base_url('customers/update/') ?>" + id;

        document.getElementById('editFullName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPhone').value = phone;
    });

    const deleteConfirmModal = document.getElementById('deleteConfirmModal');
    deleteConfirmModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const deleteUrl = button.getAttribute('data-deleteurl');
        document.getElementById('confirmDeleteBtn').href = deleteUrl;
    });
</script>
<?= $this->endSection() ?>