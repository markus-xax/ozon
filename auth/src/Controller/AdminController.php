<?php

namespace App\Controller;

use App\Entity\Token;
use App\Entity\User;
use App\Helper\Status\UserStatus;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    #[Route("/admin", name: 'admin', methods: ["GET"])]
    public function admin()
    {

        return $this->render('admin/admin.html.twig', [
            "users" => $this->entityManager->getRepository(User::class)->findAll()
        ]);
    }

    #[Route("/admin", name: 'admin_post', methods: ["POST"])]
    public function adminPost(Request $request)
    {
        $name = $request->request->get("name");
        $password =$request->request->get("password");
        $date = $request->request->get("dateExpired");
        $error = null;
        if($name && $password && $date){
            if(!$this->entityManager->getRepository(User::class)->findOneBy(['username' => $name])){
                $user = (new User());
                $user->setPassword($this->hasher->hashPassword($user ,$password))
                    ->setStatus(UserStatus::ACTIVE)
                    ->setUsername($name)
                    ->setDateExpired($date == 'always'?
                        ((new \DateTime())->modify("+ 10 year")):
                        ((new \DateTime())->modify("+ $date day"))
                    );
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }else{
                $error = true;
            }
        }else{
            $error = true;
        }
        return $this->render("admin/admin.html.twig", [
            "error" => $error,
            "users" => $this->entityManager->getRepository(User::class)->findAll()
        ]);
    }
    #[Route("/admin/token", name: 'admin_token', methods: ["GET"])]
    public function token(Request $request)
    {
        $context = ['tokens'  => $this->getTokens()];
        return $this->render('admin/adminToken.html.twig', $context);
    }
    #[Route("/admin/token", name: 'admin_token_post', methods: ["POST"])]
    public function setToken(Request $request)
    {
        $context = ['token' => $request->request->all()['token']];
        if(count($this->entityManager->getRepository(Token::class)->findBy(array('token' => $context['token']))) > 0)
        {
            $context['tokens'] = $this->getTokens();
            $context['error'] = "Такой токен уже есть в базе!";
            return $this->render('admin/adminToken.html.twig', $context);
        }
        if(strlen($context['token'])<30){
             $context['tokens'] = $this->getTokens();
            $context['error'] = "Токен слишком короткий";
            return $this->render('admin/adminToken.html.twig', $context);
        }
        try {
            $jresp = (new Client())->request("GET", $this->mpStatsApi.'user/info', [
                'headers' => ['X-Mpstats-TOKEN' => $context['token'] ]
                    ])->getBody()->getContents();
        }catch (\Exception $exception){
            if($exception->getCode() == Response::HTTP_UNAUTHORIZED){
                $context['error'] = $exception->getCode() . " - Не валидный токен";        
            }else{
                $context['error'] = $exception->getCode() . " - Неизвестная ошибка, попробуйте позже"; 
            }
             $context['tokens'] = $this->getTokens();
            return $this->render('admin/adminToken.html.twig', $context);
        }
        $resp = json_decode($jresp);
            //$this->entityManager->getRepository(Token::class)->removeAll();
        $this->entityManager->persist(
            (new Token())
                ->setToken($context['token'])
                ->setCurrentCount($resp->report->use)
                ->setMaxCount($resp->report->available)
                ->setExpires(new \DateTime('@'.(strtotime(explode(',', $resp->user->expires)[0]))))
        );
        $this->entityManager->flush();
        //shell_exec("../bin/console category:load > /dev/null &");

        $context['token'] ="";
        $context = ['tokens'  => $this->getTokens()];
        return $this->render('admin/adminToken.html.twig', $context);
    }
    #[Route("/admin/removetoken", name: 'removetoken', methods: ["GET"])]
    public function removeToken(Request $request)
    {
        $token =  $this->entityManager->getRepository(Token::class)->find($request->query->get('id'));
        if(isset($token))
        {
             $this->entityManager->getRepository(Token::class)->remove($token);
        }
        return $this->redirectToRoute('admin_token');
        
    }
    private function getTokens() {
        $tokens = $this->entityManager->getRepository(Token::class)->findAll();
        $resultTokens = [];
        
        foreach($tokens as $token)
        {
            $tok = ['token' => $token, 'error' => '', 'active' => 'Не активен', 'tariff' => '' ]; 
            try {
                $jresp = (new Client())->request("GET", $this->mpStatsApi.'user/info', [
                    'headers' => ['X-Mpstats-TOKEN' => $token?->getToken() ]
                ])->getBody()->getContents();
                
                
            }catch (\Exception $exception){
                if($exception->getCode() == Response::HTTP_TOO_MANY_REQUESTS){
                    $tok['error'] = $exception->getCode() . " - Что-то произошло не так, попробуйте позже (Слишком много запросов)"; 
                    
                }else if($exception->getCode() == Response::HTTP_UNAUTHORIZED){
                    $tok['error'] = $exception->getCode() . " - Не валидный токен"; 
                }else{
                    $tok['error'] = $exception->getCode() . " - Неизвестная ошибка, попробуйте позже"; 
                }
            }
            $resp = json_decode($jresp);
            if(empty($tok['error']))
            {
                $token->setCurrentCount($resp->report->use);
                $token->setMaxCount($resp->report->available);
                $token->setExpires(new \DateTime('@'.(strtotime(explode(',', $resp->user->expires)[0]))));
                $tok['tariff'] = $resp->user->tariff;
                if($token->getExpires() > new \DateTime())
                {
                    $tok['active'] = "Активен";
                }
            }
            if(empty($tok['error']) && $token->getCurrentCount() >= $token->getMaxCount())
            {
                $tok['error'] = "Запросы на сегодня исчерпаны!"; 
            }
            else if(empty($tok['error']) && $token->getExpires() <= new \DateTime())
            {
                $tok['error'] = "Токен истек!"; 
            }
            
            //print_r(json_decode($resp)->available);
           //     print_r(json_decode($resp)->use);
            //    break;
            $resultTokens[] = $tok;
        }
        $this->entityManager->flush();
        return $resultTokens;
    }
}