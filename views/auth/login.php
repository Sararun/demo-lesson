
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h1>Вход</h1>
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" value="" type="text" class="form-control">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input id="password" name="password" value="" type="text" class="form-control">
                <small id="passwordHelp" class="form-text text-muted"></small>
            </div>
            <hr>
            <input type="hidden" name="mode" value="login_user">
            <button type="submit" class="btn btn-primary">Вход</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

