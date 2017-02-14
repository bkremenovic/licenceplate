# Installation
### Install dependencies:
```
sudo apt-get update && sudo apt-get install -y openalpr openalpr-daemon openalpr-utils libopenalpr-dev tesseract-ocr
```

### Include a package into your project using composer:
```
composer require bkremenovic/licenceplate dev-master
```

### Open your config/app.php and add the following to the providers array:
```
Bkremenovic\Licenceplate\LicenceplateServiceProvider::class,
```

### In the same config/app.php and add the following to the aliases array: 
```'
Licenceplate' => Bkremenovic\Licenceplate\Facades\Licenceplate::class,
```

# Usage
Use ```recognize()``` method using an image as a parameter (either remote or local).
If the licence plate has been successfully recognized, it will return a string containing your licence plate. Otherwise, it will return null.

```
Licenceplate::recognize("licence.jpg")``` or ```Licenceplate::recognize("http://example.com/licence.jpg")
```
