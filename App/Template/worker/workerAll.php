<?php include("base_html.php");?>

<div class="container">
    <div class="card-deck mb-3 text-center">
        <?php /** @var \App\Data\WorkerDTO[] $data */ ?>
        <span><h2>Работники</h2> </span>
        <table class="table">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Работник</th>
                <th>Кабинет</th>
                <th>Этаж</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $workerDTO): ?>
                <tr>
                    <td><?= $workerDTO->getId(); ?></td>
                    <td><?= $workerDTO->getName(); ?></td>
                    <td><?= $workerDTO->getCabinet()->getName(); ?></td>
                    <td><?= $workerDTO->getCabinet()->getFloor()->getName(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <span><a href="workerNew.php" class="btn btn-primary"> Добавить</a></span>
    <?php include("footer.php");?>
