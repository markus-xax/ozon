<?php

namespace App\Controller;

use App\Helper\Status\UserStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function __construct(
        protected UserPasswordHasherInterface $hasher,
        protected EntityManagerInterface $entityManager,
        protected $mpStatsApi,
        protected $mpStatsApiOz,
        protected $mpStatsApiWb
    )
    {
    }

    public function checkStatusUser()
    {
        $client = $this->getUser();
        if(!in_array('ROLE_ADMIN', $client->getRoles())) {
            if($client->getDateExpired() < new \DateTime()){
                $client->setStatus($client->getStatus() == UserStatus::DEMO ? UserStatus::ARCHIVE: UserStatus::BLOCK);
                $this->entityManager->flush();
            }
        }
        if($client->getStatus() > UserStatus::DEMO){
            return $this->redirectToRoute('app_login');
        }
        if($_SERVER['REMOTE_ADDR'] != $client->getAllowIpAddress()){
            return $this->redirectToRoute('app_login');
        }
        return null;
    }
    
     public function checkStatusUserApi()
    {
        if(!$this->getUser())
        {
            return ["status" => 403, "error" => "Access denied!"];
        }
        $client = $this->getUser();
        if(!in_array('ROLE_ADMIN', $client->getRoles())) {
            if($client->getDateExpired() < new \DateTime()){
                $client->setStatus($client->getStatus() == UserStatus::DEMO ? UserStatus::ARCHIVE: UserStatus::BLOCK);
                $this->entityManager->flush();
            }
        }
        if($client->getStatus() > UserStatus::DEMO || $_SERVER['REMOTE_ADDR'] != $client->getAllowIpAddress()){
            return ["status" => 403, "error" => "Access denied!"];
        }
        return null;
    }

}