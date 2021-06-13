# `yasd/config`

```shell
composer require yasd/config
```

```php
use Nette\Schema\Expect;
use YaSD\Config\AbstractConfig;
use stdClass;

class MyConfig extends AbstractConfig
{
    public const MYKEY = 'mykey';

    public function getMyValue(): int
    {
        return $this->get(
            self::MYKEY,
            Expect::int(),
        );
    }

    public function getMysql(): stdClass
    {
        return $this->get(
            'mysql',
            Expect::structure([
                'host'     => Expect::string()->required(),
                'port'     => Expect::int()->required(),
                'user'     => Expect::string()->required(),
                'password' => Expect::string()->required(),
                'dbname'   => Expect::string()->required(),
            ])
        );
    }
}
```

```php
$config = new MyConfig(__DIR__ . '/test.config.php');

$ret = $config->reload()->getMyValue();
var_dump($ret);

$ret = $config->getMysql();
var_dump($ret);
```
