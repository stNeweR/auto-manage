<?php
require_once "Car.php";
require_once "Form.php";
require 'head.php';

$car = new Car('db.json');

echo '<h3>Добавить машину</h3>';
Form::form(["марка" => '', "модель" => '', "год_выпуска" => '', "цвет" => '', "двигатель" => '', "пробег" => '', "фары" => '', "двери" => ''],'add', 'required', false, 'primary', 'Добавить' );
echo '<h3>Поиск по параметру</h3>';
Form::form(["марка" => '', "модель" => '', "год_выпуска" => '', "цвет" => '', "двигатель" => '', "пробег" => "", "фары" => "", "двери" => ""], 'find', '', true, 'info', "Поиск");


if (isset($_POST['type']) && $_POST['type'] === 'delete') {
    $car->delete($_POST['id']);
}

if (isset($_POST['type']) && $_POST['type'] == 'add'){
    unset($_POST['type']);
    unset($_POST['id']);
    $car->add($_POST);
}

if (isset($_POST['type']) && $_POST['type'] === 'update') {
    if (isset($car->all()[$_POST['id']])){
        Form::form($car->all()[$_POST['id']], 'addUpdate', 'required', false, 'primary',"Изменить", $_POST['id']);
    } else {
        echo '<h1>Такой машины нет!</h1>';
    }
}

if (isset($_POST['type']) && $_POST['type'] === 'addUpdate') {
    unset($_POST['type']);
    $car->addUpdate($_POST);
}

if (isset($_POST['type']) && $_POST['type'] === 'find') {
    unset($_POST['type']);
    $parametr = array_filter($_POST);
    echo "<table class='table table-bordered'><thead><tr><th>Марка</th><th>Модель</th><th>Цвет</th><th>Двигатель</th><th>Год выпуска</th><th>Пробег</th><th>Стоянка</th><th>Состояние фар</th></tr></thead><tbody>";
    $car->find($parametr);
    echo '</tbody></table>';
}

if (isset($_POST['type']) && $_POST['type'] === 'clear') {
    unset($_POST['type']);
    header('Location: /');
}
?>

<form action="" method="post">
    <label for="">НАЗАД!</label>
    <button type="submit" class="btn btn-danger">НАЗАД</button>
</form>

<form action="" method="post">
    <label for="id">УДАЛИТЬ!</label>
    <input type='hidden' name='type' value='delete'>
    <input name="id" id="id" placeholder="Введите id" type="number">
    <button class="btn btn-danger" type="submit">УДАЛИТЬ</button>
</form>
<form action="" method="post">
    <label for="id">ИЗМЕНИТЬ!</label>
    <input type='hidden' name='type' value='update'>
    <input name="id" id="id" placeholder="Введите id" type="number">
    <button class="btn btn-primary"  type="submit">ИЗМЕНИТЬ</button>
</form>

<?php
echo '<div class="d-flex flex-wrap">';
$car->allCars();
echo '</div>';
?>