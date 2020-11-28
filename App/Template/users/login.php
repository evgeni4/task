<?php include("base_html.php");?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <div class="warpper">
                    <input class="radio" id="one" name="group" type="radio">
                    <input class="radio" id="two" name="group" type="radio" checked>
                    <input class="radio" id="three" name="group" type="radio">
                    <div class="tabs">
                        <label class="tab" id="one-tab" for="one">Авторизация</label>
                        <label class="tab" id="two-tab" for="two">Регистрация</label>
                    </div>
                    <div class="panels">
                        <?php /** @var array $errors |null */ ?>
                        <?php if ($data != ""): ?>
                            <div id="mess" class="alert alert-success">
                                <strong> <?= $data ?></strong>
                            </div>
                        <?php endif; ?>
                        <?php foreach ($errors as $error): ?>
                            <p style="color: red"><?= $error ?></p>
                        <?php endforeach; ?>
                        <div class="panel" id="one-panel">
                            <form method="post">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control"
                                           value="<?= isset($_POST['email']) ? $_POST['email'] : null ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Пароль: </label>
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                                <label>
                                    <input type="submit" class="btn btn-primary" name="login" value="Войти"/>
                                </label>
                            </form>
                        </div>
                        <div class="panel" id="two-panel">
                            <form method="post" action="register.php">
                                <label> Email: </label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email"/>
                                </div>
                                <div class="form-group">
                                    <label> Пароль:</label>
                                    <input type="password" class="form-control" name="password"/>
                                </div>
                                <div class="form-group">
                                    <label> Подтвердить пароль:</label>
                                    <input type="password" class="form-control" name="password2"/>
                                </div>
                                <input type="submit" class="btn btn-primary" name="register" value="Register"/> <br/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            setTimeout(function () {
                $("#mess").fadeOut();
            }, 1000)
        </script>
        <?php include("footer.php"); ?>
