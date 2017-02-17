<?php
namespace Bkremenovic\Licenceplate;

use Bkremenovic\Licenceplate\Exceptions\NotInstalledException;
use Bkremenovic\Licenceplate\Exceptions\NotLinuxException;

use Closure;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class Licenceplate {
	private $country;

    public function __construct() {
    	if(strtoupper(PHP_OS) !== "LINUX") {
    		throw new NotLinuxException("This package requires Linux, but it appears you are not running it !");
    	}

    	if(str_contains(exec("type alpr"), "not found")) {
    		throw new NotInstalledException("Alpr is not installed !");
    	}

    	if(str_contains(exec("type tesseract"), "not found")) {
    		throw new NotInstalledException("Tesseract-ocr is not installed !");
    	}

    	$this->country = config("licenceplate.country", "eu");
    }

    public function country($country) {
    	$this->country = $country;
    }

    public function recognize($image) {
    	$path = tempnam(sys_get_temp_dir(), 'lp_').".jpg";

    	Image::make($image)->save($path);
    	$response = json_decode(exec("alpr ".$path." -c ".$this->country." -n 1 -j"), true);

    	if($response == false) {
    		throw new UnexpectedResponseException("Alpr client responded in unexpected format !");
    	}

    	unlink($path);

    	$ocr = collect($response)->get("results");
        
        if($ocr) {
            return $ocr[0]["plate"];
        } else {
            return null;
        }
    }
}
