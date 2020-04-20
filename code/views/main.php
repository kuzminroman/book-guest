<div class="col-md-5">
    <form action="/Main/AddRecord" method="post" class="form-book">
        <div class="form-group">
            <label for="nameGuest">Имя</label>
            <input class="form-control" id="nameGuest" type="text" placeholder="Имя отправителя" name="nameGuest">
        </div>
        <div class="form-group">
            <label for="textMessage">Сообщение</label>
            <textarea class="form-control" rows="6" id="textMessage" name="text"
                      placeholder="Текст сообщения"></textarea>
        </div>
        <input class="btn btn-primary" type="submit" id="addRecord">
    </form>
</div>
<div class="col-md-7">
    <div class="result">
        <?php if(empty(self::$params)) : ?>
            <p class="center-block">Нет записей</p>
        <?php endif; ?>
        <?php foreach (self::$params as $key => $val) : ?>
            <div>
                <p><?= $val['name'] ?></p>
                <p><?= $val['body'] ?></p>
                <p><?= \components\ProjectHelper::dateToRecord($val['dtime']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>