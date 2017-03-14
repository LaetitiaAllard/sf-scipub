<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Nelmio\Alice\Fixtures;

/**
 * Class LoadData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadData implements FixtureInterface
{
    /**
     * @var Factory
     */
    private $faker;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $directory = realpath(__DIR__ . '/fixtures');

        $this->faker = Factory::create('fr_FR');

        Fixtures::load([
            $directory.'/science.yml',
            $directory.'/publication.yml'
        ], $manager, [
            'providers' => [$this->faker, $this]
        ]);
    }

    public function html()
    {
        $paragraphs = $this->faker->paragraphs(rand(8,12));

        return '<p>' . implode('</p><p>', $paragraphs) . '</p>';
    }
}
