<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Добавить
        </div>

        <div class="card-body">

            <div class="text-end">
                <a href="/admin/products" class="btn btn-primary" role="button">Назад</a>
            </div>

            <form method="post" enctype="multipart/form-data" class="row g-3">
                <div class="col-12">
                    <label for="title" class="form-label">title</label>
                    <input id="title" name="title" value="<?php echo $product['title']; ?>" type="text" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Categories</label>
                    <select id="inputState" name="category_id" class="form-select">
                        <?php foreach ($categories as $value): ?>
                            <option value="<?php echo $value['id']; ?>"
                                    <?php if ($product['category_id'] == $value['id']): ?>selected<?php endif; ?>>
                                <?php echo $value['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="price" class="form-label">price</label>
                    <input id="price" name="price" value="<?php echo $product['price']; ?>" type="text" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="quantity" class="form-label">Password</label>
                    <input id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="content" name="content" class="form-control" rows="3"><?php echo $product['content']; ?></textarea>
                </div>

                <div class="col-md-2">
                    <label for="created_at" class="form-label">Date</label>
                    <input id="created_at" name="created_at"
                           value="<?php echo date('Y-m-d', strtotime($product['created_at'])); ?>"
                           type="date" class="form-control" disabled>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input id="is_active" name="is_active" value="" class="form-check-input" type="checkbox"
                        <?php if ($product['is_active']): ?>checked<?php endif; ?>>
                        <label class="form-check-label" for="gridCheck">
                            Is Active
                        </label>
                    </div>
                </div>

                <div class="col-12">
                    <input type="hidden" name="mode" value="update_product">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>



