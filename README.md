# Nether Composer Plugin

Add features to Composer via a plugin.



# New Features

## Update Warning / Block

If **composer-update-warning.txt** exists in the project along side the **composer.json** file then any attempts to run `composer update` will fail, citing the contents of that text file.

	bob@mcp:/opt/web-prod git:master $ composer update

	[Exception]
	Why are you doing this on production?
	Use `composer install` instead.

Handy because maybe you know of an incoming incompability that the version constraints are not going to juggle and you just not prepared to deal with it. Or maybe you keep typing `composer update` on production like an idiot instead of `composer install`.

You can just create **composer-update-warning.txt** in your project root with any text editor you want. Additionally there is a new Composer command for doing it.

	composer set-update-warning "bruh you aint ready for this"

To allow updating again simply empty the file, delete the file, or use `composer set-update-warning` with no message and Composer will delete it for you. It is just a boring text file that way anyone who wants to see why there is an update warning without actually trying can also be informed.

Note, when using `set-update-warning` the quotes are totes required.



# Install

`composer require netherphp/composer-plugin`

