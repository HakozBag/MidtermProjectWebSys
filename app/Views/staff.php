<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap align-items-center pt-3 pb-2 mb-3 border-bottom gap-2">
    <h1 class="h2">Staff Management</h1>
    <a href="<?= base_url('signup') ?>" class="btn btn-primary">
        <i class="fas fa-user-plus me-1" aria-hidden="true"></i> Register New Staff
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Registered Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($staffList)): ?>
                        <?php foreach ($staffList as $staff): ?>
                            <tr>
                                <td><?= esc($staff['id']) ?></td>
                                <td>
                                    <?php if (! empty($staff['avatar'])): ?>
                                        <img src="<?= esc(base_url('uploads/avatars/' . $staff['avatar']), 'attr') ?>"
                                             alt="Avatar for <?= esc($staff['full_name'], 'attr') ?>"
                                             class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                    <?php else: ?>
                                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary"
                                              style="width:40px;height:40px;" aria-label="No avatar">
                                            <i class="fas fa-user text-white" aria-hidden="true"></i>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($staff['full_name']) ?></td>
                                <td><?= esc($staff['email']) ?></td>
                                <td><?= esc($staff['username']) ?></td>
                                <td><?= esc($staff['created_at']) ?></td>
                                <td class="text-nowrap">
                                    <button type="button" class="btn btn-sm btn-warning me-1"
                                            data-bs-toggle="modal" data-bs-target="#editStaff<?= (int) $staff['id'] ?>"
                                            aria-label="Edit <?= esc($staff['full_name'], 'attr') ?>">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                    <?php if ((int) $staff['id'] !== (int) $currentUserId): ?>
                                        <button type="button" class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteStaff<?= (int) $staff['id'] ?>"
                                                aria-label="Delete <?= esc($staff['full_name'], 'attr') ?>">
                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">No staff members found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach ($staffList ?? [] as $staff): ?>
    <div class="modal fade" id="editStaff<?= (int) $staff['id'] ?>" tabindex="-1"
         aria-labelledby="editStaffTitle<?= (int) $staff['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background:#111827;color:#f8fafc;border:1px solid rgba(6,182,212,.3);">
                <form action="<?= base_url('staff/update/' . (int) $staff['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header border-secondary">
                        <h2 class="modal-title h5" id="editStaffTitle<?= (int) $staff['id'] ?>">Edit Staff</h2>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="staffName<?= (int) $staff['id'] ?>" class="form-label">Full Name</label>
                            <input id="staffName<?= (int) $staff['id'] ?>" name="full_name" type="text" class="form-control"
                                   value="<?= esc($staff['full_name'], 'attr') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="staffEmail<?= (int) $staff['id'] ?>" class="form-label">Email</label>
                            <input id="staffEmail<?= (int) $staff['id'] ?>" name="email" type="email" class="form-control"
                                   value="<?= esc($staff['email'], 'attr') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="staffUsername<?= (int) $staff['id'] ?>" class="form-label">Username</label>
                            <input id="staffUsername<?= (int) $staff['id'] ?>" name="username" type="text" class="form-control"
                                   value="<?= esc($staff['username'], 'attr') ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if ((int) $staff['id'] !== (int) $currentUserId): ?>
        <div class="modal fade" id="deleteStaff<?= (int) $staff['id'] ?>" tabindex="-1"
             aria-labelledby="deleteStaffTitle<?= (int) $staff['id'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background:#111827;color:#f8fafc;border:1px solid rgba(6,182,212,.3);">
                    <form action="<?= base_url('staff/delete/' . (int) $staff['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-header border-secondary">
                            <h2 class="modal-title h5" id="deleteStaffTitle<?= (int) $staff['id'] ?>">Delete Staff Account</h2>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Delete <strong><?= esc($staff['full_name']) ?></strong>? This cannot be undone.
                        </div>
                        <div class="modal-footer border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?= $this->endSection() ?>
