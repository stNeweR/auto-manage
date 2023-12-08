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
    public function deleteAll()
    {
        $array = array();
        $this::save($array, $this->file);
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
        if ($this->cars != []) {
            echo '<table class="table table-auto w-full "><thead><tr><th class="border-r">ID</th><th class="border-r">Марка</th><th class="border-r">Модель</th><th class="border-r">Цвет</th><th class="border-r">Двигатель</th><th class="border-r">Год выпуска</th><th class="border-r">Пробег</th><th class="border-r">Стоянка</th><th class="border-r">Состояние фар</th><th>Состояние дверей</th></thead><tbody>';
            foreach ($this->cars as $car) {
                $index = array_search($car, $this->cars);
                    echo "<tr class='border-t'><td class='py-2 border-r'>$index</td><td class='border-r pl-1'>$car[марка]</td><td class='border-r pl-1'>$car[модель]</td><td class='border-r pl-1'>$car[цвет]</td><td class='border-r pl-1'>$car[двигатель]</td><td class='border-r pl-1'>$car[год_выпуска]</td><td class='border-r'>$car[пробег]</td><td class='border-r pl-1'>$car[стоянка]</td>";
                if ($car['фары'] == 'Включены') {
                    echo"<td class='bg-yellow-500 text-black border-r pl-1'>$car[фары]</td>";
                } else {
                     echo "<td class='border-r pl-1'>$car[фары]</td>";
                }
                echo "<td class='pl-1'>$car[двери]</td></tr>";
            }
            echo '</tbody></table>';
        } else{
            echo "<h1>No cars...</h1>";
        }
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