<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Добавить
        </div>

        <div class="card-body">

            <div class="text-end">
                <a href="/admin/categories" class="btn btn-primary" role="button">Назад</a>
            </div>

            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input id="name" name="name" type="text" value="" class="form-control">
                </div>
                <div class="mb-3 form-check">
                    <input id="is_active" name="is_active" type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="is_active">Статус</label>
                </div>
                <input type="hidden" name="mode" value="add_category">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
</div>



