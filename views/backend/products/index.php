<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Товары
        </div>

        <div class="card-body">

            <div class="text-end">
                <a href="/admin/products/create" class="btn btn-primary" role="button">Добавить</a>
            </div>
            <?php if (!empty($products)): ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">URL</th>
                        <th scope="col">Name</th>
                        <th scope="col">price</th>
                        <th scope="col">quantity</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $value): ?>
                        <tr>
                            <th scope="row"><?php echo $value['id']; ?></th>
                            <td>
                                <img src="<?php echo $value['images'][0]['thumbnail']; ?>";
                            </td>
                            <td><?= $value['slug'];?></td>
                            <td>
                                <a href="/admin/products/update?id=<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a>
                            </td>
                            <td><?php echo $value['price']; ?></td>
                            <td><?php echo $value['quantity']; ?></td>
                            <td>
                                <a href="/admin/products/update?id=<?php echo $value['id']; ?>" class="btn btn-primary" role="button">Update</a>
                                <a href="/admin/products/delete?id=<?php echo $value['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Товаров нет</p>
            <?php endif; ?>
        </div>
    </div>
</div>
