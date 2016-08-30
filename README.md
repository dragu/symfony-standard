How to reproduce the bug
========================

Just  run `composer install` and `ant`

--------------


But how you know *FormTypeCsrfExtension* is overwriting your extension config?
========================

Go to *vendor/symfony/symfony/src/Symfony/Component/Form/Extension/Csrf/Type/FormTypeCsrfExtension.php* and comment `'csrf_protection' => $this->defaultEnabled,` and run `ant` again
