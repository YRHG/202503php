<?php

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers_2.php';


//php接口定义
//interface接口
interface ProductResource
{
    /**
     * 获取产品详情
     * @param int $id
     * @return mixed
     * 根据产品id获取详情
     */
    public function show(int $id): mixed;

    /**
     * 获取产品列表
     * @return mixed
     */
    public function index(): mixed;

    /**
     * 展示创建产品的表单页面
     * @return mixed
     */
    public function create(): mixed;

    /**
     * 新增产品到数据库
     * @param array $product
     * @return mixed
     */
    public function store(array $product): mixed;

    /**
     * 展示编辑产品的表单页面
     * @param int $id
     * @return mixed
     *
     */
    public function edit(int $id): mixed;

    /**
     * 更新产品到数据库
     *
     * @param int $id
     * @param array $product
     * @return mixed
     */
    public function update(int $id, array $product): mixed;

    /**
     * 删除产品
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed;
    /**
     * 搜索产品
     * 老师没写
     * @param int $keyword
     * @return mixed
     */
    public function search(string $keyword): mixed;
}
//注意这里返回 mixed 任何值 方便复杂产品数组或字符串
//html访问列表
//get----product-------ProductResource index
//get----product--id---ProductResource show【$id】
//get----product--create--ProductResource create
//submit--product--ProductResource store [$product]
//get --product--id--edit---ProductResource edit【$id】
//del-----product-----ProductResource destroy(int $id)


//抽象类不能直接实例化
// $productResource = new ProductResource();
//抽象类 (Abstract Class): 使用 abstract 关键字声明的类。它像一个不完整的“模板”或“草稿”，主要目的是被其他类继承。


//上面写了interface接口
//这里写实现接口的方法
//开始定义product----实现 ProductResource

class Product implements ProductResource
{
    //show ID 必须得是字符串string
    public function show(int $id): string
    {
        //返回 ID
        return "Showing product with ID: $id<br>";
    }

    public function index(): string
    {
        //列表信息index 必须是字符串string
        return "Listing all products<br>";
    }

    public function create(): string
    {
        //新建产品信息也必须是字符串 string
        return "Creating a new product<br>";
    }

    public function store(array $product): string
    {
        //数据库新增数组$product 必须是字符串 string
        return "Storing product: " . json_encode($product) . "<br>";
    }

    public function edit(int $id): string
    {
        //修改产品int $id 必须是字符串string
        return "Editing product with ID: $id<br>";
    }

    public function update(int $id, array $product): string
    {
        //数据update int $id , array $product 必须是字符串string
        return "Updating product with ID: $id<br>";
    }

    public function destroy(int $id): string
    {
        return "Deleting product with ID: $id<br>";
    }

    public function search(string $keyword): string
    {
        return "Searching for product with keyword: $keyword<br>";
    }
}

//定义product 新增 样品
$product = new Product("Sample Product");
//访问产品信息 id=1 的info
$productInfo = $product->show(1);
//输出info
echoWithBr($productInfo);

//database类
//用单例模式模拟数据库连接
//一个类，只能有一个实例（对象），不允许 new 出第二个。
//说是占用数据库资源 mysql 搞不定
//文档里没有
//所以构造函数 __construct() 构造函数 设成 private 私有属性	不让外面 new

class Database
{
    //数据库 用户名 密码 全是静态属性
    public static string $host = "localhost";

    public string $dbName = "school";

    public static string $username;

    public static string $password;

    /**
     * 项目object保存静态属性 没有为空null
     * @var object|null
     */
    private static ?object $instance = null;

    /**
     *构造函数调用
     * @param $username
     * @param $password
     * self::，表示访问自己类里的静态变量。没用this 因为访问不了这个静态属性。
     */
    private function __construct($username, $password)
    {
        self::$username = $username;
        self::$password = $password;
    }

    /**
     * 外部无妨访问私有属性static 所以得用connect链接
     * @param $username
     * @param $password
     * @return self
     */
    public static function connect($username, $password): object
    {
        // 这里我们省略了数据库连接的实现细节
        // 使用 pdo 扩展来连接数据库
        //$instance 只在保存唯一实例的时候用
        //因为是唯一的数据库 localhost：school
        return self::$instance = new self($username, $password);
    }

    public static function query(string $sql): string
    {
        return "Executing query: $sql<br>";
    }

    /**
     * 禁止克隆
     *
     * @throws Exception
     */
    private function __clone()
    {
        throw new Exception("Cannot clone a singleton class");
    }
}

$connection = Database::connect('root', 'password');
varDumpWithBr($connection);
echoWithBr(Database::$host);

// $database = new Database('root', 'password');
// $databaseClone = clone $database;


//Trait 是一种为类**添加一组可复用方法**的机制
//谁都能继承 不只是父传子
//定义一个分享类
trait Shareable
{
    public function share(string $name): string
    {
        return "Sharing this {$name}<br>";
    }

    protected function log(string $message): string
    {
        return "Logging message: $message<br>";
    }

    abstract protected function getShareTitle(): string;
}

//在定义一个 controller
//

class Controller
{
    // ... 基础类!!!
    // 变成json格式来看
    //
    public function responseJson(array $data, int $status = 200, string $message = 'success'): string
    {
        return json_encode([
            'status' => 200,
            'message' => 'success',
            'data' => $data
        ]);
    }
}

//定义post继承controller
//use 使用上面的 共享 定义好的shareable
class Post extends Controller
{
    use Shareable;

    public function getShareTitle(): string
    {
        return "Sharing a post<br>";
    }

    public function getShare(): string
    {
        return $this->share('albert');
    }

    /**
     * 获取 Post 详情
     *
     * @return string
     */
    public function show(): string
    {
        $post = [
            'id' => 1,
            'title' => 'Hello World',
            'content' => 'This is a sample post'
        ];

        return $this->responseJson($post);
    }
}

$post = new Post();
echoWithBr($post->getShare());
echoWithBr($post->show());

class TestMagic
{
    public string $name = "TestMagic";

    public function __construct()
    {
        echo "Constructor called<br>";
    }

    /**
     * 当 PHP 试图访问一个不存在的方法时, 会自动调用 __call() 方法
     *
     * @param string $name
     * @param mixed $arguments
     */
    public function __call(string $name, mixed $arguments)
    {
        echoWithBr("你正在尝试访问一个不存在的方法: $name 这时 __call 会被自动调用, 当前被自动调用的方法名是:" . __FUNCTION__ . "<br>");
        echo "Method $name does not exist. Arguments: " . implode(", ", $arguments) . "<br>";
    }

    public static function __callStatic($name, $arguments)
    {
        echo "Static method $name does not exist. Arguments: " . implode(", ", $arguments) . "<br>";
    }

    public function __get($name)
    {
        echo "Getting property '$name'<br>";
        return $this->name;
    }

    public function __set($name, $value)
    {
        echo "Setting property '$name' to '$value'<br>";
        $this->name = $value;
    }

    public function __isset($name)
    {
        echo "Checking if property '$name' is set<br>";
        return isset($this->$name);
    }

    public function __unset($name)
    {
        echo "Unsetting property '$name'<br>";
        unset($this->$name);
    }
}

echoHr();

$testMagic = new TestMagic();

$testMagic->nonExistentMethod("arg1", "arg2");

$testMagic->nonExistentProp = "这里是东京啊!";

unset($testMagic->nonExistentProp);