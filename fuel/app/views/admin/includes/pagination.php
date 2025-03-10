<div class="d-flex justify-content-end w-100">
    <div class="wrap-paginate">
        <nav class="d-flex justify-items-center justify-content-between">
            <?php if ($total > 0): ?>
                <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                    <div class="me-3">
                        <p class="small text-grey fs-16">
                            <span class="fw-semibold"><?= number_format($total) ?></span> results
                            <span class="fw-semibold"><?= $first_item ?></span> ～
                            <span class="fw-semibold"><?= $last_item ?></span> showing
                        </p>
                    </div>

                    <!-- Hiển thị pagination -->
                    <div>
                        <ul class="pagination">
                            <?php echo html_entity_decode($pagination); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</div>