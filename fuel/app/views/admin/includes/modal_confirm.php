<div id="<?= $modalId ?? 'modal-confirm' ?>" data-bs-backdrop="true" class="modal-overlay" style="display: none;">
    <div class="modal-box">
        <h3 id="modalTitle">Xác nhận</h3>
        <p id="modalMessage">Bạn có chắc chắn muốn thực hiện hành động này không?</p>
        <div class="modal-footer">
            <button class="btn-cancel">Hủy</button>
            <a id="btn-submit" class="btn-danger">Đồng ý</a>
        </div>
    </div>
</div>