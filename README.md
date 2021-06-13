# `yasd/config`

```shell
composer require yasd/config
```

```php
use Nette\Schema\Expect;
use YaSD\Config\AbstractConfig;

class MyConfig extends AbstractConfig
{
    public const MYKEY = 'mykey';

    public function getMyValue(): int
    {
        return $this->get(
            self::MYKEY,
            Expect::int()->required()->castTo('int'),
        );
    }
}
```

```php
$config = new MyConfig(__DIR__ . '/test.config.php');

$ret = $config->reload()->getMyValue();
var_dump($ret);

$ret = $config->reload()->get(MyConfig::MYKEY);
var_dump($ret);
```
