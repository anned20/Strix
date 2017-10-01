<?php

use anned20\Strix\Container;

use anned20\Strix\Exception\ContainerException;
use anned20\Strix\Exception\NotFoundException;
use anned20\Strix\Exception\AlreadyInContainerException;

/**
 * Class ContainerTest
 * @author Anne Douwe Bouma
 */
class ContainerTest extends PHPUnit_Framework_TestCase
{
	public function testContainer()
	{
		$container = new Container();

		$container->add('config', ['hello' => 'world']);

		$this->assertTrue($container->has('config'));
		$this->assertFalse($container->has('nope'));

		$this->assertEquals(['hello' => 'world'], $container->get('config'));

		$container->delete('config');

		$this->assertFalse($container->has('config'));
	}

	public function testContainerNotFoundException()
	{
		$container = new Container();

		$this->setExpectedException(NotFoundException::class);

		$container->get('nope');
	}

	public function testContainerAlreadyInContainerException()
	{
		$container = new Container();

		$this->setExpectedException(AlreadyInContainerException::class);

		$container->add('nope', 'Hi mom!');
		$container->add('nope', 'Hi again!');
	}
}
