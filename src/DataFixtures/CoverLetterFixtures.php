<?php

namespace App\DataFixtures;

use App\Entity\CoverLetter;
use App\Entity\JobOffer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CoverLetterFixtures extends Fixture implements DependentFixtureInterface
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

            $numberOfCoverLetters = $faker->numberBetween(1, 2);

            for ($i = 0; $i < $numberOfCoverLetters; $i++) {
                $jobOffer = $faker->randomElement($userJobOffers);

                $coverLetter = new CoverLetter();
                $coverLetter->setContent($this->generateCoverLetterContent($faker));
                $coverLetter->setJobOffer($jobOffer);
                $coverLetter->setAppUser($user);

                $manager->persist($coverLetter);
            }
        }

        $manager->flush();
    }

    private function generateCoverLetterContent($faker): string
    {
        return "Madame, Monsieur,\n\n" .
            $faker->paragraph() . "\n\n" .
            $faker->paragraph() . "\n\n" .
            $faker->paragraph() . "\n\n" .
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
