<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Редактировать
        </div>

        <div class="card-body">

            <div class="text-end">
                <a href="/admin/categories" class="btn btn-primary" role="button">Назад</a>
            </div>
            <div class="m-auto"> Вы точно хотите удалить жто поле</div>

            <form method="post">
                <div class="mb-3">
                    <p id="name" name="name" type="text" class="form-control" > <?php echo $category['name']; ?></p>
                </div>

                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                <input type="hidden" name="mode" value="delete_category">
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </div>
    </div>