<?php include("base_html.php");?>
<?php /** @var \App\Data\CabinetDTO[] $data */ ?>
<?php /** @var array $errors |null */ ?>
<div class="container">
    <div class="card-deck mb-3 text-center">
        <h2>Добавить кабинет</h2>
        <form method="post" action="cabinetNew.php">
            <div class="form-group">
                <label> заголовок: </label>
                <input type="text" class="form-control" name="name"/>
            </div>
            <div class="form-group">
                <label> этаж: </label>
                <select name="floor_id" class="form-control">
                    <?php foreach ($data as $floor): ?>
                        <option value="<?= $floor->getId(); ?>">
                            <?= $floor->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" name="add" value="Добавить"/>

        </form>
    </div>
    <?php include("footer.php");?>
