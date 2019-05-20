![Design Patterns cho mọi người](https://cloud.githubusercontent.com/assets/11269635/23065273/1b7e5938-f515-11e6-8dd3-d0d58de6bb9a.png)

***

<p align="center">
🎉 Phần giải thích cực kì đơn giản về design patterns! 🎉
</p>
<p align="center">
Đây là một chủ đề có thể khiến tâm trí của bất kì ai lay động rất dễ dàng. Ở đây tôi sẽ cố gắng giúp bạn nhớ nó thật lâu (và có thể là cả tôi nữa) bằng cách giải thích chúng bằng những cách <i>đơn giản nhất</i> có thể.
</p>

***

<sub>Xem qua [blog](http://kamranahmed.info) của tôi và tương tác trên [Twitter](https://twitter.com/kamranahmedse).</sub>

Giới thiệu
=================

Design pattern là những giải pháp cho những vấn đề thường gặp; **hướng dẫn cách giải quyết cho những vấn đề nhất định**. Chúng không phải là những class, package hay thư viện mà bạn có thể nhúng vào ứng dụng của mình và chờ đợi điều kì diệu xảy ra. Mà chúng chỉ là những hướng dẫn về cách giải quyết các vấn đề nhất định trong những tình huống nhất định.

> Design pattern là những giải pháp cho những vấn đề thường gặp; hướng dẫn giải quyết các vấn đề nhất định.

Wikipedia mô tả chúng như sau:

> Trong lĩnh vực kĩ nghệ phần mềm, một design pattern của phần mềm là một giải pháp cho việc tái sử dụng chung cho những vấn đề thường xảy ra trong lĩnh vực thiết kế phần mềm. Nó không phải là những thiết kế hoàn chỉnh có thể chuyển thành mã nguồn hoặc mã máy. Nó chỉ là mô tả hoặc template cho việc làm sao để giải quyết vấn đề có thể sử dụng cho các tình huống khác nhau.

⚠️ Hãy cẩn thận
-----------------
- Các design pattern không phải là những nút bạc cho tất cả các vấn đề của bạn.
- Đừng cố ép buộc chúng; những thứ rất tệ có thể sẽ xảy ra nếu làm như vậy.
- Nhớ những design pattern này chỉ là giải pháp cho các vấn đề, không phải là giải pháp để tìm ra các vấn đề; vì thế nên đừng nghĩ quá nhiều về nó.
- Nếu sử dụng đúng lúc đúng chỗ, chúng có thể chứng minh mình là những vị cứu tinh, hoặc chúng có thể dẫn tới một mớ code hỗn độn kinh khủng.

> Chú ý thêm là các ví dụ code thực hiện trên PHP-7, tuy nhiên điều này không ảnh hưởng tới bạn vì các khái niệm là giống nhau.

Các loại Design Pattern
-----------------

* [Creational](#creational-design-patterns)
* [Structural](#structural-design-patterns)
* [Behavioral](#behavioral-design-patterns)

Creational Design Patterns
==========================

Nói một cách đơn giản
> Các creational pattern tập trung vào việc làm sao để khởi tạo một đối tượng hoặc một nhóm các đối tượng có liên hệ với nhau.

Wikipedia định nghĩa như sau:
> Trong lĩnh vực kĩ nghệ phần mềm, các creational design pattern là những design pattern sử dụng cho việc khởi tạo các đối tượng, cố gắng tạo các đối tượng theo các phù hợp nhất với mỗi tình huống khác nhau. Hình thức tạo một đối tượng cơ bản có thể dẫn đến các vấn đề về thiết kế hoặc làm tăng độ phức tạp của thiết kế. Các creational design pattern giải quyết vấn đề bằng cách kiểm soát việc tạo đối tượng này.
 * [Simple Factory](#-simple-factory)
 * [Factory Method](#-factory-method)
 * [Abstract Factory](#-abstract-factory)
 * [Builder](#-builder)
 * [Prototype](#-prototype)
 * [Singleton](#-singleton)

🏠 Simple Factory
--------------
Ví dụ thực tế
> Hãy xem xét việc này, bạn đang xây dựng một ngôi nhà và bạn cần những cái cửa. Bạn có thể mặc những bộ đồ bảo hộ của thợ mộc, mang về 1 ít gỗ, keo, đinh và tất cả những công cụ cần thiết để tạo ra một cái cửa và bắt đầu xây dựng nó trong chính ngôi nhà của bạn hoặc đơn giản hơn bạn chỉ cần gọi tới nhà máy và nhận được cái cửa đã được hoàn thiện trước đó vì thế bạn không cần học mọi thứ về cách tạo ra một cái cửa hay phải đối mặt với mớ hỗn độn khi tạo ra nó.

Nói một cách đơn giản
> Simple factory chỉ đơn giản là tạo ra những phiên bản cho client mà không cần lộ ra bất kì một logic về việc khởi tạo nào tới phía người dùng.

Wikipedia says
> Trong lập trình hướng đối tượng (OOP), một factory là một object được dùng để tạo ra các object khác - thường thì factory là một function hoặc method trả về những object nguyên bản hoặc class từ những method được gọi, được giải định như là "new".

**Code ví dụ**

Đầu tiên chúng ta có một interface của door và implementation.

```php
interface Door
{
    public function getWidth(): float;
    public function getHeight(): float;
}

class WoodenDoor implements Door
{
    protected $width;
    protected $height;

    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }
}
```

Tiếp theo chúng ta có một nhà máy tạo ra cửa và trả về nó

```php
class DoorFactory
{
    public static function makeDoor($width, $height): Door
    {
        return new WoodenDoor($width, $height);
    }
}
```

Và nó có thể sử dụng như sau

```php
// tạo một cái cửa có kích thước 100x200
$door = DoorFactory::makeDoor(100, 200);

echo 'Width: ' . $door->getWidth();
echo 'Height: ' . $door->getHeight();

// tạo một cái cửa có kích thước 50x100
$door2 = DoorFactory::makeDoor(50, 100);
```

**Sử dụng khi nào?**

Khi tạo một object thì nó không đơn giản chỉ là đưa ra mà còn liên quan tới một vài vấn đề logic, hãy ghi nhớ việc đặt nó vào trong một factory chuyên dụng thay vì lặp lại đoạn code tương tự ở mọi nơi.

🏭 Factory Method
--------------

Ví dụ thực tế

> Xem xét trường hợp của một quản lý về tuyển dụng. Một người không thể phỏng vấn ở mỗi vị trí. Dựa trên những công việc đang mở, cô ấy phải quyết định và ủy nhiệm các bước phỏng vấn cho những người khác nhau.

Nói một cách đơn giản
> Nó cung cấp một cách để ủy thác các logic về khởi tạo cho những class con. 

Wikipedia định nghĩa là 
> Trong class - cơ sở của lập trình, factory method pattern là một creational pattern mà sử dụng các method factory để giải quyết vấn đề về khởi tạo các object mà không cần xác định chính xác class của object mà sẽ được tạo ra. Điều này được thực hiện bằng cách tạo ra những object thông qua việc gọi một method factory - hoặc được chỉ định trong interface và implement bởi các class con, hoặc được implement trong class base và ghi đè tùy ý bởi các class dẫn xuất - thay vì được gọi thông qua hàm khởi tạo.

 **Ví dụ trong lập trình**

lấy ví dụ về quản lý tuyển dụng ở trên. Đầu tiên chúng ta có một interface interviewer và một vài class implement nó.

```php
interface Interviewer
{
    public function askQuestions();
}

class Developer implements Interviewer
{
    public function askQuestions()
    {
        echo 'Asking about design patterns!';
    }
}

class CommunityExecutive implements Interviewer
{
    public function askQuestions()
    {
        echo 'Asking about community building';
    }
}
```

Bây giờ chúng ta tạo ra `HiringManager`

```php
abstract class HiringManager
{

    // Factory method
    abstract protected function makeInterviewer(): Interviewer;

    public function takeInterview()
    {
        $interviewer = $this->makeInterviewer();
        $interviewer->askQuestions();
    }
}

```

Giờ mọi child có thể extend nó và được cung cấp cho các imterviewer một cách bắt buộc

```php
class DevelopmentManager extends HiringManager
{
    protected function makeInterviewer(): Interviewer
    {
        return new Developer();
    }
}

class MarketingManager extends HiringManager
{
    protected function makeInterviewer(): Interviewer
    {
        return new CommunityExecutive();
    }
}
```

và sau đó nó có thể sử dụng như sau

```php
$devManager = new DevelopmentManager();
$devManager->takeInterview(); // Output: Asking about design patterns

$marketingManager = new MarketingManager();
$marketingManager->takeInterview(); // Output: Asking about community building.
```

**Sử dụng khi nào?**

Nó hữu dụng khi có một số việc được sử lý chung trong một class nhưng các class con được yêu cầu có thể được đưa ra bởi các quyết định linh động trong khi chạy. Hay nói cách khác, khi client không biết chính xác class con nào là cần thiết.

🔨 Abstract Factory
----------------

Ví dụ thực tế
> Mở rộng ví dụ về cửa ở trên Simple Factory. Dựa trên việc bạn cần là lấy một chiếc cửa gỗ từ cửa hàng cửa gỗ, cửa sắt từ cửa hàng sắt hoặc cửa nhựa từ một cửa hàng liên quan. thêm vào đó là bạn cần những người với các đặc điểm khác nhau để phù hợp với cái cửa đó, ví dụ như bạn cần một thợ mộc cho chiếc cửa gỗ, thợ hàn cho chiếc cửa sắt,... Và giờ bạn đã thấy sự phụ thuộc khác nhau giữa những chiếc cửa, cửa gỗ cần thợ mộc, cửa sắt cần thợ hàn,..

Nói một cách ngắn gọn
> một factory của các factory; một factory nhóm những cá thể nhưng các factory liên kết/phụ thuộc lẫn nhau mà không cần chỉ rõ các class cụ thể của nó.

Wikipedia định nghĩa là 
> abstract factory pattern cung cấp một cách để đóng gói một nhóm những cá thể factory có cùng một chủ đề mà không cần kai báo class cụ thể của chúng.

**Ví dụ trong lập trình**

Sử dụng lại ví dụ về cửa ở trên. Đầu tiên chúng ta có một interface `Door` và một vài class khác implement nó

```php
interface Door
{
    public function getDescription();
}

class WoodenDoor implements Door
{
    public function getDescription()
    {
        echo 'I am a wooden door';
    }
}

class IronDoor implements Door
{
    public function getDescription()
    {
        echo 'I am an iron door';
    }
}
```

Sau đó chúng ta sử dụng một vài chuyên gia phù hợp với mỗi loại cửa

```php
interface DoorFittingExpert
{
    public function getDescription();
}

class Welder implements DoorFittingExpert
{
    public function getDescription()
    {
        echo 'I can only fit iron doors';
    }
}

class Carpenter implements DoorFittingExpert
{
    public function getDescription()
    {
        echo 'I can only fit wooden doors';
    }
}
```

Bây giờ chúng ta có abstract factory sẽ cho phép chúng ta tạo ra một nhóm các object có liên quan tới nhau. ví dụ như nhà máy cửa gỗ sẽ tạo ra cửa gỗ và chuyên gia phù hợp với cửa gỗ, và nhà máy cửa sắt tạo ta cửa sắt và chuyên gia phù hợp với cửa sắt.

```php
interface DoorFactory
{
    public function makeDoor(): Door;
    public function makeFittingExpert(): DoorFittingExpert;
}

// Wooden factory to return carpenter and wooden door
class WoodenDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new WoodenDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Carpenter();
    }
}

// Iron door factory to get iron door and the relevant fitting expert
class IronDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new IronDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Welder();
    }
}
```

Và sau đó nó có thể được sử dụng như sau:

```php
$woodenFactory = new WoodenDoorFactory();

$door = $woodenFactory->makeDoor();
$expert = $woodenFactory->makeFittingExpert();

$door->getDescription();  // Output: I am a wooden door
$expert->getDescription(); // Output: I can only fit wooden doors

// Same for Iron Factory
$ironFactory = new IronDoorFactory();

$door = $ironFactory->makeDoor();
$expert = $ironFactory->makeFittingExpert();

$door->getDescription();  // Output: I am an iron door
$expert->getDescription(); // Output: I can only fit iron doors
```

Như bạn có thể thấy thì một nhà máy cửa gỗ được đóng gói cả `thợ mộc` và `cửa gỗ` cũng như nhà máy cửa sắp đóng gói cả `cửa sắt` và `thợ hàn`. Và do đó nó đảm bảo với chúng tôi là với mỗi cánh cửa được tạo ra, chúng tôi sẽ không lấy nhầm một chuyên gia.

**Sử dụng khi nào?**

Khi có sự tương quan giữa phụ thuộc và các logic khởi tạo liên quan không đơn giản

👷 Builder
--------------------------------------------
Ví dụ thực tế

> Hãy tưởng tượng là bạn đang ở Hardee's và bạn đặt một đơn hàng đặc biệt, hãy nói "Big hardee" và họ đưa cho bạn mà không có *bất kì câu hỏi nào*; đây là một ví dụ về simple factory.  Nhưng đâu là những trường hợp khi logic khởi tạo liên quan tới nhiều bước. Ví dụ như bạn muốn tùy chỉnh đơn Subway, bạn có nhiều lựa chọn trong việc chiếc burger của bjan được làm như nào như bạn đang muốn bánh mì gì? loại sốt mà bạn muốn?... Trong những trường hợp như vậy, builder pattern được sử dụng như một giải pháp.

Nói một cách ngắn gọn
> Cho phép bạn bạn tạo các đặc điểm khác nhau của object trong khi tránh bị ảnh hưởng việc khởi tạo. Nó hữu dụng khi có thể tạo nhiều tùy chọn cho một object. Hoặc khi có quá nhiều bước trong việc tạo ra một object.

Wikipedia định nghĩa là
> Builder pattern là một object thuộc nhóm design pattern khởi tạo phần mềm với ý tưởng tìm kiếm giải pháp chống lại việc khởi tạo.

Hãy để tôi giới thiệu thêm một chút về mô hình chống lại việc khởi tạo này. Tại một thời điểm khác, chúng tôi đã thấy một constructor như dưới đây:

```php
public function __construct($size, $cheese = true, $pepperoni = true, $tomato = false, $lettuce = true)
{
}
```

Như bạn thấy, số lượng tham số của hàm khởi tạo có thể nhanh chóng làm bạn mất kiểm soát và nó dần trở nên rất khó hiểu về sự sắp xếp các tham số. Thêm nữa là danh sách những tham số có thể tiếp tục phát triển nếu bạn muốn thêm nhiều option trong tương lai. Điều này được gọi là mô hình chống lại việc khởi tạo.

**Ví dụ trong lập trình**

Cách thay thế hợp lý là sử dụng builder pattern. Đầu tiên chúng ta đang muốn làm một chiếc bánh mì kẹp cho mình.

```php
class Burger
{
    protected $size;

    protected $cheese = false;
    protected $pepperoni = false;
    protected $lettuce = false;
    protected $tomato = false;

    public function __construct(BurgerBuilder $builder)
    {
        $this->size = $builder->size;
        $this->cheese = $builder->cheese;
        $this->pepperoni = $builder->pepperoni;
        $this->lettuce = $builder->lettuce;
        $this->tomato = $builder->tomato;
    }
}
```

Và chúng ta có một builder

```php
class BurgerBuilder
{
    public $size;

    public $cheese = false;
    public $pepperoni = false;
    public $lettuce = false;
    public $tomato = false;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function addPepperoni()
    {
        $this->pepperoni = true;
        return $this;
    }

    public function addLettuce()
    {
        $this->lettuce = true;
        return $this;
    }

    public function addCheese()
    {
        $this->cheese = true;
        return $this;
    }

    public function addTomato()
    {
        $this->tomato = true;
        return $this;
    }

    public function build(): Burger
    {
        return new Burger($this);
    }
}
```

Và sau đó có thể sử dụng như sau:

```php
$burger = (new BurgerBuilder(14))
                    ->addPepperoni()
                    ->addLettuce()
                    ->addTomato()
                    ->build();
```

**Sử dụng khi nào?**

Khi có thể có một số đặc điểm của object và tránh việc chống lại khởi tạo. Sự khác biệt chính của factory pattern là đây; factory pattern được sử dụng khi việc khởi tạo chỉ có một bước trong tiến trình trong khi builder pattern được sử dụng khi có nhiều bước trong quá trình.

🐑 Prototype
------------
Ví dụ thực tế
> Bạn có nhớ dolly? Con cừu mà được nhân bản! Việc cho phép không nhận những thông tin chi tiết nhưng điểm mấu chốt ở đây là tất cả những thứ được nhân bản.

Nói một cách ngắn gọn
> Việc tạo object dựa trên một object đã tồn tại thông qua việc nhân bản.

Wikipedia định nghĩa là:
> Prototype pattern là một creational design pattern trong phát triển phần mềm. Nó được sử dụng khi kiểu của object cần tạo được định nghĩa bởi một thực thể nguyên mẫu, giống nhwu việc nhân bản nó để tạo ra một object mới.

Nói ngắn gọn, nó cho phép bạn tạo một bản sao chpes một object đã tồn tại và sửa đổi nó theo nhu cầu của bạn thay vì trải qua các sự cố khi tạo một object từ đầu và thiết lập lại nó.

**Ví dụ trong lập trình**

Trong PHP, nó khá dễ dàng để sử dụng `clone`

```php
class Sheep
{
    protected $name;
    protected $category;

    public function __construct(string $name, string $category = 'Mountain Sheep')
    {
        $this->name = $name;
        $this->category = $category;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }
}
```

Sau đó nó có thể clone như dưới đây

```php
$original = new Sheep('Jolly');
echo $original->getName(); // Jolly
echo $original->getCategory(); // Mountain Sheep

// Clone and modify what is required
$cloned = clone $original;
$cloned->setName('Dolly');
echo $cloned->getName(); // Dolly
echo $cloned->getCategory(); // Mountain sheep
```

bạn cũng có thể sử dụng magic method `__clone` để sửa đổi các hành vi khi nhân bản.

**sử dụng khi nào?**

Khi một object được yêu cầu phải tương tự như object hiện có hoặc khi việc khởi tạo mất nhiều công hơn việc nhân bản.

💍 Singleton
------------

Ví dụ thực tế
> Cùng một lúc chỉ có thể có một tổng thống đối với mỗi quốc gia. Cùng một tổng thống phải đưa ra được hành động bất cứ khi nào nhiệm vụ gọi. Tổng thống ở đâu là một singleton.

Nói một cách ngắn gọn 
> Đảm bảo là chỉ có một đối tượng duy nhất của mỗi class được tạo ra.

Wikipedia định nghĩa là
> Trong kĩ nghệ phần mềm, singleton pattern là một design pattern của phần mềm mà nó hạn chế sự khởi tạo của mỗi class chỉ thành một object. Điều này khá hữu dụng khi cần chính xác một object để điều phối các hành động trên hệ thống.

Singleton pattern thực sự được coi là một pattern có tính chống lại và nên hạn chế sử dụng nó nhất có thể. Nó không hẳn là không cần thiết mà trong một số trường hợp nên sử dụng nó cẩn thận vì nó tạo ra một số trạng thái ở mức global trên ứng dụng của bạn  và việc thay đổi nó ở nơi này có thể dẫn tới việc ảnh hưởng ở nơi khác và rất khó để debug được. Một ảnh hưởng tệ khác là nó khiến code của bạn bị gắn kết chặt chẽ cộng với việc sử dụng singleton có thể rất khó khăn.

**Ví dụ trong lập trình**

Để tạo ra một singleton, phải đặt private cho hàm khởi tạo, 
vô hiệu hóa việc nhân bản, vô hiệu hóa việc mở rộng và tạo ra các biến static để chứa các instance nhất định

```php
final class President
{
    private static $instance;

    private function __construct()
    {
        // Hide the constructor
    }

    public static function getInstance(): President
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone()
    {
        // Disable cloning
    }

    private function __wakeup()
    {
        // Disable unserialize
    }
}
```

Sau đó để sử dụng

```php
$president1 = President::getInstance();
$president2 = President::getInstance();

var_dump($president1 === $president2); // true
```

Structural Design Patterns
==========================
Nói một cách đơn giản

> Structural pattern chủ yếu quan tâm tới các thành phần đối tượng hay nói cách khác là các thực thể có thể tương tác lẫn nhau như thế nào. Hoặc cách giải thích khác là, chúng giá ta trả lời câu hỏi "Làm sao để xây dựng một phần mềm hướng component?"

Wikipedia định nghĩa là
> Trong lĩnh vực kĩ nghệ phần mềm, structural design pattern là các design pattern được thiết kế dễ dàng bằng cách xác định đơn giản các mối quan hệ giữa các thực thể. 

 * [Adapter](#-adapter)
 * [Bridge](#-bridge)
 * [Composite](#-composite)
 * [Decorator](#-decorator)
 * [Facade](#-facade)
 * [Flyweight](#-flyweight)
 * [Proxy](#-proxy)

🔌 Adapter
-------
Ví dụ thực tế
> Giả sử là bạn đang có một số hình ảnh trong thẻ nhớ của mình và bạn cần chuyển chúng vào máy tính. Để chuyển được chúng bạn cần có thứ gì đó như adapter có khả năng tương thích với máy tính của mình để bạn có thể kết nối thẻ nhớ vào máy tính. Trong trường hợp này đầu đọc thẻ (card reader) là một adapter.

> Một ví dụ khác như bộ nguồn adapter nổi tiếng; chiếc ổ cắm 3 chân không thể kết nối với đầu ra hai chân, nó cần sử dụng một power adapter giúp nó tương thích với đầu ra 2 chân.

> Một ví dụ khác là một người dịch giả sẽ dịch những từ do một người nói ra cho người khác.

Nói một cách đơn giản

> Adapter pattern cho phép bạn đóng gói một object không tương thích vào một adapter và giúp nó tương thích với một class khác

Wikipedia định nghĩa là
> Trong kĩ nghệ phần mềm, adapter pattern là một design pattern trong lĩnh vực phần mềm cho phép interface của một class đã tồn tại có thể sử dụng được như một interface khác. Nó thường được sử dụng để giúp các class đã tồn tại làm việc được với những class khác mà không cần chỉnh sửa source code.

**Ví dụ lập trình**

Hãy xem qua một trò chơi về người thợ săn là anh ta săn sư tử.

Đầu tiên hãy tạo một interface `Lion` mà tất cả các loại sư tử có thể implement

```php
interface Lion
{
    public function roar();
}

class AfricanLion implements Lion
{
    public function roar()
    {
    }
}

class AsianLion implements Lion
{
    public function roar()
    {
    }
}
```

Và thợ săn hi vọng tất cả những thứ implement từ `Lion` để săn.

```php
class Hunter
{
    public function hunt(Lion $lion)
    {
        $lion->roar();
    }
}
```

Bây giờ giả sử chúng ta thêm một `WildDog` vào game để thợ săn cũng có thể săn nó. Nhưng chúng ta không thể làm việc này trực tiếp vì chó thuộc một interface khác. Để nó tương thích với thợ săn của chúng ta, chúng ta sẽ tạo một adapter để nó tương thích được

```php
// This needs to be added to the game
class WildDog
{
    public function bark()
    {
    }
}

// Adapter around wild dog to make it compatible with our game
class WildDogAdapter implements Lion
{
    protected $dog;

    public function __construct(WildDog $dog)
    {
        $this->dog = $dog;
    }

    public function roar()
    {
        $this->dog->bark();
    }
}
```

Và bây giờ thì `WildGod` có thể được sử dụng trong game của chúng ta thông qua việc dùng `WildDogAdapter`

```php
$wildDog = new WildDog();
$wildDogAdapter = new WildDogAdapter($wildDog);

$hunter = new Hunter();
$hunter->hunt($wildDogAdapter);
```

🚡 Bridge
------
Ví dụ thực tế

> Hãy xem việc bạn có một website và các trang khác nhau và bạn có nhiệm vụ phải cho phép người dùng có thể thay đổi theme. Bạn sẽ làm gì? Tạo ra một loạt các bản copy của mỗi trang cho mỗi theme hoặc bạn chỉ tạo những theme riêng và tải phần base của chúng dựa trên phần tùy chỉnh của mỗi user? Bridge pattern cho phép bạn thực hiện cách thứ 2 như này

![With and without the bridge pattern](https://cloud.githubusercontent.com/assets/11269635/23065293/33b7aea0-f515-11e6-983f-98823c9845ee.png)

Nói một cách đơn giản
> Bridge pattern thiên về mô hình composition thay vì inheritence (kế thừa). Chi tiết việc implement được đẩy từ một hệ thống phân cấp tới các object khác với hệ thống phân cấp riêng biệt.

Wikipedia định nghĩa là
> Bridge pattern là một design pattern được sử dụng trong kĩ nghệ phần mềm mà nó được định nghĩa là "tách rời một lớp abstract từ implement của nó thành hai phần có thể thay đổi độc lập"

**Ví dụ trong lập trình**

Ví dụ như việc dịch trang web của chúng ta từ trên xuống. Ở đây chúng ta có một hệ thống cấp bậc `WebPage`

```php
interface WebPage
{
    public function __construct(Theme $theme);
    public function getContent();
}

class About implements WebPage
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function getContent()
    {
        return "About page in " . $this->theme->getColor();
    }
}

class Careers implements WebPage
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function getContent()
    {
        return "Careers page in " . $this->theme->getColor();
    }
}
```
Và các theme phân cấp riêng biệt 
```php

interface Theme
{
    public function getColor();
}

class DarkTheme implements Theme
{
    public function getColor()
    {
        return 'Dark Black';
    }
}
class LightTheme implements Theme
{
    public function getColor()
    {
        return 'Off white';
    }
}
class AquaTheme implements Theme
{
    public function getColor()
    {
        return 'Light blue';
    }
}
```

Và cả hai hệ thống phân cấp

```php
$darkTheme = new DarkTheme();

$about = new About($darkTheme);
$careers = new Careers($darkTheme);

echo $about->getContent(); // "About page in Dark Black";
echo $careers->getContent(); // "Careers page in Dark Black";
```

🌿 Composite
-----------------

ví dụ thực tế
> Mọi tổ chức đều bao gồm các thành viên. Mỗi một thành viên có các tính năng giống nhau như là có lương, có một số trách nhiệm, có thể hoặc không thể báo cáo cho ai đó, có thể hoặc không thể có một vài cấp dưới...

Nói ngắn gọn
> Composite pattern cho phép client xử lý các đối tượng theo một cách thống nhất.

Wikipedia định nghĩa là
> Trong kĩ nghệ phần mềm, composite pattern là một design pattern thuộc nhóm phân vùng. Composite pattern mô tả về một nhóm các object được xử lý cùng một cách giống như một instance của object. Mục đích của composite là "tạo ra" các object vào một cấu trúc dạng cây để đại diện cho toàn bộ hệ thống phân cấp. Việc triển khai composite pattern cho phép client xử lý các đối tượng và bố cục riêng lẻ một cách thống nhất.

**Ví dụ trong lập trình**

Lấy ví dụ về nhân viên ở phía trên. Ở đây chúng ta có các loại nhân viên khác nhau

```php
interface Employee
{
    public function __construct(string $name, float $salary);
    public function getName(): string;
    public function setSalary(float $salary);
    public function getSalary(): float;
    public function getRoles(): array;
}

class Developer implements Employee
{
    protected $salary;
    protected $name;
    protected $roles;
    
    public function __construct(string $name, float $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSalary(float $salary)
    {
        $this->salary = $salary;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}

class Designer implements Employee
{
    protected $salary;
    protected $name;
    protected $roles;

    public function __construct(string $name, float $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSalary(float $salary)
    {
        $this->salary = $salary;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
```

Sau đó chúng ta có một tổ chức với nhiều kiểu nhân viên khác nhau

```php
class Organization
{
    protected $employees;

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function getNetSalaries(): float
    {
        $netSalary = 0;

        foreach ($this->employees as $employee) {
            $netSalary += $employee->getSalary();
        }

        return $netSalary;
    }
}
```

Và nó có thể được sử dụng như sau:

```php
// Prepare the employees
$john = new Developer('John Doe', 12000);
$jane = new Designer('Jane Doe', 15000);

// Add them to organization
$organization = new Organization();
$organization->addEmployee($john);
$organization->addEmployee($jane);

echo "Net salaries: " . $organization->getNetSalaries(); // Net Salaries: 27000
```

☕ Decorator
-------------

Ví dụ thực tế
> Hãy tưởng tượng bạn đang có cửa hàng dịch vụ xe hơi và cung cấp nhiều dịch vụ khác nhau. Bây giờ bạn phải tính hóa đơn như nào? Bạn chọn một dịch vụ và tự động bổ sung giá của các dịch vụ đã cung cấp cho đến khi bạn nhận được chi phí cuối cùng. Ở đây mỗi loại dịch vụ là một decorator.

Nói ngắn gọn

> Decorator pattern cho phép bạn tự động thay đổi các hành vi của một object ngay trong khi đang chạy bằng việc đóng gói chúng vào trong một object của một class decorator. 

Wikipedia định nghĩa là

> Trong lập trình hướng đối tượng, decorator pattern là một design pattern mà cho phép hành động thêm vào các object riêng lẻ, tĩnh hoặc động mà không ảnh hưởng lên hành vi của các object khác trong cùng class. Decorator pattern khá hữu dụng trong việc tôn trọng nguyên tắc Single Responsibility Principle, vì nó cho phép các chức năng được phân chia giữa các class mà nó quan tâm tới những khu vực duy nhất

**Ví dụ trong lập trình**

Lấy caffee là ví dụ. Đầu tiên tất cả chúng ta có một cốc caffee đơn giản được implement từ interface caffee.

```php
interface Coffee
{
    public function getCost();
    public function getDescription();
}

class SimpleCoffee implements Coffee
{
    public function getCost()
    {
        return 10;
    }

    public function getDescription()
    {
        return 'Simple coffee';
    }
}
```

Chúng ta muốn có thể mở rộng code để cho phép sửa đổi các tuỳ chọn nếu nó được yêu cầu.  Hãy tạo ra một vài add-on (decorator).

```php
class MilkCoffee implements Coffee
{
    protected $coffee;

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 2;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ', milk';
    }
}

class WhipCoffee implements Coffee
{
    protected $coffee;

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 5;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ', whip';
    }
}

class VanillaCoffee implements Coffee
{
    protected $coffee;

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 3;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ', vanilla';
    }
}
```

Giờ hãy tạo ra một ly coffee nào

```php
$someCoffee = new SimpleCoffee();
echo $someCoffee->getCost(); // 10
echo $someCoffee->getDescription(); // Simple Coffee

$someCoffee = new MilkCoffee($someCoffee);
echo $someCoffee->getCost(); // 12
echo $someCoffee->getDescription(); // Simple Coffee, milk

$someCoffee = new WhipCoffee($someCoffee);
echo $someCoffee->getCost(); // 17
echo $someCoffee->getDescription(); // Simple Coffee, milk, whip

$someCoffee = new VanillaCoffee($someCoffee);
echo $someCoffee->getCost(); // 20
echo $someCoffee->getDescription(); // Simple Coffee, milk, whip, vanilla
```

📦 Facade
----------------

Real world example
Ví dụ trong thực tế 

> Làm sao để mở một chiếc máy tính? Bạn nói là "Bấm nút nguồn"! Đây là thứ mà bạn tin vì bạn sử dụng một interface rất đơn giản do computer cung cấp ra phía bên ngoài, nhưng trong nó thì phải thực hiện rất nhiều thứ mới có thể làm được hành động đó. Interface đơn giản này đại diện cho một hệ thống con được gọi là facade.

Nói ngắn gọn
> Facade pattern cung cấp một một interface đơn giản để đại diện cho một hệ thống con

Wikipedia định nghĩa là
> Một facade cung cấp một interface đơn giản hoá cho một phần code khá lớn, như là một class trong thư viện.

**Ví dụ trong lập trình**

Lấy ví dụ về chiếc máy tính của chúng ta ở trên. Ở đây chúng ta có một class computer.

```php
class Computer
{
    public function getElectricShock()
    {
        echo "Ouch!";
    }

    public function makeSound()
    {
        echo "Beep beep!";
    }

    public function showLoadingScreen()
    {
        echo "Loading..";
    }

    public function bam()
    {
        echo "Ready to be used!";
    }

    public function closeEverything()
    {
        echo "Bup bup bup buzzzz!";
    }

    public function sooth()
    {
        echo "Zzzzz";
    }

    public function pullCurrent()
    {
        echo "Haaah!";
    }
}
```
Chúng ta có một facade
```php
class ComputerFacade
{
    protected $computer;

    public function __construct(Computer $computer)
    {
        $this->computer = $computer;
    }

    public function turnOn()
    {
        $this->computer->getElectricShock();
        $this->computer->makeSound();
        $this->computer->showLoadingScreen();
        $this->computer->bam();
    }

    public function turnOff()
    {
        $this->computer->closeEverything();
        $this->computer->pullCurrent();
        $this->computer->sooth();
    }
}
```
Giờ chúng ta sẽ xử dụng facade đó
```php
$computer = new ComputerFacade(new Computer());
$computer->turnOn(); // Ouch! Beep beep! Loading.. Ready to be used!
$computer->turnOff(); // Bup bup buzzz! Haah! Zzzzz
```

🍃 Flyweight
---------

Ví dụ trong thực tế

> Bạn đã từng uống trà tươi từ các gian hàng chưa? Họ thường phải làm nhiều hơn một cốc mà bạn yêu cầu và giữ phần còn lại cho bất kì khách hàng nào khác vì thế có thể tiết kiệm được nguyên liệu như gas... Flyweight pattern là tất cả những gì thuộc về nó như việc chia sẻ.

Nói một cách ngắn gọn
> Nó được sử dụng để tối giản bộ nhớ hoặc chi phí về mặt tính toán thông qua việc chia sẻ nhiều nhất có thể với các object tương tự.

Wikipedia định nghĩa là
> Trong lĩnh vực phần mềm máy tính, flyweight là một design pattern của phần mềm. Một flyweight là một object mà tối giản bộ nhớ sử dụng bằng việc chia sẻ nhiều dât nhất có thể với các object tương tự; nó là một cách để sử dụng một lượng lớn các object khi việc biểu diễn đơn giản sẽ sử dụng lượng memory không thể chấp nhận được.

**Ví dụ trong lập trình**

Sử dụng lại ví dụ về trà ở phía trên. Đầu tiên chúng ta có các loại trà và những người pha trà

```php
// Anything that will be cached is flyweight.
// Types of tea here will be flyweights.
class KarakTea
{
}

// Acts as a factory and saves the tea
class TeaMaker
{
    protected $availableTea = [];

    public function make($preference)
    {
        if (empty($this->availableTea[$preference])) {
            $this->availableTea[$preference] = new KarakTea();
        }

        return $this->availableTea[$preference];
    }
}
```

Tiếp theo chúng ta có `TeaShop` sẽ nhận order và cung cấp chúng

```php
class TeaShop
{
    protected $orders;
    protected $teaMaker;

    public function __construct(TeaMaker $teaMaker)
    {
        $this->teaMaker = $teaMaker;
    }

    public function takeOrder(string $teaType, int $table)
    {
        $this->orders[$table] = $this->teaMaker->make($teaType);
    }

    public function serve()
    {
        foreach ($this->orders as $table => $tea) {
            echo "Serving tea to table# " . $table;
        }
    }
}
```
Và nó có thể sử dụng như sau

```php
$teaMaker = new TeaMaker();
$shop = new TeaShop($teaMaker);

$shop->takeOrder('less sugar', 1);
$shop->takeOrder('more milk', 2);
$shop->takeOrder('without sugar', 5);

$shop->serve();
// Serving tea to table# 1
// Serving tea to table# 2
// Serving tea to table# 5
```

🎱 Proxy
-------------------

Ví dụ thực tế 

> Bạn đã bao giờ sử dụng một thẻ truy cập để đi qua một cánh cửa? Có nhiều tùy chọn để mở cánh cửa đó ví dụ nó có thể được mở bằng cách sử dụng thẻ truy cập hoặc bằng cách nhấn một nút để vượt qua bảo mật. Chức năng chính của cửa là để mở nhưng có một proxy được thêm vào đầu nó để thêm một số chức năng. Hãy để tôi giải thích rõ hơn bằng cách sử dụng ví dụ code bên dưới.

In plain words
> Việc sử dụng proxy pattern tức là sử dụng một class đại diện cho tính năng của class khác.


Wikipedia định nghĩa là
> Một proxy, ở dạng tổng quát nhất của nó, là một lớp hoạt động như một giao diện cho một cái gì đó khác. Một proxy là một một đối tượng bao bọc hoặc agent đang được client gọi để truy cập đối tượng phục vụ thực đằng sau bối cảnh. Việc sử dụng proxy chỉ đơn giản là có thể chuyển tiếp đến đối tượng thực, hoặc có thể cung cấp thêm logic.Trong chức năng bổ sung proxy có thể được cung cấp, ví dụ bộ nhớ đệm khi các hoạt động trên đối tượng thực là tài nguyên sâu, hoặc kiểm tra điều kiện tiên quyết trước khi hoạt động trên đối tượng thực được gọi.
  

**Ví dụ trong lập trình**

Lấy ví dụ cửa an ninh của chúng tôi từ trên. Đầu tiên chúng ta có door interface và một implementation của door


```php
interface Door
{
    public function open();
    public function close();
}

class LabDoor implements Door
{
    public function open()
    {
        echo "Opening lab door";
    }

    public function close()
    {
        echo "Closing the lab door";
    }
}
```
Sau đó, chúng tôi có một proxy để bảo đảm bất kỳ cửa nào mà chúng ta muốn

```php
class SecuredDoor
{
    protected $door;

    public function __construct(Door $door)
    {
        $this->door = $door;
    }

    public function open($password)
    {
        if ($this->authenticate($password)) {
            $this->door->open();
        } else {
            echo "Big no! It ain't possible.";
        }
    }

    public function authenticate($password)
    {
        return $password === '$ecr@t';
    }

    public function close()
    {
        $this->door->close();
    }
}
```
Và đây là cách nó có thể được sử dụng

```php
$door = new SecuredDoor(new LabDoor());
$door->open('invalid'); // Big no! It ain't possible.

$door->open('$ecr@t'); // Opening lab door
$door->close(); // Closing lab door
```
Yet another example would be some sort of data-mapper implementation. For example, I recently made an ODM (Object Data Mapper) for MongoDB using this pattern where I wrote a proxy around mongo classes while utilizing the magic method `__call()`. All the method calls were proxied to the original mongo class and result retrieved was returned as it is but in case of `find` or `findOne` data was mapped to the required class objects and the object was returned instead of `Cursor`.

Behavioral Design Patterns
==========================

In plain words
> It is concerned with assignment of responsibilities between the objects. What makes them different from structural patterns is they don't just specify the structure but also outline the patterns for message passing/communication between them. Or in other words, they assist in answering "How to run a behavior in software component?"

Wikipedia says
> In software engineering, behavioral design patterns are design patterns that identify common communication patterns between objects and realize these patterns. By doing so, these patterns increase flexibility in carrying out this communication.

* [Chain of Responsibility](#-chain-of-responsibility)
* [Command](#-command)
* [Iterator](#-iterator)
* [Mediator](#-mediator)
* [Memento](#-memento)
* [Observer](#-observer)
* [Visitor](#-visitor)
* [Strategy](#-strategy)
* [State](#-state)
* [Template Method](#-template-method)

🔗 Chain of Responsibility
-----------------------

Real world example
> For example, you have three payment methods (`A`, `B` and `C`) setup in your account; each having a different amount in it. `A` has 100 USD, `B` has 300 USD and `C` having 1000 USD and the preference for payments is chosen as `A` then `B` then `C`. You try to purchase something that is worth 210 USD. Using Chain of Responsibility, first of all account `A` will be checked if it can make the purchase, if yes purchase will be made and the chain will be broken. If not, request will move forward to account `B` checking for amount if yes chain will be broken otherwise the request will keep forwarding till it finds the suitable handler. Here `A`, `B` and `C` are links of the chain and the whole phenomenon is Chain of Responsibility.

In plain words
> It helps building a chain of objects. Request enters from one end and keeps going from object to object till it finds the suitable handler.

Wikipedia says
> In object-oriented design, the chain-of-responsibility pattern is a design pattern consisting of a source of command objects and a series of processing objects. Each processing object contains logic that defines the types of command objects that it can handle; the rest are passed to the next processing object in the chain.

**Programmatic Example**

Translating our account example above. First of all we have a base account having the logic for chaining the accounts together and some accounts

```php
abstract class Account
{
    protected $successor;
    protected $balance;

    public function setNext(Account $account)
    {
        $this->successor = $account;
    }

    public function pay(float $amountToPay)
    {
        if ($this->canPay($amountToPay)) {
            echo sprintf('Paid %s using %s' . PHP_EOL, $amountToPay, get_called_class());
        } elseif ($this->successor) {
            echo sprintf('Cannot pay using %s. Proceeding ..' . PHP_EOL, get_called_class());
            $this->successor->pay($amountToPay);
        } else {
            throw new Exception('None of the accounts have enough balance');
        }
    }

    public function canPay($amount): bool
    {
        return $this->balance >= $amount;
    }
}

class Bank extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}

class Paypal extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}

class Bitcoin extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}
```

Now let's prepare the chain using the links defined above (i.e. Bank, Paypal, Bitcoin)

```php
// Let's prepare a chain like below
//      $bank->$paypal->$bitcoin
//
// First priority bank
//      If bank can't pay then paypal
//      If paypal can't pay then bit coin

$bank = new Bank(100);          // Bank with balance 100
$paypal = new Paypal(200);      // Paypal with balance 200
$bitcoin = new Bitcoin(300);    // Bitcoin with balance 300

$bank->setNext($paypal);
$paypal->setNext($bitcoin);

// Let's try to pay using the first priority i.e. bank
$bank->pay(259);

// Output will be
// ==============
// Cannot pay using bank. Proceeding ..
// Cannot pay using paypal. Proceeding ..:
// Paid 259 using Bitcoin!
```

👮 Command
-------

Real world example
> A generic example would be you ordering food at a restaurant. You (i.e. `Client`) ask the waiter (i.e. `Invoker`) to bring some food (i.e. `Command`) and waiter simply forwards the request to Chef (i.e. `Receiver`) who has the knowledge of what and how to cook.
> Another example would be you (i.e. `Client`) switching on (i.e. `Command`) the television (i.e. `Receiver`) using a remote control (`Invoker`).

In plain words
> Allows you to encapsulate actions in objects. The key idea behind this pattern is to provide the means to decouple client from receiver.

Wikipedia says
> In object-oriented programming, the command pattern is a behavioral design pattern in which an object is used to encapsulate all information needed to perform an action or trigger an event at a later time. This information includes the method name, the object that owns the method and values for the method parameters.

**Programmatic Example**

First of all we have the receiver that has the implementation of every action that could be performed
```php
// Receiver
class Bulb
{
    public function turnOn()
    {
        echo "Bulb has been lit";
    }

    public function turnOff()
    {
        echo "Darkness!";
    }
}
```
then we have an interface that each of the commands are going to implement and then we have a set of commands
```php
interface Command
{
    public function execute();
    public function undo();
    public function redo();
}

// Command
class TurnOn implements Command
{
    protected $bulb;

    public function __construct(Bulb $bulb)
    {
        $this->bulb = $bulb;
    }

    public function execute()
    {
        $this->bulb->turnOn();
    }

    public function undo()
    {
        $this->bulb->turnOff();
    }

    public function redo()
    {
        $this->execute();
    }
}

class TurnOff implements Command
{
    protected $bulb;

    public function __construct(Bulb $bulb)
    {
        $this->bulb = $bulb;
    }

    public function execute()
    {
        $this->bulb->turnOff();
    }

    public function undo()
    {
        $this->bulb->turnOn();
    }

    public function redo()
    {
        $this->execute();
    }
}
```
Then we have an `Invoker` with whom the client will interact to process any commands
```php
// Invoker
class RemoteControl
{
    public function submit(Command $command)
    {
        $command->execute();
    }
}
```
Finally let's see how we can use it in our client
```php
$bulb = new Bulb();

$turnOn = new TurnOn($bulb);
$turnOff = new TurnOff($bulb);

$remote = new RemoteControl();
$remote->submit($turnOn); // Bulb has been lit!
$remote->submit($turnOff); // Darkness!
```

Command pattern can also be used to implement a transaction based system. Where you keep maintaining the history of commands as soon as you execute them. If the final command is successfully executed, all good otherwise just iterate through the history and keep executing the `undo` on all the executed commands.

➿ Iterator
--------

Real world example
> An old radio set will be a good example of iterator, where user could start at some channel and then use next or previous buttons to go through the respective channels. Or take an example of MP3 player or a TV set where you could press the next and previous buttons to go through the consecutive channels or in other words they all provide an interface to iterate through the respective channels, songs or radio stations.  

In plain words
> It presents a way to access the elements of an object without exposing the underlying presentation.

Wikipedia says
> In object-oriented programming, the iterator pattern is a design pattern in which an iterator is used to traverse a container and access the container's elements. The iterator pattern decouples algorithms from containers; in some cases, algorithms are necessarily container-specific and thus cannot be decoupled.

**Programmatic example**

In PHP it is quite easy to implement using SPL (Standard PHP Library). Translating our radio stations example from above. First of all we have `RadioStation`

```php
class RadioStation
{
    protected $frequency;

    public function __construct(float $frequency)
    {
        $this->frequency = $frequency;
    }

    public function getFrequency(): float
    {
        return $this->frequency;
    }
}
```
Then we have our iterator

```php
use Countable;
use Iterator;

class StationList implements Countable, Iterator
{
    /** @var RadioStation[] $stations */
    protected $stations = [];

    /** @var int $counter */
    protected $counter;

    public function addStation(RadioStation $station)
    {
        $this->stations[] = $station;
    }

    public function removeStation(RadioStation $toRemove)
    {
        $toRemoveFrequency = $toRemove->getFrequency();
        $this->stations = array_filter($this->stations, function (RadioStation $station) use ($toRemoveFrequency) {
            return $station->getFrequency() !== $toRemoveFrequency;
        });
    }

    public function count(): int
    {
        return count($this->stations);
    }

    public function current(): RadioStation
    {
        return $this->stations[$this->counter];
    }

    public function key()
    {
        return $this->counter;
    }

    public function next()
    {
        $this->counter++;
    }

    public function rewind()
    {
        $this->counter = 0;
    }

    public function valid(): bool
    {
        return isset($this->stations[$this->counter]);
    }
}
```
And then it can be used as
```php
$stationList = new StationList();

$stationList->addStation(new RadioStation(89));
$stationList->addStation(new RadioStation(101));
$stationList->addStation(new RadioStation(102));
$stationList->addStation(new RadioStation(103.2));

foreach($stationList as $station) {
    echo $station->getFrequency() . PHP_EOL;
}

$stationList->removeStation(new RadioStation(89)); // Will remove station 89
```

👽 Mediator
========

Real world example
> A general example would be when you talk to someone on your mobile phone, there is a network provider sitting between you and them and your conversation goes through it instead of being directly sent. In this case network provider is mediator.

In plain words
> Mediator pattern adds a third party object (called mediator) to control the interaction between two objects (called colleagues). It helps reduce the coupling between the classes communicating with each other. Because now they don't need to have the knowledge of each other's implementation.

Wikipedia says
> In software engineering, the mediator pattern defines an object that encapsulates how a set of objects interact. This pattern is considered to be a behavioral pattern due to the way it can alter the program's running behavior.

**Programmatic Example**

Here is the simplest example of a chat room (i.e. mediator) with users (i.e. colleagues) sending messages to each other.

First of all, we have the mediator i.e. the chat room

```php
interface ChatRoomMediator 
{
    public function showMessage(User $user, string $message);
}

// Mediator
class ChatRoom implements ChatRoomMediator
{
    public function showMessage(User $user, string $message)
    {
        $time = date('M d, y H:i');
        $sender = $user->getName();

        echo $time . '[' . $sender . ']:' . $message;
    }
}
```

Then we have our users i.e. colleagues
```php
class User {
    protected $name;
    protected $chatMediator;

    public function __construct(string $name, ChatRoomMediator $chatMediator) {
        $this->name = $name;
        $this->chatMediator = $chatMediator;
    }

    public function getName() {
        return $this->name;
    }

    public function send($message) {
        $this->chatMediator->showMessage($this, $message);
    }
}
```
And the usage
```php
$mediator = new ChatRoom();

$john = new User('John Doe', $mediator);
$jane = new User('Jane Doe', $mediator);

$john->send('Hi there!');
$jane->send('Hey!');

// Output will be
// Feb 14, 10:58 [John]: Hi there!
// Feb 14, 10:58 [Jane]: Hey!
```

💾 Memento
-------
Real world example
> Take the example of calculator (i.e. originator), where whenever you perform some calculation the last calculation is saved in memory (i.e. memento) so that you can get back to it and maybe get it restored using some action buttons (i.e. caretaker).

In plain words
> Memento pattern is about capturing and storing the current state of an object in a manner that it can be restored later on in a smooth manner.

Wikipedia says
> The memento pattern is a software design pattern that provides the ability to restore an object to its previous state (undo via rollback).

Usually useful when you need to provide some sort of undo functionality.

**Programmatic Example**

Lets take an example of text editor which keeps saving the state from time to time and that you can restore if you want.

First of all we have our memento object that will be able to hold the editor state

```php
class EditorMemento
{
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}
```

Then we have our editor i.e. originator that is going to use memento object

```php
class Editor
{
    protected $content = '';

    public function type(string $words)
    {
        $this->content = $this->content . ' ' . $words;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function save()
    {
        return new EditorMemento($this->content);
    }

    public function restore(EditorMemento $memento)
    {
        $this->content = $memento->getContent();
    }
}
```

And then it can be used as

```php
$editor = new Editor();

// Type some stuff
$editor->type('This is the first sentence.');
$editor->type('This is second.');

// Save the state to restore to : This is the first sentence. This is second.
$saved = $editor->save();

// Type some more
$editor->type('And this is third.');

// Output: Content before Saving
echo $editor->getContent(); // This is the first sentence. This is second. And this is third.

// Restoring to last saved state
$editor->restore($saved);

$editor->getContent(); // This is the first sentence. This is second.
```

😎 Observer
--------
Real world example
> A good example would be the job seekers where they subscribe to some job posting site and they are notified whenever there is a matching job opportunity.   

In plain words
> Defines a dependency between objects so that whenever an object changes its state, all its dependents are notified.

Wikipedia says
> The observer pattern is a software design pattern in which an object, called the subject, maintains a list of its dependents, called observers, and notifies them automatically of any state changes, usually by calling one of their methods.

**Programmatic example**

Translating our example from above. First of all we have job seekers that need to be notified for a job posting
```php
class JobPost
{
    protected $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}

class JobSeeker implements Observer
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function onJobPosted(JobPost $job)
    {
        // Do something with the job posting
        echo 'Hi ' . $this->name . '! New job posted: '. $job->getTitle();
    }
}
```
Then we have our job postings to which the job seekers will subscribe
```php
class EmploymentAgency implements Observable
{
    protected $observers = [];

    protected function notify(JobPost $jobPosting)
    {
        foreach ($this->observers as $observer) {
            $observer->onJobPosted($jobPosting);
        }
    }

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function addJob(JobPost $jobPosting)
    {
        $this->notify($jobPosting);
    }
}
```
Then it can be used as
```php
// Create subscribers
$johnDoe = new JobSeeker('John Doe');
$janeDoe = new JobSeeker('Jane Doe');

// Create publisher and attach subscribers
$jobPostings = new EmploymentAgency();
$jobPostings->attach($johnDoe);
$jobPostings->attach($janeDoe);

// Add a new job and see if subscribers get notified
$jobPostings->addJob(new JobPost('Software Engineer'));

// Output
// Hi John Doe! New job posted: Software Engineer
// Hi Jane Doe! New job posted: Software Engineer
```

🏃 Visitor
-------
Real world example
> Consider someone visiting Dubai. They just need a way (i.e. visa) to enter Dubai. After arrival, they can come and visit any place in Dubai on their own without having to ask for permission or to do some leg work in order to visit any place here; just let them know of a place and they can visit it. Visitor pattern lets you do just that, it helps you add places to visit so that they can visit as much as they can without having to do any legwork.

In plain words
> Visitor pattern lets you add further operations to objects without having to modify them.

Wikipedia says
> In object-oriented programming and software engineering, the visitor design pattern is a way of separating an algorithm from an object structure on which it operates. A practical result of this separation is the ability to add new operations to existing object structures without modifying those structures. It is one way to follow the open/closed principle.

**Programmatic example**

Let's take an example of a zoo simulation where we have several different kinds of animals and we have to make them Sound. Let's translate this using visitor pattern

```php
// Visitee
interface Animal
{
    public function accept(AnimalOperation $operation);
}

// Visitor
interface AnimalOperation
{
    public function visitMonkey(Monkey $monkey);
    public function visitLion(Lion $lion);
    public function visitDolphin(Dolphin $dolphin);
}
```
Then we have our implementations for the animals
```php
class Monkey implements Animal
{
    public function shout()
    {
        echo 'Ooh oo aa aa!';
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitMonkey($this);
    }
}

class Lion implements Animal
{
    public function roar()
    {
        echo 'Roaaar!';
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitLion($this);
    }
}

class Dolphin implements Animal
{
    public function speak()
    {
        echo 'Tuut tuttu tuutt!';
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitDolphin($this);
    }
}
```
Let's implement our visitor
```php
class Speak implements AnimalOperation
{
    public function visitMonkey(Monkey $monkey)
    {
        $monkey->shout();
    }

    public function visitLion(Lion $lion)
    {
        $lion->roar();
    }

    public function visitDolphin(Dolphin $dolphin)
    {
        $dolphin->speak();
    }
}
```

And then it can be used as
```php
$monkey = new Monkey();
$lion = new Lion();
$dolphin = new Dolphin();

$speak = new Speak();

$monkey->accept($speak);    // Ooh oo aa aa!    
$lion->accept($speak);      // Roaaar!
$dolphin->accept($speak);   // Tuut tutt tuutt!
```
We could have done this simply by having an inheritance hierarchy for the animals but then we would have to modify the animals whenever we would have to add new actions to animals. But now we will not have to change them. For example, let's say we are asked to add the jump behavior to the animals, we can simply add that by creating a new visitor i.e.

```php
class Jump implements AnimalOperation
{
    public function visitMonkey(Monkey $monkey)
    {
        echo 'Jumped 20 feet high! on to the tree!';
    }

    public function visitLion(Lion $lion)
    {
        echo 'Jumped 7 feet! Back on the ground!';
    }

    public function visitDolphin(Dolphin $dolphin)
    {
        echo 'Walked on water a little and disappeared';
    }
}
```
And for the usage
```php
$jump = new Jump();

$monkey->accept($speak);   // Ooh oo aa aa!
$monkey->accept($jump);    // Jumped 20 feet high! on to the tree!

$lion->accept($speak);     // Roaaar!
$lion->accept($jump);      // Jumped 7 feet! Back on the ground!

$dolphin->accept($speak);  // Tuut tutt tuutt!
$dolphin->accept($jump);   // Walked on water a little and disappeared
```

💡 Strategy
--------

Real world example
> Consider the example of sorting, we implemented bubble sort but the data started to grow and bubble sort started getting very slow. In order to tackle this we implemented Quick sort. But now although the quick sort algorithm was doing better for large datasets, it was very slow for smaller datasets. In order to handle this we implemented a strategy where for small datasets, bubble sort will be used and for larger, quick sort.

In plain words
> Strategy pattern allows you to switch the algorithm or strategy based upon the situation.

Wikipedia says
> In computer programming, the strategy pattern (also known as the policy pattern) is a behavioural software design pattern that enables an algorithm's behavior to be selected at runtime.

**Programmatic example**

Translating our example from above. First of all we have our strategy interface and different strategy implementations

```php
interface SortStrategy
{
    public function sort(array $dataset): array;
}

class BubbleSortStrategy implements SortStrategy
{
    public function sort(array $dataset): array
    {
        echo "Sorting using bubble sort";

        // Do sorting
        return $dataset;
    }
}

class QuickSortStrategy implements SortStrategy
{
    public function sort(array $dataset): array
    {
        echo "Sorting using quick sort";

        // Do sorting
        return $dataset;
    }
}
```

And then we have our client that is going to use any strategy
```php
class Sorter
{
    protected $sorter;

    public function __construct(SortStrategy $sorter)
    {
        $this->sorter = $sorter;
    }

    public function sort(array $dataset): array
    {
        return $this->sorter->sort($dataset);
    }
}
```
And it can be used as
```php
$dataset = [1, 5, 4, 3, 2, 8];

$sorter = new Sorter(new BubbleSortStrategy());
$sorter->sort($dataset); // Output : Sorting using bubble sort

$sorter = new Sorter(new QuickSortStrategy());
$sorter->sort($dataset); // Output : Sorting using quick sort
```

💢 State
-----
Real world example
> Imagine you are using some drawing application, you choose the paint brush to draw. Now the brush changes its behavior based on the selected color i.e. if you have chosen red color it will draw in red, if blue then it will be in blue etc.  

In plain words
> It lets you change the behavior of a class when the state changes.

Wikipedia says
> The state pattern is a behavioral software design pattern that implements a state machine in an object-oriented way. With the state pattern, a state machine is implemented by implementing each individual state as a derived class of the state pattern interface, and implementing state transitions by invoking methods defined by the pattern's superclass.
> The state pattern can be interpreted as a strategy pattern which is able to switch the current strategy through invocations of methods defined in the pattern's interface.

**Programmatic example**

Let's take an example of text editor, it lets you change the state of text that is typed i.e. if you have selected bold, it starts writing in bold, if italic then in italics etc.

First of all we have our state interface and some state implementations

```php
interface WritingState
{
    public function write(string $words);
}

class UpperCase implements WritingState
{
    public function write(string $words)
    {
        echo strtoupper($words);
    }
}

class LowerCase implements WritingState
{
    public function write(string $words)
    {
        echo strtolower($words);
    }
}

class DefaultText implements WritingState
{
    public function write(string $words)
    {
        echo $words;
    }
}
```
Then we have our editor
```php
class TextEditor
{
    protected $state;

    public function __construct(WritingState $state)
    {
        $this->state = $state;
    }

    public function setState(WritingState $state)
    {
        $this->state = $state;
    }

    public function type(string $words)
    {
        $this->state->write($words);
    }
}
```
And then it can be used as
```php
$editor = new TextEditor(new DefaultText());

$editor->type('First line');

$editor->setState(new UpperCase());

$editor->type('Second line');
$editor->type('Third line');

$editor->setState(new LowerCase());

$editor->type('Fourth line');
$editor->type('Fifth line');

// Output:
// First line
// SECOND LINE
// THIRD LINE
// fourth line
// fifth line
```

📒 Template Method
---------------

Real world example
> Suppose we are getting some house built. The steps for building might look like
> - Prepare the base of house
> - Build the walls
> - Add roof
> - Add other floors

> The order of these steps could never be changed i.e. you can't build the roof before building the walls etc but each of the steps could be modified for example walls can be made of wood or polyester or stone.

In plain words
> Template method defines the skeleton of how a certain algorithm could be performed, but defers the implementation of those steps to the children classes.

Wikipedia says
> In software engineering, the template method pattern is a behavioral design pattern that defines the program skeleton of an algorithm in an operation, deferring some steps to subclasses. It lets one redefine certain steps of an algorithm without changing the algorithm's structure.

**Programmatic Example**

Imagine we have a build tool that helps us test, lint, build, generate build reports (i.e. code coverage reports, linting report etc) and deploy our app on the test server.

First of all we have our base class that specifies the skeleton for the build algorithm
```php
abstract class Builder
{

    // Template method
    final public function build()
    {
        $this->test();
        $this->lint();
        $this->assemble();
        $this->deploy();
    }

    abstract public function test();
    abstract public function lint();
    abstract public function assemble();
    abstract public function deploy();
}
```

Then we can have our implementations

```php
class AndroidBuilder extends Builder
{
    public function test()
    {
        echo 'Running android tests';
    }

    public function lint()
    {
        echo 'Linting the android code';
    }

    public function assemble()
    {
        echo 'Assembling the android build';
    }

    public function deploy()
    {
        echo 'Deploying android build to server';
    }
}

class IosBuilder extends Builder
{
    public function test()
    {
        echo 'Running ios tests';
    }

    public function lint()
    {
        echo 'Linting the ios code';
    }

    public function assemble()
    {
        echo 'Assembling the ios build';
    }

    public function deploy()
    {
        echo 'Deploying ios build to server';
    }
}
```
And then it can be used as

```php
$androidBuilder = new AndroidBuilder();
$androidBuilder->build();

// Output:
// Running android tests
// Linting the android code
// Assembling the android build
// Deploying android build to server

$iosBuilder = new IosBuilder();
$iosBuilder->build();

// Output:
// Running ios tests
// Linting the ios code
// Assembling the ios build
// Deploying ios build to server
```

## 🚦 Wrap Up Folks

And that about wraps it up. I will continue to improve this, so you might want to watch/star this repository to revisit. Also, I have plans on writing the same about the architectural patterns, stay tuned for it.

## 👬 Contribution

- Report issues
- Open pull request with improvements
- Spread the word
- Reach out with any feedback [![Twitter URL](https://img.shields.io/twitter/url/https/twitter.com/kamranahmedse.svg?style=social&label=Follow%20%40kamranahmedse)](https://twitter.com/kamranahmedse)

## Sponsored By

- [Highig - Think and its done](http://highig.com/)

## License

[![License: CC BY 4.0](https://img.shields.io/badge/License-CC%20BY%204.0-lightgrey.svg)](https://creativecommons.org/licenses/by/4.0/)
