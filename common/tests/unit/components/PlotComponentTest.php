<?php

namespace common\tests\unit\components;

use Codeception\Test\Unit;
use common\components\plot\exceptions\PlotNotFoundException;
use common\components\plot\models\Plot;
use common\components\plot\PlotComponent;
use yii\data\ArrayDataProvider;

class PlotComponentTest extends Unit
{
    private $component;

    public function _before()
    {
        parent::_before();
        $this->component = new PlotComponent();
    }

    public function testRunWithValidParameters()
    {
        $cadastralNumbers = '69:27:0000022:1306, 69:27:0000022:1307';
        $plots = $this->component->run(explode(',',$cadastralNumbers));
        $this->assertInstanceOf(ArrayDataProvider::class, $plots);
        $this->assertInstanceOf(Plot::class, $plots->allModels[0]);
    }

    public function testRunWithInvalidParameters()
    {
        $cadastralNumbers = '1306, 1307';
        $this->expectException(PlotNotFoundException::class);
        $this->component->run(explode(',',$cadastralNumbers));
    }

    public function testRunWithOneInvalidParameter()
    {
        $cadastralNumbers = '69:27:0000022:1306, 1307';
        $plots = $this->component->run(explode(',',$cadastralNumbers));
        $this->assertInstanceOf(ArrayDataProvider::class, $plots);

        $models = $plots->allModels;
        $this->assertInstanceOf(Plot::class, $models[0]);
        $this->assertEquals(1, count($models));
    }

    public function testRunWithoutParameters()
    {
        $cadastralNumbers = '69:27:0000022:1306, 69:27:0000022:1307';
        $this->component->run(explode(',',$cadastralNumbers));

        $plots = $this->component->run();
        $this->assertInstanceOf(ArrayDataProvider::class, $plots);
    }
}
