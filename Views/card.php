<div class="col-12 col-md-4 col-lg-3">
    <div class="card bg-body-secondary ">
        <img src="<?= $image ?>" class="card-img-top my-ratio" alt="<?= $title ?>">
        <div class="card-body">
            <h5 class="card-title">
                <?= $title ?>
            </h5>
            <p class="card-text">
                <?php if (isset($content)) {
                    echo $content;
                }
                ; ?>
            </p>
            <div class="d-flex justify-content-between align-items-flex-start">
                <?php if (isset($custom)) {
                    echo $custom;
                }
                ; ?>
                <div>
                    <small>
                        <img src="<?php if (isset($language)) {
                            echo $language;
                        }
                        ; ?>" alt="">
                    </small>
                </div>
                <p>
                    <?php if (isset($price)) {
                        echo $price;
                    }
                    ; ?>
                </p>
            </div>
        </div>
    </div>
</div>