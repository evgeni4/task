<?php include("base_html.php");?>

<div class="container">
    <div class="card-deck mb-3 text-center">

        <?php /** @var \App\Data\FloorDTO[] $data */ ?>
        <?php /** @var array $errors |null */ ?>
        <?php /** @var array $errors |null */ ?>
        <span><h2>Этажи</h2> </span>
        <table class="table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Имя</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $floorDTO): ?>
                <tr>
                    <td><?= $floorDTO->getId(); ?></td>
                    <td><?= $floorDTO->getName(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <span><a href="floorNew.php" class="btn btn-primary"> Добавить</a></span>
    </div>
<?php include("footer.php");?>