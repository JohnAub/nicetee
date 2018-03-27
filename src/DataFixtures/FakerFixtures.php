<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jonathan-Windows-fix
 * Date: 19/03/2018
 * Time: 15:26
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FakerFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        // sert a generer des entitées https://github.com/fzaninotto/Faker#formatters
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setUsername($faker->userName);
            $user->setNom($faker->name);
            if ($i%2 == 0 ){
                $user->setPrenom($faker->firstNameFemale);
                $user->setSex('femme');
            }else{
                $user->setPrenom($faker->firstNameMale);
                $user->setSex('homme');
            }
            $user->setPhoneNumber($faker->randomNumber());
            $user->setAdresse($faker->streetAddress);
            $user->setCodePostal($faker->numberBetween($min = 1000, $max = 9000));
            $user->setVille($faker->city);
            $user->setPays("France");
            $user->setPlainPassword($faker->password);
            $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $manager->persist($user);
        }
        $manager->flush();
    }
}