<?php include("base_html.php");?>

<div class="container">
    <div class="card-deck mb-3 text-center">
        <?php /** @var \App\Data\CabinetDTO[] $data */ ?>
        <span><h2>Кабинет</h2> </span>
        <table class="table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Кабинет</th>
                <th>Этаж</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $cabinetDTO): ?>
                <tr>
                    <td><?= $cabinetDTO->getId(); ?></td>
                    <td><?= $cabinetDTO->getName(); ?></td>
                    <td><?= $cabinetDTO->getFloor()->getName(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <span><a href="cabinetNew.php" class="btn btn-primary"> Добавить</a></span>
<?php include("footer.php");?>