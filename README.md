# Simple PHP environment switch

I've been thinking how to solve the problem of deploy code to different environments. Now I've made a switch.

## Prerequisite

You must have a file in your deploying directory, in which the name of the environment is written. By default, the file 
 locates in your `DOCUMENT_ROOT` directory and is named `env`, which is defined in your web server's configuration and can be override by
 passing a path to the constructor of `\Spe\Env` as the 1st parameter.
 
 By default, there are 4 environments, which are `dev`, `test`, `emu`, and `prod`. You can override the setting by passing
  an array to the constructor of `\Spe\Env` as the 2nd parameter.
  
Absolutely you don't have to pass any parameters to the constructor at all, it has proper default settings.

## Usage

1. A container is recommended.

```php
$container['env'] = function ($c) {
    return new \Spe\Env();
};
``` 

2. You can get current env setting at any time by calling `\Spe\Env::get()`.

3. Thanks to the container, you can set a temporary env setting wherever you want because you access the instance of `\Spe\Env`
as a singleton with a container.

## Contribution

PR are welcome to improve this project.

## Donation

1. WeChat  
    ![](http://ww3.sinaimg.cn/small/006y8mN6jw1fafuqzir1ej30g20mr76a.jpg)
2. Alipay  
    ![](http://ww1.sinaimg.cn/small/006y8mN6jw1fafurfgkg0j30gn0ml76m.jpg)
