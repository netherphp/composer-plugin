# Nether Composer Plugin

This plugin adds a few features to Composer via its plugin system.



## New Features

### Update Warning / Block

If `update-warning.txt` exists in your project root, and is not empty, any attempts to run `composer update` will fail with the message in that text file.

```cli
bob@mcp:/opt/web-dev git:master $ composer update

[Exception]
bruh you aint ready for this
```

Perhaps today you know that there is an update upstream that will break your project because it is a work in progress and its not worth trying to do any sort of insane version constraint workaround, and you will not remember this a month from now. Or maybe you keep typing `composer update` on production like an idiot instead of `composer install`.

You can just create `update-warning.txt` in your project root with any text editor you want. Additionally there is a new Composer command for doing it.

* `composer set-update-warning "bruh you aint ready for this"`

To allow updating again simply empty the file, delete the file, or use `set-update-warning` with no message and Composer will delete it for you.



## Install

`composer require netherphp/composer-plugin`

