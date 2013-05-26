# PhpJasmine #

PhpJasmine is Jasmine-like testing framework for PHP. For now it's in exploring stage. 

The goal of this project is to write tests as easily as in Jasmine.

## Code Sample: ##

```php
<?php
describe('PhpJasmine', function () {
    it('should be easy to write PHP tests', function () {
        expect('writing PHP tests')->not->toBe('difficult');
    });
});
```

Copyright (c) 2013 Jan Voracek. This software is licensed under the MIT License.