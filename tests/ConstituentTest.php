<?php

use PHPUnit\Framework\TestCase;
use Metrique\Constituent\Constituent;

class ConstituentTest extends TestCase
{
    public $expressionParams;
    public $faker;

    public function __construct()
    {
        parent::__construct();

        $this->faker = Faker\Factory::create();
        $this->expressionParams = $this->expressionParamsFactory();
    }
    
    public function test_prepared_expression()
    {
        foreach ($this->expressionParams as $expression) {
            $expression = Constituent::prepare($this->faker->word(), $expression);

            $this->assertArrayHasKey('constituent', $expression);
            $this->assertArrayHasKey('params', $expression);
            $this->assertArrayHasKey('attributes', $expression['params']);
            $this->assertArrayHasKey('class', $expression['params']);

            $this->assertInternalType('string', $expression['constituent']);
            $this->assertInternalType('array', $expression['params']);
            $this->assertInternalType('array', $expression['params']['attributes']);
            $this->assertInternalType('array', $expression['params']['class']);
        }
    }

    public function test_classes_merge_and_implode()
    {
        $constituent = new Constituent();
        $classPrevious = [];

        foreach ($this->expressionParams as $key => $expression) {
            $expression = Constituent::prepare($this->faker->word(), $expression);

            if (array_key_exists('class', $expression['params'])) {

                // Test imploded results too.
                $implode = $key % 2 ? true : false;

                $class = $expression['params']['class'];

                $classMerge = $constituent->class($classPrevious, $class, $implode);
                $classPrevious = $class;

                if ($implode) {
                    $this->assertInternalType('string', $classMerge);
                }

                if (!$implode) {
                    $this->assertInternalType('array', $classMerge);
                    $this->assertContainsOnly('string', $classMerge);
                }
            }
        }
    }

    private function expressionParamsFactory()
    {
        $expressionParams = [];

        for ($i = 0; $i < rand(5, 10); $i++) {
            $class = [];

            for ($j = 0; $j < rand(0, 10); $j++) {
                $class[] = $this->faker->word();
            }

            array_push($expressionParams, [
                'class' => $class
            ]);
        }
        
        for ($i = 0; $i < rand(5, 10); $i++) {
            $class = [];

            for ($j = 0; $j < rand(0, 10); $j++) {
                $class[$this->faker->word()] = (bool) rand(0, 1);
            }

            array_push($expressionParams, [
                'class' => $class
            ]);
        }
        
        for ($i = 0; $i < rand(5, 10); $i++) {
            $attributes = [];

            for ($j = 0; $j < rand(0, 10); $j++) {
                $attributes[] = [$this->faker->word() => $this->faker->word()];
            }

            array_push($expressionParams, [
                'attributes' => $attributes
            ]);
        }

        // Blank param
        array_push($expressionParams, []);

        return $expressionParams;
    }
}
