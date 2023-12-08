<?php
require_once "Car.php";
require_once "Form.php";
require 'head.php';

$car = new Car('db.json');

echo '<h3 class="text-2xl">Добавить машину</h3>';
Form::form(["марка" => '', "модель" => '', "год_выпуска" => '', "цвет" => '', "двигатель" => '', "пробег" => '', "фары" => '', "двери" => ''],'add', 'required', false, 'red-900', 'Добавить', "red-700");
echo '<h3 class="text-2xl">Поиск по параметру</h3>';
Form::form(["марка" => '', "модель" => '', "год_выпуска" => '', "цвет" => '', "двигатель" => '', "пробег" => "", "фары" => "", "двери" => ""], 'find', '', true, 'blue-900', "Поиск", "blue-700");

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
        Form::form($car->all()[$_POST['id']], 'addUpdate', 'required', false, 'blue-900',  "Изменить", "blue-700",  $_POST['id'] );
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
    echo "<table class='table w-full table-auto border'><thead class=''><tr><th class='border-r'>Марка</th><th class='border-r'>Модель</th><th class='border-r'>Цвет</th><th class='border-r'>Двигатель</th><th class='border-r'>Год выпуска</th><th class='border-r'>Пробег</th><th class='border-r'>Стоянка</th><th class='border-r'>Состояние фар</th><th>Состояние дверей</th></tr></thead><tbody>";
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
    <button type="submit" class="py-2 px-5 bg-red-900 rounded-lg mx-2 hover:bg-red-700 delay-50">НАЗАД</button>
</form>

<form action="" method="post" class="my-2">
    <label for="id" class="text-2xl">УДАЛИТЬ!</label>
    <input type='hidden' name='type' value='delete'>
    <input name="id" id="id" placeholder="Введите id" type="number" class="py-1 px-2 bg-slate-200 rounded placeholder-slate-900 text-black">
    <button type="submit" class="py-2 px-5 bg-red-900 rounded-lg mx-2 hover:bg-red-700 delay-50">УДАЛИТЬ</button>
</form>
<form action="" method="post" class="my-2">
    <label for="id" class="text-2xl">ИЗМЕНИТЬ!</label>
    <input type='hidden' name='type' value='update'>
    <input name="id" id="id" placeholder="Введите id" type="number" class="py-1 px-2 bg-slate-200 rounded placeholder-slate-900 text-black">
    <button class="py-2 px-5 bg-blue-900 rounded-lg mx-2 hover:bg-blue-700 delay-50" type="submit">ИЗМЕНИТЬ</button>
</form>

<?php
echo '<div class="flex">';
$car->allCars();
echo '</div>';
?>