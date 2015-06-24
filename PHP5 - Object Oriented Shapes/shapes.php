<?php 


//Shape Related Class Definitions... 


abstract class Shape
{
	const Color = "Blue";	

	public $name = "";

	public function Identify()
	{
		return "This is Shape " . $this->name;
	}

	abstract public function Area();
	abstract public function Perimeter();	
}

class Circle extends Shape
{
	public $radius = 0;

	
	public function __construct($radius)
	{
		$this->radius = $radius;
	}

	public function Identify()
	{
		return parent::Identify() . ", and I'm a Circle!";
	}

	public function Area()
	{
		return round(( M_PI * pow($this->radius, 2) ), 2);
	}
	public function Perimeter()
	{
		return round(( 2 * M_PI * $this->radius ), 2);
	}
}

class Rectangle extends Shape
{
	public $length = 0;
	public $width = 0;

	public function __construct($length, $width)
	{
		$this->length = $length;
		$this->width = $width;
	}

	public function Identify()
	{
		return parent::Identify() . ", and I'm a Rectangle!";
	}

	public function Area()
	{
		return round(($this->length * $this->width), 2);
	}
	public function Perimeter()
	{
		return round(( (2*$this->length) + (2*$this->width) ), 2);
	}
}

?>