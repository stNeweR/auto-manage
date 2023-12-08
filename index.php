<?php
require_once "Car.php";
require_once "Form.php";
require 'head.php';

$car = new Car('db.json');

echo '<h3 class="text-2xl">Добавить машину</h3>';
Form::form(["марка" => '', "модель" => '', "год_выпуска" => '', "цвет" => '', "двигатель" => '', "пробег" => '', "фары" => '', "двери" => ''],'add', 'required', false, 'red-700', 'Добавить' );
echo '<h3 class="text-2xl">Поиск по параметру</h3>';
Form::form(["марка" => '', "модель" => '', "год_выпуска" => '', "цвет" => '', "двигатель" => '', "пробег" => "", "фары" => "", "двери" => ""], 'find', '', true, 'blue-700', "Поиск");

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
        echo "<h2>Измените машину</h2>";
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

<form action="" method="post" class="flex items-center">
    <label for="" class="text-2xl">НАЗАД!</label>
    <button type="submit" class="py-2 px-5 bg-red-600 rounded-lg mx-2">НАЗАД</button>
</form>

<form action="" method="post" class="my-2">
    <label for="id" class="text-2xl">УДАЛИТЬ!</label>
    <input type='hidden' name='type' value='delete'>
    <input name="id" id="id" placeholder="Введите id" type="number" class="py-1 px-2 bg-slate-200 rounded placeholder-slate-900 text-black">
    <button type="submit" class="py-2 px-5 bg-red-700 rounded-lg mx-2">УДАЛИТЬ</button>
</form>
<form action="" method="post" class="my-2">
    <label for="id" class="text-2xl">ИЗМЕНИТЬ!</label>
    <input type='hidden' name='type' value='update'>
    <input name="id" id="id" placeholder="Введите id" type="number" class="py-1 px-2 bg-slate-200 rounded placeholder-slate-900 text-black">
    <button class="py-2 px-5 bg-blue-700 rounded-lg mx-2" type="submit">ИЗМЕНИТЬ</button>
</form>

<?php
echo '<div class="flex">';
$car->allCars();
echo '</div>';
?>