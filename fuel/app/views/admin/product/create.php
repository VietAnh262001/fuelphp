<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Create Product</h2>
        <hr>
        <div class="content-page">
            <form method="post" class="w-50 p-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <div id="preview-image" style="display: none;">
                        <img src="#" alt="Preview Image" width="200" height="200" class="mb-3">
                        <div class="delete-image d-flex justify-content-center align-items-center">x</div>
                    </div>
                    <button class="btn btn-secondary btn-image">Add image</button>
                    <input type="file" class="form-control image" accept="image/jpeg,image/png" hidden name="image">
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <input type="text" class="form-control" name="note" id="note" placeholder="Note">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-4">Create</button>
                </div>
            </form>
        </div>
    </div>
</section>