<div class="col-12 col-md-4 col-lg-3">
    <div class="card">
        <img src="<?= $image ?>" class="card-img-top my-ratio" alt="<?= $title ?>">
        <div class="card-body">
            <h5 class="card-title">
                <?= $title ?>
            </h5>
            <p class="card-text">
                <?= $content ?>
            </p>
            <div class="d-flex justify-content-between align-items-flex-start">
                <?= $custom ?>
                <div>
                    <small>
                        <img src="<?= $language ?>" alt="flag">
                    </small>
                </div>
            </div>
            <small>
                <?php include __DIR__ . '/../Model/Genre.php' ?>
            </small>
        </div>
    </div>
</div>