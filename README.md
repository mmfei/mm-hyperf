# 一个基于hyperf的脚手架

* language支持 [https://hyperf.wiki/2.0/#/zh-cn/translation](https://hyperf.wiki/2.0/#/zh-cn/translation)
* auth支持 [https://github.com/96qbhy/hyperf-auth](https://github.com/96qbhy/hyperf-auth)
* 验证器 [https://github.com/hyperf/validation](https://github.com/hyperf/validation)
* 国际化[https://github.com/hyperf/translation](https://github.com/hyperf/translation) 
* 缓存 [https://hyperf.wiki/2.0/#/zh-cn/cache](https://hyperf.wiki/2.0/#/zh-cn/cache)
* 统一json的api

```php
class AController extends NeedLoginController {
    public function test() {
        throw new \App\Exception\Handler\MyHttpApiException('test1',999);
    }
    public function success() {
        return ['a' => 'success',];
    }
}
```

# 输出 my
```json
{
  "code": 999,
  "data": "test1",
  "time": 1621841693
}
```
# 输出 success
```json
{
  "code": 0,
  "data": {
    "a": "success"
  },
  "time": 1621843407
}
```
