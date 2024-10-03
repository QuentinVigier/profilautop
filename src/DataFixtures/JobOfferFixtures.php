<?php

namespace App\DataFixtures;

use App\Entity\JobOffer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class JobOfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $statusOptions = ['À postuler', 'En attente', 'Entretien', 'Refusé', 'Accepté'];

        // Créer des offres d'emploi pour chaque utilisateur
        for ($i = 0; $i < 10; $i++) {
            $user = $this->getReference('user_' . $i);

            // Créer 3 à 8 offres d'emploi pour chaque utilisateur
            $numOffers = $faker->numberBetween(3, 8);
            for ($j = 0; $j < $numOffers; $j++) {
                $jobOffer = new JobOffer();
                $jobOffer->setTitle($faker->jobTitle);
                $jobOffer->setCompany($faker->company);
                $jobOffer->setLink($faker->optional(0.8)->url);
                $jobOffer->setLocation($faker->optional(0.9)->city);
                $jobOffer->setSalary($faker->optional(0.7)->numberBetween(30000, 150000) . '€');
                $jobOffer->setContactPerson($faker->optional(0.6)->name);
                $jobOffer->setContactEmail($faker->optional(0.6)->companyEmail);
                $jobOffer->setApplicationDate($faker->dateTimeBetween('-6 months', 'now'));
                $jobOffer->setStatus($faker->randomElement($statusOptions));
                $jobOffer->setAppUser($user);

                $manager->persist($jobOffer);

                // Ajouter une référence pour une utilisation ultérieure si nécessaire
                $this->addReference('job_offer_' . $i . '_' . $j, $jobOffer);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}