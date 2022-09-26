<?php

namespace App\Service;

use App\Entity\ApiToken;
use App\Entity\Token;
use App\Repository\ApiTokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractService
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected SerializerInterface $serializer,
        protected UserPasswordHasherInterface $hasher,
        protected ApiTokenRepository $apiTokenRepository,
        protected $mpStatsApi,
        protected $mpStatsApiWb,
        protected $mpStatsApiOz,
        protected $maxMonitoringWords
    )
    {
    }

    protected function checkWbData($tokens)
    {
        $haveToken = false;
        foreach ($tokens as $token){
            /** @var ApiToken $token */
            if($token->getWbData()){
                $haveToken = true;
            }
        }
        return $haveToken;
    }

    protected function getTokenFromQuery($query)
    {
        if ($query['ids'] ?? null) {
            $tokenQuery = explode(',', $query['ids']);
        }
        return $tokenQuery??null;
    }

    protected function checkStatusToken($id, $query = [])
    {
        $tokens = $this->entityManager
            ->getRepository(ApiToken::class)
            ->getTokenWithUser($id, true);

        $token = !key_exists('index', $query) ? ($tokens[0] ?? null) : $tokens[$query['index']];
        return $token ?
            ['wbData' => $token->getWbData(), 'token' => $token, 'tokens' => $tokens] :
            ['wbData' => null, 'token' => null];
    }

    public function getHeaders()
    {
        $token = $this->entityManager->getRepository(Token::class)->findLessUsed();
        if(isset($token)){
            $this->entityManager->detach($token);
        }
        return $token?['headers' => ['X-Mpstats-TOKEN' => $token->getToken()]]:false;
    }

    public function getHeadersWithBody($array)
    {
        return array_merge($this->getHeaders(), ['json' => $array]);
    }

    public function getDate(\DateTime $d2, \DateTime $d1=null, $format='Y-m-d')
    {
        return http_build_query($d1? [
                'd1' => $d1->format($format),
                'd2' => $d2->format($format)
            ] : [
                'd' => $d2->format($format)
            ]
        );
    }
}