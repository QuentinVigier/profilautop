<?php

namespace App\DataFixtures;

use App\Entity\LinkedInMessage;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LinkedInMessageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $users = $manager->getRepository(User::class)->findAll();

        foreach ($users as $user) {
            $userJobOffers = $user->getJobOffers()->toArray();

            if (empty($userJobOffers)) {
                continue; // Skip users without job offers
            }

            $numberOfMessages = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $numberOfMessages; $i++) {
                $jobOffer = $faker->randomElement($userJobOffers);

                $linkedInMessage = new LinkedInMessage();
                $linkedInMessage->setContent($this->generateLinkedInMessageContent($faker));
                $linkedInMessage->setJobOffer($jobOffer);
                $linkedInMessage->setAppUser($user);

                $manager->persist($linkedInMessage);
            }
        }

        $manager->flush();
    }

    private function generateLinkedInMessageContent($faker): string
    {
        return "Bonjour,\n\n" .
            $faker->sentence(10, true) . "\n\n" .
            $faker->sentence(15, true) . "\n\n" .
            "Cordialement,\n" .
            $faker->name();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            JobOfferFixtures::class,
        ];
    }
}
