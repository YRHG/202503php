<?php

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers_2.php';

//类 对象
//面向对象编程  OOP 是一种重要的**编程范式**

//定义一个车类
class Car {

// 声明公共属性

    public $color = '白色'; // 带有默认值
    public $make;          // 没有默认值 (默认为 null)
    public $model;
    public $speed = 0;     // 带有默认值
    public static string $power = "Engine";

    public function __construct(public string $brand = 'Unknown', public string $model = 'Unknown')
    {
        // $this->brand = $brand;
        // $this->model = $model;
        echo "Car is created<br>";
    }
    public function drive(): void
    {
        echo "Car is driving<br>";
    }
}

//定义User类
class User{

}

// 创建 Car 类的两个实例（两个不同的汽车对象
// $myCar 和 $yourCar 现在是两个独立的 Car 对象
$myCar = new Car();
$yourCar = new Car();
var_dump($myCar); //输出myCar
echo "<br>";

var_dump($yourCar);//输出yourCar
echo "<br>";

//检查一个对象是否是某类
if ($myCar instanceof Car) {
    echo '$myCar 是 Car 类的一个实例。';
}

// 访问和修改 $myCar 的属性
// 设置属性值

$myCar->color = '红色';
$myCar->make = '特斯拉';
$myCar->model = 'Model 3';

// 读取属性值
echo "我的车：\n";
echo "品牌: " . $myCar->make . "\n";    // 输出: 特斯拉
echo "型号: " . $myCar->model . "\n";   // 输出: Model 3
echo "颜色: " . $myCar->color . "\n";   // 输出: 红色
echo "速度: " . $myCar->speed . " km/h\n"; // 输出: 0 km/h

// 访问和修改 $yourCar 的属性
$yourCar->make = '宝马';
$yourCar->model = 'X5';
// $yourCar->color 保持默认值 '白色'
// $yourCar->speed 保持默认值 0


echo "\n你的车：\n";
echo "品牌: " . $yourCar->make . "\n";    // 输出: 宝马
echo "颜色: " . $yourCar->color . "\n";   // 输出: 白色
//$myCar 和 $yourCar 是独立对象，修改一个不影响另一个

class Animal
{
    public string $name = "Unknown";
    public int $age = 0;

    // /**开始 表示文档注释开头
    /**
     * 是否是被饲养的动物
     *
     * @var string
     */
    // */表示注释结束
    //phpDoc主要给IDE识别，自动补全。显示提示。
    protected string $isFeed = "No";

    /**
     * 动物的 ID 号码
     *
     * @var string|null
     */
    private ?string $idNumber = '001';

    /**
     * 动物的 ID 号码
     *
     * @var string|null
     */
    private ?string $idNumber = '001';

    /**
     * 构造函数
     *
     * @param $name
     * @param $age
     */
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
    public function speak(): void
    {
        $name = $this->name ?? "Animal";
        echo "$name speaks<br>";
    }


    /**
     * 设置动物的 ID 号码
     *
     * @param $idNumber
     * @return void
     */

    public function setAnimalIDNumber($idNumber): void
    {
        // 设置权限 只有管理员可以设置 ID 号码
        $this->idNumber = $idNumber;
    }

    public function getAnimalIDNumber(): ?string
    {
        // 只有管理员可以获取 ID 号码
        return $this->idNumber;
    }
}

/**
 * 定义一个 `Dog` 类, 继承了 `Animal` 类。 `Dog` 类可以使用 `Animal` 类的属性和方法
 *
 * @class Dog
 */
class Dog extends Animal
{
    /**
     * 狗是人类的宠物, 狗会有「主人」这个属性
     *
     * @var string|null
     */
    public ?string $master = null;

    /**
     * 物种: dog。
     *为理解 static 的含义, 所以又声明了一个物种属性.
     *
     * @var string
     */

    public static string $species = "Dog";

    public function __construct($name, $age, $master = null)
    {
        parent::__construct($name, $age);

        $this->master = $master;
    }

    public function run(): void
    {
        echo "Dog is running<br>";
    }

    public function speak(): void
    {
        echo "Dog barks<br>";
    }
    public function getParentPrivateProp(): ?string
    {
        // 父类把这个属性设置为私有, 不想被外部或者子类访问。
        // 只有管理员可以获取 ID 号码
        // echoHr($this->idNumber);
        // 这里是不可以直接访问父类的私有属性的, 会报错。
        // 我们可以通过父类中的方法来访问父类的私有属性
        return $this->getAnimalIDNumber();
    }

    public function showClassSelf(): static
    {
        // self::getSelfStaticProp();
        return $this;
    }

    public static function getSelfStaticProp(): string
    {
        return self::$species;
    }
}
//定义狗叫lucky 3岁，$luckyDog 就是 Dog类的新对象。
//继承 Animal 的一个子类
$luckyDog = new Dog("Lucky", 3);
$luckyDog->speak();
echo $luckyDog->name . "<br>";

//getParentPrivateProp() 这个方法，用来读取 Animal（父类）里某个 private 属性。

echoWithBr("Animal's idNumber: " . $luckyDog->getParentPrivateProp());

//改掉 idNumber，设成 "002-lucky"
$luckyDog->setAnimalIDNumber("002-lucky");
echoWithBr("Animal's idNumber: " . $luckyDog->getParentPrivateProp());

//showClassSelf() 返回这个类 自己的信息
varDumpWithBr($luckyDog->showClassSelf());

echoWithBr("这是 LuckyDog 的物种1: " . $luckyDog::$species);

echoWithBr("这是 LuckyDog 的物种2: " . $luckyDog::getSelfStaticProp());

echoHr();

$animalLion = new Animal("辛巴", 5);
$animalTiger = new Animal("武松的兄弟", 4);
$animalLion->speak();
$animalTiger->speak();
echoWithBr("这是被修改之前的类的属性: name = " . $animalTiger->name);
$animalTiger->name = "悍娇虎";
echoWithBr("这里是被修改之后的类的属性: name = " . $animalTiger->name);

echoHr();

varDumpWithBr(gettype($animalLion));
varDumpWithBr($animalLion);

echoHr();

//$this 关键字
//指代调用该方法的那个**具体的对象实例**。

//访问当前对象的属性：$this->propertyName
//调用当前对象的其他方法：$this->methodName()

// 加速方法，修改当前对象的 $speed 属性
public function accelerate($amount) {
    // 使用 $this 访问当前对象的 speed 属性
    $this->speed += $amount;
    echo $this->getInfo() . " 加速了 " . $amount . " km/h，当前速度: " . $this->speed . " km/h\n";
    // 调用了下面的 getInfo() 方法
}

// 刹车方法
public function brake($amount) {
    // 确保速度不会低于 0
    $this->speed -= $amount;
    if ($this->speed < 0) {
        $this->speed = 0;
    }
    echo $this->getInfo() . " 减速了 " . $amount . " km/h，当前速度: " . $this->speed . " km/h\n";
}

// 获取车辆信息的方法
public function getInfo() {
    // 使用 $this 访问当前对象的属性
    // 如果 make 或 model 未设置，给个默认值避免错误
    $make = $this->make ?? '未知品牌';
    $model = $this->model ?? '未知型号';
    return $make . " " . $model;
}
}

$myCar = new Car();
$myCar->make = '比亚迪';
$myCar->model = '汉';

$myCar->accelerate(60); // 输出: 比亚迪 汉 加速了 60 km/h，当前速度: 60 km/h
$myCar->brake(30);      // 输出: 比亚迪 汉 减速了 30 km/h，当前速度: 30 km/h
$myCar->brake(40);      // 输出: 比亚迪 汉 减速了 40 km/h，当前速度: 0 km/h

//构造函数
//名字固定为 __construct。
//当使用 new 关键字创建一个对象时，如果这个类定义了构造函数，它会**自动被调用**。
//  class MyClass {
//  public function __construct(参数1, 参数2, ...) {
//    // 初始化代码，通常是给属性赋值
//    // $this->property = 参数1;
//}
//}
class Car {
    public $color; // 不再需要默认值 '白色'
    public $make;
    public $model;
    public $speed = 0;
// 构造函数，接收品牌、型号和颜色作为参数
public function __construct(string $make, string $model, string $color = '银色') {
    echo "一辆新的 " . $make . " " . $model . " 被创建了！\n";
    // 使用 $this 将传入的参数值赋给对象的属性
    $this->make = $make;
    $this->model = $model;
    $this->color = $color; // 如果不传 color，会使用默认值 '银色'
    // speed 属性使用类定义中的默认值 0
}

// ... 其他方法 (accelerate, brake, getInfo) ...
public function getInfo() {
    return $this->make . " " . $this->model . " (" . $this->color . ")";
}
public function accelerate($amount) { /* ... */ echo $this->getInfo() . " 加速 " . $amount . "\n"; $this->speed+=$amount; }
public function brake($amount) { /* ... */ echo $this->getInfo() . " 减速 " . $amount . "\n"; $this->speed-=$amount; if($this->speed<0) $this->speed = 0;}
}

// 创建对象时，在 new 类名后面的括号里传入构造函数需要的参数
$car1 = new Car('丰田', '凯美瑞', '黑色'); // 输出: 一辆新的 丰田 凯美瑞 被创建了！
$car2 = new Car('本田', '思域');         // 输出: 一辆新的 本田 思域 被创建了！ (颜色使用默认值 '银色')

echo $car1->getInfo(); // 输出: 丰田 凯美瑞 (黑色)
echo "\n";
echo $car2->getInfo(); // 输出: 本田 思域 (银色)



//析构函数 固定为 __destruct
//在对象销毁前执行一些清理操作，例如关闭文件句柄、释放数据库连接（虽然 PHP 的资源管理通常会自动处理这些）
//访问控制