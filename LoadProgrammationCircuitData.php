<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProgrammationCircuit;

class LoadProgrammationCircuitData extends Fixture implements DependentFixtureInterface {
   
    public function load(ObjectManager $manager) {
        $circuit=$this->getReference('andalousie-circuit');
        
        $programmationCircuits = new ProgrammationCircuit();
        $programmationCircuits->setDateDepart(new \DateTime('2018-08-05'));
        $programmationCircuits->setNombrePersonnes(25);
        $programmationCircuits->setPrix(100);
        $circuit->addProgrammationCircuit($programmationCircuits);
        $manager->persist($programmationCircuits);
        
        $this->setReference('andalousie-circuit', $programmationCircuits);
        $manager->persist($circuit);
        
        $circuit=$this->getReference('idf-circuit');
        
        $programmationCircuits = new ProgrammationCircuit();
        $programmationCircuits->setDateDepart(new \DateTime('2018-12-25'));
        $programmationCircuits->setNombrePersonnes(40);
        $programmationCircuits->setPrix(200);
        $programmationCircuits->setCircuit($circuit);
        $circuit->addProgrammationCircuit($programmationCircuits);
        $manager->persist($programmationCircuits);
        
        $this->setReference('idf-circuit', $programmationCircuits);
        $manager->persist($circuit);
        
        $manager->flush();
    }

    public function getDependencies() { 
        return array(
            LoadCircuitData::class,
        );
    }

    
}