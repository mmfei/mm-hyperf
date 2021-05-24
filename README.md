# 一个基于hyperf的脚手架

* language支持 [https://hyperf.wiki/2.0/#/zh-cn/translation](https://hyperf.wiki/2.0/#/zh-cn/translation)
* auth支持 [https://github.com/96qbhy/hyperf-auth](https://github.com/96qbhy/hyperf-auth)
* 统一json的api

```php
class AController extends NeedLoginController {
    public function test() {
        throw new \App\Exception\Handler\MyHttpApiException('test1',999);
    }
}
```

# 输出
```json

```
