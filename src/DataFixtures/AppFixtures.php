<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Back\User;

use App\Entity\Back\Patient;
use Doctrine\DBAL\Connection;
use App\Entity\Back\Pratictioner;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#[\Doctrine\Bundle\FixturesBundle\Fixture]
class AppFixtures extends Fixture
{
    const NB_USER = 10;
    const NB_PATIENT = self::NB_USER;
     /**
     * UserPasswordHasherInterface is the interface for the password encoder service.
     *
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;

    /**
     * Connection service for MySQL
     *
     * @var Connection
     */
    private $connection;

    /**
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param Connection $connection
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher, Connection $connection)
    {
        $this->passwordHasher = $passwordHasher;
        $this->connection = $connection;
    }

      /**
     * reset to zero of ID
     *
     * @return void
     */
    private function truncate()
    {
        // Disabling foreign_key constraints

        $this->connection->beginTransaction();
        try {
            // Disabling foreign_key constraints
            $this->connection->executeStatement('SET foreign_key_checks = 0');
           
            $test = $this->connection->executeStatement('TRUNCATE TABLE user');
            // $this->connection->executeStatement('DELETE TABLE patient');
    
            // Valider la transaction
            $this->connection->commit();
             // Ajouter des déclarations de débogage
       
        dump("Rows deleted from user table: $test");
        } catch (\Exception $e) {
            // En cas d'erreur, annuler la transaction
            $this->connection->rollBack();
    
            // Vous pouvez également loguer l'erreur ou la traiter d'une autre manière
            throw $e;
        }
    }

    public function load(ObjectManager $manager)
    {

        // $this->truncate();

        $faker = Factory::create('fr_FR');

        //? ADMIN
        $adminManager = new User();
        $adminManager->setEmail('admin@admin.com');
        $adminManager->setRoles(['ROLE_ADMIN']);
        $encodedPassword = $this->passwordHasher->hashPassword($adminManager, 'admin');
        $adminManager->setPassword($encodedPassword);
        $manager->persist($adminManager);



        //Praticien

        $pratictioner = new  Pratictioner();
        $pratictioner->setFirstName($faker->firstName());
        $pratictioner->setLastName($faker->lastName());
        $pratictioner->setPhone($faker->e164PhoneNumber());
        $pratictioner->setAddress($faker->streetAddress());
        $pratictioner->setCity($faker->city());
        $pratictioner->setZipCode($faker->postcode());
        $pratictioner->setSubject('Kiné');
        $pratictioner->setUser($adminManager);
        $manager->persist($pratictioner);


        //Users
        $tabUserList = [];
        for ($i = 1; $i <= self::NB_USER; $i++) {

            $user = new User();

            // unique() allows the field to be unique
            // @see https://fakerphp.github.io/#modifiers
            $user->setEmail($faker->unique()->email());
            $user->setRoles(['ROLE_USER']);
            $encodedPassword = $this->passwordHasher->hashPassword($user, 'user');
            $user->setPassword($encodedPassword);
            $tabUserList[] = $user;

            $manager->persist($user);
        }


        $tabPatientList = [];
        // Patient
        for ($i = 1; $i <= self::NB_PATIENT; $i++) {

            $patient = new Patient();


            $patient->setFirstName($faker->firstName());
            $patient->setLastName($faker->lastName());
            $patient->setGender($faker->title());
            $patient->setPhone($faker->e164PhoneNumber());

            $patient->setAddress($faker->streetAddress());
            $patient->setCity($faker->city());
            $patient->setZipCode($faker->postcode());


            $randomUser = $tabUserList[array_rand($tabUserList)];
            $patient->setUser($randomUser);

            $tabPatientList[] = $patient;

            $manager->persist($patient);

        }

        $manager->flush();

    }
}