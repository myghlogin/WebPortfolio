<div id="bestRecord">
    <h5>Лучший рекорд</h5>
    <p><?=$maxRecord?></p>
</div>
<div id="recordList">
    <h3>Мои рекорды</h3>
    <form>
        <input type="button" name="logoutBtn" id="logoutBtn" value="Выйти">
    </form>
    <br>
    <?=$error?>
    <? if(!empty($records)): ?>
        <table id="recordTable">
            <thead>
                <tr>
                    <th>Рекорд</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <? foreach($records as $value): ?>
                <tr>
                    <td><?=$value['record']?></td>
                    <td><?=$value['dt']?></td>
                </tr>
            <? endforeach ?>
        </table>
    <? else: ?>
        <p>Список рекордов пуст</p>
    <? endif ?>
</div>
