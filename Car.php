<?php

require "Form.php";
require "Filemanager.php";

class Car extends FileManager
{
    public $file;
    public $cars;
    public function __construct($file)
    {
        $this->file = $file;
        $this->cars = $this::getArray($file);
    }

    public function add($newCar)
    {
        array_push($this->cars, $newCar);
        $this::save($this->cars, $this->file);
    }

    public function delete($id)
    {
        unset($this->cars[$id]);
        $this::save($this->cars, $this->file);
    }

    public function all()
    {
        return $this->cars;
    }

    public function allCars()
    {
        echo '<table class="table table-bordered"><thead><tr><th>ID</th><th>Марка</th><th>Модель</th><th>Цвет</th><th>Двигатель</th><th>Год выпуска</th><th>Пробег</th><th>Стоянка</th><th>Состояние фар</th><th>Состояние дверей</th></thead><tbody>';
        foreach ($this->cars as $car) {
            $index = array_search($car, $this->cars);
                echo "<tr><td>$index</td><td>$car[марка]</td><td>$car[модель]</td><td>$car[цвет]</td><td>$car[двигатель]</td><td>$car[год_выпуска]</td><td>$car[пробег]</td><td>$car[стоянка]</td>";
            if ($car['фары'] == 'Включены') {
                echo"<td class='bg-warning'>$car[фары]</td>";
            } else {
                 echo "<td>$car[фары]</td>";
            }
            echo "<td>$car[двери]</td></tr>";
        }
        echo '</tbody></table>';
    }

    public function find($parametr)
    {
        $par = array_keys($parametr)[0];
        $value = $parametr[$par];
        foreach ($this->cars as $car) {
            if ( $car[$par]=== $value ) {
                Form::seeCar($car);
            }
        }
    }

    public function addUpdate($updateCar)
    {
        $index = $updateCar['id'];
        settype($index, 'integer');
        unset($_POST['id']);
        $this->cars[$index] = $updateCar;
        $this::save($this->cars, $this->file);
     }
}