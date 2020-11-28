<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?=dirname($_SERVER['SERVER_NAME']);?>/assets/image/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Document</title>
</head>
<style>
    .warpper {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .tab {
        cursor: pointer;
        padding: 10px 20px;
        margin: 0px 2px;
        display: inline-block;
        color: #000;
        border-radius: 3px 3px 0px 0px;
    }

    .panels {
        min-height: 200px;
        width: 100%;
        max-width: 500px;
        border-radius: 3px;
        overflow: hidden;
        padding: 20px;
    }

    .panel {
        display: none;
        animation: fadein .8s;
    }

    @keyframes fadein {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .panel-title {
        font-size: 1.5em;
        font-weight: bold
    }

    .radio {
        display: none;
    }

    #one:checked ~ .panels #one-panel,
    #two:checked ~ .panels #two-panel,
    #three:checked ~ .panels #three-panel {
        display: block
    }

    #one:checked ~ .tabs #one-tab,
    #two:checked ~ .tabs #two-tab,
    #three:checked ~ .tabs #three-tab {
        color: #ff0000;
        font-weight: bold;
    }
</style>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><img src="<?=dirname($_SERVER['SERVER_NAME']);?>/assets/image/favicon.png" alt="company name"></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="cabinetAll.php">кабинеты</a>
        <a class="p-2 text-dark" href="floorAll.php">этажи</a>
        <a class="p-2 text-dark" href="workerAll.php">работники</a>
    </nav>
    <?php if(!$data):?>
        <a class="btn btn-primary" href="login.php">Логин</a>
    <?php else:?>
        <a class="btn btn-outline-primary" href="logout.php">Выйти</a>
    <?php endif;?>
</div>