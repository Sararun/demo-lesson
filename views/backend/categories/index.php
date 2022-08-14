<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Категории
        </div>

        <div class="card-body">

            <div class="text-end">
                <a href="/admin/categories/create" class="btn btn-primary" role="button">Добавить</a>
            </div>
            <?php if (!empty($categories)): ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">URL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categories as $value): ?>
                        <tr>
                            <th scope="row"><?php echo $value['id']; ?></th>
                            <td><?php echo $value['slug']; ?></td>
                            <td>
                                <a href="/admin/categories/update?id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a>
                            </td>
                            <td>
                                <a href="/admin/categories/update?id=<?php echo $value['id']; ?>" class="btn btn-primary" role="button">Update</a>
                                <a href="/admin/categories/delete?id=<?php echo $value['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Категорий нет</p>
            <?php endif; ?>
        </div>
    </div>
</div>



