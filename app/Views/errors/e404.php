<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <img src="<?= base_url() . '/404.png' ?>" class="img-style w-100" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4><b><?= $errorMsg ?? 'OOOPS, THIS PAGE COULD NOT BE FOUND!' ?></b></h4>
                        <p>The page you are looking for might have been removed, had its name changed, or is
                            temporarily unavailable.</p>
                        <a href="<?= base_url() ?>">
                            <button class="btn btn-outline-primary">Back to home</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>