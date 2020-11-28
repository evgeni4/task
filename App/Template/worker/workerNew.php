<?php include("base_html.php");?>
<?php /** @var \App\Data\WorkerDTO[] $data */ ?>
<?php /** @var array $errors |null */ ?>
<div class="container">
    <div class="card-deck mb-3 text-center">
        <h2>Добавить работника</h2>
        <form method="post" action="workerNew.php">
            <div class="form-group">
                <label> имя: </label>
                <input type="text" class="form-control" name="name"/>
            </div>
            <div class="form-group">
                <label> кабинет: </label>
                <select name="cabinet_id" class="form-control">
                    <?php foreach ($data as $cabinet): ?>
                        <option value="<?= $cabinet->getId(); ?>">
                            <?= $cabinet->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" name="add" value="Добавить"/>

        </form>
    </div>
    <?php include("footer.php");?>

