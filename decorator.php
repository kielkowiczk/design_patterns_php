<?php 
class Foo {
	private $file;
	private $buffer;

	public function __construct($file) {
		$this -> file = $file;
		$this -> buffer = "";
	}

	public function add_to_buffer($str) {
		$this -> buffer = $this -> buffer.$str."\n";
	}

	public function print_buffer() {
		print $this -> buffer;
	}
}

class FooDecorator {
	protected $foo;

	public function __construct($foo) {
		$this -> foo = $foo;
	}

	public function add_to_buffer($str) {
		$this -> foo -> add_to_buffer($str);
	}

	public function print_buffer() {
		$this -> foo -> print_buffer();
	}
}

class DotFoo extends FooDecorator {
	public function __construct($foo) {
		parent::__construct($foo);
	}

	public function add_to_buffer($str) {
		$this -> foo -> add_to_buffer($str.".");
	}
}

class QuestionFoo extends FooDecorator {
	function __construct($foo) {
		parent::__construct($foo);
	}

	public function add_to_buffer($str) {
		$this -> foo -> add_to_buffer($str.'?');
	}
}

$foo = new QuestionFoo(new DotFoo(new Foo('file.txt')));
$foo -> add_to_buffer("sample text");
$foo -> print_buffer();
?>
