<?php
class Form
{
    public static function form($car = [], $method = '', $required = '',  $option=false, $class = '', $btn = '', $id = null )
    {
        echo "<form action='/' method='POST'>
    <input type='hidden' name='type' value='$method' $required>
    <input type='hidden' name='id' value='$id'>
    <input name='марка' type='text' placeholder='марка' value='$car[марка]' $required>
    <input  name='модель' type='text' placeholder='модель' value='$car[модель]' $required>
    <input name='год_выпуска' type='number' min='1900'  max='2023' placeholder='год_выпуска' value=$car[год_выпуска]  $required>
    <input  name='цвет' type='text' placeholder='цвет' value='$car[цвет]' $required>
    <input  name='двигатель' type='text' placeholder='двигатель' value='$car[двигатель]' $required>
    <input  name='пробег' type='number' placeholder='пробег' value='$car[пробег]' $required>
    <label for='стоянка'>Стоянка</label>
    <select name='стоянка' id='стоянка' $required>";
    if ($option) {
        echo "<option value=''></option>";
    }
    echo "<option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
    </select>
    <label for='фары'>Состояние фар</label>
    <select name='фары' id='фары' $required>";
    if ($option) {
        echo "<option value=''></option>";
    }
    echo "<option value='Включены'>Вкл</option>
        <option value='Выключены'>Выкл</option>
    </select>
    <label for='двери'>Состояние дверей</label>
    <select name='двери' id='двери' $required>";
    if ($option) {
        echo "<option value=''></option>";
    }
    echo "<option value='Закрыты'>Закрыты</option>
        <option value='Открыты'>Открыты</option>
    </select>
    <button class='btn btn-$class' type='submit'>$btn</button>
    </form>";
    }

    public static function seeCar($car)
    {
        echo "<tr><td>$car[марка]</td><td>$car[модель]</td><td>$car[цвет]</td><td>$car[двигатель]</td><td>$car[год_выпуска]</td><td>$car[пробег]</td><td>$car[стоянка]</td><td>$car[фары]</td>";
        if ($car["фары"] == 'Включены') {
            echo "<td class='bg-warning'>$car[фары]</td>";
        } else {
            echo "<td class=''>Фары: $car[фары]</td>";
        }
        echo "<td>$car[двери]</td></tr>";
    }
}