<?php
class Form
{
    public static function form($car = [], $method = '', $required = '',  $option=false, $class = '', $btn = '', $hover = '',  $id = null )
    {
        echo "<form action='/' method='POST'>
    <input type='hidden' name='type' value='$method' $required>
    <input type='hidden' name='id' value='$id'>
    <input name='марка' type='text' placeholder='марка' value='$car[марка]' $required class='py-1 px-2 bg-slate-300 rounded placeholder-slate-900 text-black'>
    <input  name='модель' type='text' placeholder='модель' value='$car[модель]' $required class='py-1 px-2 bg-slate-300 rounded placeholder-slate-900 text-black'>
    <input name='год_выпуска' type='number' min='1900'  max='2023' placeholder='год_выпуска' value='$car[год_выпуска]' $required class='py-1 px-2 bg-slate-300 rounded placeholder-slate-900 text-black'>
    <input  name='цвет' type='text' placeholder='цвет' value='$car[цвет]' $required class='py-1 px-2 bg-slate-200 rounded placeholder-slate-900 text-black'>
    <input  name='двигатель' type='text' placeholder='двигатель' value='$car[двигатель]' $required class='py-1 px-2 bg-slate-200 rounded placeholder-slate-900 text-black'>
    <input  name='пробег' type='number' placeholder='пробег' value='$car[пробег]' $required class='py-1 px-2 bg-slate-200 rounded placeholder-slate-900 text-black'>
    <div class='flex my-2 items-center gap-x-2'>
        <label for='стоянка' class=''>Стоянка</label>
        <select name='стоянка' id='стоянка' $required class='px-2 py-1 bg-slate-300 rounded text-black'>";
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
        <select name='фары' id='фары' $required class='py-1 px-2 bg-slate-300 rounded text-black'>";
        if ($option) {
            echo "<option value=''></option>";
        }
        echo "<option value='Включены'>Вкл</option>
            <option value='Выключены'>Выкл</option>
        </select>
        <label for='двери'>Состояние дверей</label>
        <select name='двери' id='двери' $required class='py-1 px-2 bg-slate-300 rounded text-black'>";
        if ($option) {
            echo "<option value=''></option>";
        }
        echo "<option value='Закрыты'>Закрыты</option>
            <option value='Открыты'>Открыты</option>
        </select>
        <button class='py-2 px-5 bg-$class rounded-lg hover:bg-$hover delay-50' type='submit'>$btn</button>
    </div>
    </form>";
    }
    public static function seeCar($car)
    {
        echo "<tr class='border-t'><td class='border-r pl-1 py-2'>$car[марка]</td><td class='border-r pl-1'>$car[модель]</td><td class='border-r pl-1'>$car[цвет]</td><td class='border-r pl-1'>$car[двигатель]</td><td class='border-r pl-1'>$car[год_выпуска]</td><td class='border-r pl-1'>$car[пробег]</td><td class='border-r pl-1'>$car[стоянка]</td>";
        if ($car["фары"] == 'Включены') {
            echo "<td class='bg-yellow-500'>$car[фары]</td>";
        } else {
            echo "<td class=''>$car[фары]</td>";
        }
        echo "<td class='border-l pl-1'>$car[двери]</td></tr>";
    }
}