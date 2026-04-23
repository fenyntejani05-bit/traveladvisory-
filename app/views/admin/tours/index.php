<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold h3"><?= $data['page_title']; ?></h1>
    <a href="<?= BASEURL; ?>/admin/createTour" class="btn btn-dark rounded-pill px-4">
        <i class="fa-solid fa-plus me-2"></i> Add Tour
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Tour Name</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['tours'] as $tour): ?>
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="<?= $tour['image_url']; ?>" class="rounded-3 me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <span class="fw-bold"><?= $tour['title']; ?></span>
                            </div>
                        </td>
                        <td><?= $tour['location']; ?></td>
                        <td><?= $tour['duration']; ?></td>
                        <td><?= Formatter::currency($tour['price']); ?></td>
                        <td class="text-end pe-4">
                            <a href="<?= BASEURL; ?>/admin/editTour/<?= $tour['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill me-1"><i class="fa-solid fa-pen"></i></a>
                            <a href="<?= BASEURL; ?>/admin/deleteTour/<?= $tour['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Are you sure you want to delete?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>