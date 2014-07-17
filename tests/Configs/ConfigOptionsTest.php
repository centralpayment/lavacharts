<?php namespace Khill\Lavacharts\Tests\Configs;

use Khill\Lavacharts\Configs\ConfigOptions;
use Khill\Lavacharts\Configs\TextStyle;

class ConfigOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testTextStyleConstructorValuesAssignment()
    {
        $textStyle = new TextStyle(array(
            'color'    => 'blue',
            'fontName' => 'Arial',
            'fontSize' => 16
        ));

        $this->assertEquals('blue',  $textStyle->color);
        $this->assertEquals('Arial', $textStyle->fontName);
        $this->assertEquals(16,      $textStyle->fontSize);
    }

    /**
     * @expectedException Khill\Lavacharts\Exceptions\InvalidConfigValue
     */
    public function testConstructorWithBadParam()
    {
        $co = new ConfigOptions(4.25);
    }

    /**
     * @depends testTextStyleConstructorValuesAssignment
     */
    public function testToArrayWithTextStyleConfigObject()
    {
        $textStyle = new TextStyle(array(
            'color'    => 'blue',
            'fontName' => 'Arial',
            'fontSize' => 16
        ));

        $textStyleArr = $textStyle->toArray();

        $this->assertTrue(is_array($textStyleArr));
        $this->assertEquals('TextStyle', array_keys($textStyleArr)[0]);
        $this->assertTrue(is_array($textStyleArr['TextStyle']));

        $this->assertEquals('blue',  $textStyleArr['TextStyle']['color']);
        $this->assertEquals('Arial', $textStyleArr['TextStyle']['fontName']);
        $this->assertEquals(16,      $textStyleArr['TextStyle']['fontSize']);
    }
}