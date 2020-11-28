<?php include("base_html.php");?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Добавить Этаж</h2>
            <?php /** @var array $errors |null */ ?>
            <?php foreach ($errors as $error): ?>
                <p style="color: red"><?= $error ?></p>
            <?php endforeach; ?>
            <form method="post" action="floorNew.php">
                <label> этаж: </label>
                <div class="form-group">
                    <input type="text" class="form-control" name="name"/>
                </div>
                <input type="submit" class="btn btn-primary" name="add" value="Добавить"/> <br/>
            </form>
        </div>
<?php include("footer.php");?>