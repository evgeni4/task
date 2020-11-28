<?php include("base_html.php");?>

<div class="container">
    <div class="card-deck mb-3 text-center">
        <?php if( $data):?>
            <h1>Hello, <?=$data->getEmail()?></h1>
        <?php endif;?>
    </div>

<?php include("footer.php");?>