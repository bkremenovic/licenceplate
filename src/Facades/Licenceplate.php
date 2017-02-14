<?php
	namespace Bkremenovic\Licenceplate\Facades;

	use Illuminate\Support\Facades\Facade;

	class Licenceplate extends Facade {
	    protected static function getFacadeAccessor() {
	        return 'licenceplate';
	    }
	}
