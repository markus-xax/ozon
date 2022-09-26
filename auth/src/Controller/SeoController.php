<?php

namespace App\Controller;

use App\Service\SeoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\KeyWord;
use App\Entity\MonitoringSku;
use App\Entity\MSkuWord;
use PDO;
use Proxies\__CG__\App\Entity\MonitoringProject;
use Symfony\Component\Validator\Constraints\Date;

#[Route("/seo")]
class SeoController extends AbstractController
{
    public function __construct(
        protected SeoService $service,
        protected UserPasswordHasherInterface $hasher,
        protected EntityManagerInterface $entityManager,
    )
    {
        parent::__construct($this->hasher, $this->entityManager, $this->mpStatsApi, $this->mpStatsApiOz, $this->mpStatsApiWb);
    }

    #[Route(path: '/keyword', name: 'keyword')]
    public function keyword(): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/keyword.html.twig');
    }
    #[Route(path: '/keyword/{name}', name: 'keyword_name')]
    public function keywordName(string $name): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        if(strlen($name) == 0 ) return $this->redirectToRoute('keyword');
        return $this->render('seo/keywordName.html.twig',
            $this->service->getKeyword($name)
        );
    }
    #[Route(path: '/keywords/expanding', name: 'keywords_exp')]
    public function keywordsEx(): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/expanding.html.twig');
    }
    #[Route(path: '/keywords/expanding/{identity}', name: 'keywords_exp_identity')]
    public function getKeywordsEx($identity): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/expandingSale.html.twig',
            $this->service->getKeywordIdentity($identity)
        );
    }
    #[Route(path: '/keywords/expanding/keyword/{keyword}', name: 'keywords_exp_keyword')]
    public function getKeywordsExKey($keyword): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/expandingKeyword.html.twig',
            $this->service->getKeywordKey($keyword)
        );
    }
    #[Route(path: '/keywords/expanding/word/{keyword}', name: 'keywords_exp_word')]
    public function getKeywordsExWord($keyword): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/expandingKeyword.html.twig',
            $this->service->getKeywordWord($keyword)
        );
    }
    #[Route(path: '/keywords/selection', name: 'selection')]
    public function selection(Request $request): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/selection.html.twig',
            $this->service->selection($request->query->all())
        );
    }
    #[Route(path: '/position-tracking', name: 'position_tracking')]
    public function positionTracking(): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/position-tracking.twig');
    }
    #[Route(path: '/position-tracking/{sku}', name: 'position_tracking-sale')]
    public function positionTrackingSale($sku, Request $request): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        $sale = $this->service->getPosition($sku);
        if(!$sale){
            return $this->redirectToRoute('position_tracking');
        }
        return $this->render('seo/position-tracking-sale.twig', $sale);
    }
    
      #[Route(path: '/api/position-tracking/userlimits', name: 'api-position_tracking-userlimits', methods: ['GET'])]
      public function positionTrackingLimits(): Response
      {
             $check = $this->checkStatusUserApi();
             if($check) return new JsonResponse($check);
             return new JsonResponse($this->service->getUserMonitoringLimits($this->getUser()->getId()));
      }
      
     #[Route(path: '/api/position-tracking/projectslist', name: 'api-position_tracking-projectslist', methods: ['GET'])]
      public function positionTrackingProjects(): Response
      {
             $check = $this->checkStatusUserApi();
             if($check)return new JsonResponse($check);
             $prjs = $this->entityManager->getRepository(\App\Entity\MonitoringProject::Class)->createQueryBuilder('pr')
                    ->andWhere('pr.Owner = :userid')
                    ->setParameter('userid', $this->getUser()->getId())
                     ->select("pr.id", "pr.Name as name", "pr.skuCount", "pr.wordCount", "pr.d0Total", "pr.d0Top1", "pr.d0Top4", "pr.d0Top12", "pr.d0Top100", "pr.d0AvgPos", "pr.d1Total", "pr.d1Top1", "pr.d1Top4", "pr.d1Top12", "pr.d1Top100", "pr.d1AvgPos", "pr.changeTotal", "pr.changeTop1", "pr.changeTop4", "pr.changeTop12", "pr.changeTop100", "pr.changeAvgPos", "pr.d1FTotal")
                     ->getQuery()->getResult();
             return new JsonResponse($prjs);
      }
      
      #[Route(path: '/api/position-tracking/project', name: 'api-position_tracking-project-post', methods: ['POST'])]
      public function positionTrackingAddProject(Request $request): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          
          
          $params = json_decode($request->getContent(), true);
          $p = new \App\Entity\MonitoringProject();
          $p->setOwner($this->getUser());
          $p->setName($params["name"]);
          $this->entityManager->persist($p);
          $this->entityManager->flush();
          $data = [
              'status' => 201,
           ];
          $data['result'] = $p->minInfo();
          return new JsonResponse($data);
      }
    
      
      #[Route(path: '/api/position-tracking/project/{id}', name: 'api-position_tracking-project-get', methods: ['GET'])]
      public function positionTrackingGetProject($id): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          
          $prj = $this->entityManager->getRepository(\App\Entity\MonitoringProject::Class)->find($id);
          if($prj->getOwner()->getId() != $this->getUser()->getId())
          {
               $data = [
                    'status' => 401,
                    'error' => "Нет прав для просмотра проекта!",
                 ];
                return new JsonResponse($data);
          }
          
          $data = [
              'status' => 200,
           ];
        
          $data['project'] = $prj;
        //  \Doctrine\Common\Util\Debug::dump($prj->getMonitoringSkus()[0]->getMSkuWords()[0]);
          return new Response($this->serializeObjectToJson($prj));
          
      }
      #[Route(path: '/api/position-tracking/project/{id}/skus', name: 'api-position_tracking-project-skus-get', methods: ['GET'])]
      public function positionTrackingGetProjectSkus($id): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          
          $prj = $this->entityManager->getRepository(\App\Entity\MonitoringProject::Class)->find($id);
          if($prj->getOwner()->getId() != $this->getUser()->getId())
          {
               $data = [
                    'status' => 401,
                    'error' => "Нет прав для просмотра проекта!",
                 ];
                return new JsonResponse($data);
          }
          
          $data = [
              'status' => 200,
           ];
        
          $data['project'] = $prj;
        //  \Doctrine\Common\Util\Debug::dump($prj->getMonitoringSkus()[0]->getMSkuWords()[0]);
          return new Response($this->serializeObjectToJson($prj));
          
      }

      #[Route(path: '/api/position-tracking/project/{id}/skudata/{sku}', name: 'api-position_tracking-project-skudatabyid-get', methods: ['GET'])]
      public function positionTrackingGetProjectSkuById($id, $sku): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          
          $skum = $this->entityManager->getRepository(\App\Entity\MonitoringSku::Class)->find($sku);
          if($skum->getProject()->getOwner()->getId() != $this->getUser()->getId())
          {
               $data = [
                    'status' => 401,
                    'error' => "Нет прав для просмотра проекта!",
                 ];
                return new JsonResponse($data);
          }
          
          $data = [
              'status' => 200,
           ];
        
          $data['result'] = $skum;
        //  \Doctrine\Common\Util\Debug::dump($prj->getMonitoringSkus()[0]->getMSkuWords()[0]);
          return new Response($this->serializeObjectToJson($data));
          
      }

      #[Route(path: '/api/position-tracking/project/{id}/skudata', name: 'api-position_tracking-project-skudata-get', methods: ['GET'])]
      public function positionTrackingGetProjectSkuData($id, Request $request): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          
          $prj = $this->entityManager->getRepository(\App\Entity\MonitoringProject::Class)->find($id);
          if($prj->getOwner()->getId() != $this->getUser()->getId())
          {
               $data = [
                    'status' => 401,
                    'error' => "Нет прав для просмотра проекта!",
                 ];
                return new JsonResponse($data);
          }
          $d1 = $request->query->has('d1') ? strtotime($request->query->get('d1')) :  strtotime(date("Y-m-d", strtotime("-20 days")));
          $d2 = $request->query->has('d2') ? strtotime($request->query->get('d2')) :  strtotime(date("Y-m-d"));
          if($d1 >= $d2)
          {
            $d1 = strtotime(date("Y-m-d", strtotime("-20 days")));
            $d2 = strtotime(date("Y-m-d"));
          }
          $dates = [];
          $currdt = $d1;
          $i = 0;
          $maxi = 90;
          while($currdt < $d2 || $i > $maxi)
          {
            $currdt = $currdt + 3600*24;
            $i++;
            $dates[] = date("Y-m-d", $currdt);
          }
          $conn = $this->entityManager->getConnection();
          $sql = "SELECT json_build_object('projectId', p.id,
          'items', (SELECT json_agg(json_build_object('id', s.id, 
                                                      'sku', s.sku,
                                                         'words', (SELECT json_agg(json_build_object(
                                                                  'id', mw.id,
                                                                  'word', kw.word,
                                                                  'count', kw.frequency,
                                                                  'results', kw.results,
                                                                  'positions', (SELECT json_agg(pos.val) FROM (select trim(e) dt, kws.pos val from unnest(string_to_array(:dts, '|')) e left join keyword_skus kws 
                                                                                                               ON kws.word = kw.word AND kws.sku = s.sku AND kws.pdate = cast(e as Date)) pos)
                                                          
                                                              )) FROM msku_word mw INNER JOIN key_word kw ON mw.word_id = kw.word WHERE mw.monitoring_sku_id = s.id
                                                          )
                                                     )) from monitoring_sku s WHERE s.project_id = p.id),
           'periods', (select json_agg(trim(d)) from unnest(string_to_array(:dts, '|')) d )
         ) FROM monitoring_project p WHERE p.id = :project_id";
         $stmt = $conn->prepare($sql);
         $dts = implode('|', $dates);
         $data = $stmt->executeQuery(array('project_id' =>$prj->getId(), 'dts' => $dts));
         return new Response($data->fetchOne());
          
      }
      
      #[Route(path: '/api/skuinfo/{skuid}', name: 'api-skuinfo-g', methods: ['GET'])]
      public function getSkuInfoG($skuid): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          $psku = $this->service->getSku($skuid);
          if(count($psku) < 1)
          {
              $data = [
                    'status' => 404,
                    'error' => "SKU не найден!",
                 ];
                return new JsonResponse($data);
          }
          $data = [
                    'status' => 200,
                 ];
          $data['result'] = $psku['item'];
          $data['result']['image'] = $psku['img'];
          return new JsonResponse($data);
      }
      
    
      #[Route(path: '/api/skuinfo', name: 'api-skuinfo', methods: ['POST'])]
      public function getSkuInfo(Request $request): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          $params = json_decode($request->getContent(), true);
          $psku = $this->service->getSku($params["sku"]);
          if(count($psku) < 1)
          {
              $data = [
                    'status' => 404,
                    'error' => "SKU не найден!",
                 ];
                return new JsonResponse($data);
          }
          $data = [
                    'status' => 200,
                 ];
          $data['result'] = $psku['item'];
          $data['result']['image'] = $psku['img'];
          return new JsonResponse($data);
      }
       #[Route(path: '/api/skuwords/{sku}', name: 'api-sku_wordsG', methods: ['GET'])]
      public function getSkuWordsG($sku): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          $words = $this->service->getSkuKeyWords($sku);
    
          $data = [
                    'status' => 200,
                 ];
          $data['result'] = $words;
          return new JsonResponse($data);
      }
      
       #[Route(path: '/api/skuwords', name: 'api-sku_words', methods: ['POST'])]
      public function getSkuWords(Request $request): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          $params = json_decode($request->getContent(), true);
          $words = $this->service->getSkuKeyWords($params["sku"]);
    
          $data = [
                    'status' => 200,
                 ];
          $data['result'] = $words;
          return new JsonResponse($data);
      }
      
      #[Route(path: '/api/project/{id}/addsku', name: 'api-addprojectsku', methods: ['POST'])]
      public function addProjectSku($id, Request $request): Response
      {
          $check = $this->checkStatusUserApi();
          if($check) return new JsonResponse($check);
          $prj = $this->entityManager->getRepository(\App\Entity\MonitoringProject::Class)->find($id);
          if($prj->getOwner()->getId() != $this->getUser()->getId())
          {
               $data = [
                    'status' => 401,
                    'error' => "Нет прав для просмотра проекта!",
                 ];
                return new JsonResponse($data);
          }
          $params = json_decode($request->getContent(), true);
          $checksku =$this->service->getSku($params["sku"]);
          if(count($checksku) < 1)
          {
              $data = [
                    'status' => 404,
                    'error' => "SKU не найден!",
                 ];
                return new JsonResponse($data);
          }
          $getsku = function($x){
	            return  $x->getSku();
            };
          $skus = array_map($getsku, $prj->getMonitoringSkus()->getValues());
          $msku = $this->entityManager->getRepository(\App\Entity\MonitoringSku::class)->findOneBy(['sku' => $params['sku'], 'project' => $id]);
          if(!$msku)
          {
            $msku = new \App\Entity\MonitoringSku();
            $this->entityManager->persist($msku);
            $msku->setSku($params['sku']);
            $prj->addMonitoringSku($msku);
            $this->entityManager->flush();
            $prj->setSkuCount(count($prj->getMonitoringSkus()));
            $this->entityManager->flush();
          }
         
          
          
          if(isset($params['words']) && count($params['words']) > 0)
          {
            $getword = function($x){
	            return  $x->getWord();
            };
            $existingwords = $this->entityManager->getRepository(KeyWord::Class)->findBy(array('word' => $params['words']));
            $existingwordsarr = array_map($getword, $existingwords);
            $wordsinsku =   array_map($getword, array_map($getword, $msku->getMSkuWords()->toArray()));
            $newWordsa = array_udiff($params['words'], $wordsinsku, 'strcasecmp');
            $limits = $this->service->getUserMonitoringLimits($this->getUser()->getId());
            $maxwords = $limits['available'] - $limits['use'];
            if(count($newWordsa) > $maxwords)
            {
                return new JsonResponse(['status' => 420, 'error' => 'Out of words limit!' ]);
            }
              foreach($newWordsa as $word)
              {
                $mword = new \App\Entity\MSkuWord();
                $wordresult = strtolower($word);
                $wrd = null;
                  if(!in_array($wordresult, $existingwordsarr, true))
                  {
                      $wrd = new KeyWord();
                      $wrd->setWord($wordresult);
                      $wrd->setLastUpdate(\DateTime::createFromFormat("Y-m-d", date("Y-m-d", strtotime("yesterday"))));
                      $wrd->setFrequency(0);
                      $wrd->setResults(0);
                      $this->entityManager->persist($wrd);
                  }
                  else
                  {
                    $wrd = $this->entityManager->getReference(KeyWord::Class, $wordresult);
                  }
                $mword->setWord($wrd);
                $mword->setMonitoringSku($msku);
                $msku->addMSkuWord($mword);
                $this->entityManager->persist($mword);
              }
              
              $this->entityManager->flush();
          }          
          $data = [
                    'status' => 201,
                 ];
          $data['result'] = $prj->getMonitoringSkus();// ["id" => $msku->getId(), "sku" => $msku->getSku()];
          return new Response($this->serializeObjectToJson($data));
      }
      
      #[Route(path: '/api/position-tracking/movesku', name: 'api-movesku', methods: ['POST'])]
      public function moveSku(Request $request): Response
      {
        $check = $this->checkStatusUserApi();
        if($check) return new JsonResponse($check);
        $params = json_decode($request->getContent(), true);
        $sku = $this->entityManager->getRepository(MonitoringSku::Class)->find($params['id']);
        $targetProject = $this->entityManager->getRepository(MonitoringProject::Class)->find($params['project_id']);
        if(!$sku || !$targetProject)
        {
            $data = [
                'status' => 404,
                'error' => "Опс!",
             ];
            return new JsonResponse($data);
        }
        if($sku->getProject()->getOwner()->getId() != $this->getUser()->getId() || $targetProject->getOwner()->getId() != $this->getUser()->getId())
        {
            $data = [
                'status' => 401,
                'error' => "Нет прав для выполнения действия!",
            ];
            return new JsonResponse($data);
        }
        $sku->setProject($targetProject);
        $this->entityManager->flush();
        $data = [
            'status' => 201,
         ];
        $data['result'] = $sku;
        return new Response($this->serializeObjectToJson($data));
      }

      #[Route(path: '/api/position-tracking/removesku', name: 'api-removesku', methods: ['POST'])]
      public function removeSku(Request $request): Response
      {
        $check = $this->checkStatusUserApi();
        if($check) return new JsonResponse($check);
        $params = json_decode($request->getContent(), true);
        $sku = $this->entityManager->getRepository(MonitoringSku::Class)->find($params['id']);
        if(!$sku)
        {
            $data = [
                'status' => 404,
                'error' => "Опс!",
             ];
            return new JsonResponse($data);
        }
        if($sku->getProject()->getOwner()->getId() != $this->getUser()->getId())
        {
            $data = [
                'status' => 401,
                'error' => "Нет прав для выполнения действия!",
            ];
            return new JsonResponse($data);
        }
        foreach($sku->getMSkuWords() as $mword)
        {
            $this->entityManager->remove($mword);
        }
        $this->entityManager->remove($sku);
        $this->entityManager->flush();
        $data = [
            'status' => 201,
         ];
        $data['result'] = 'OK';
        return new Response($this->serializeObjectToJson($data));
      }

      #[Route(path: '/api/position-tracking/removeProject', name: 'api-removeproject', methods: ['POST'])]
      public function removeProject(Request $request): Response
      {
        $check = $this->checkStatusUserApi();
        if($check) return new JsonResponse($check);
        $params = json_decode($request->getContent(), true);
        $project = $this->entityManager->getRepository(MonitoringProject::Class)->find($params['id']);
        if(!$project)
        {
            $data = [
                'status' => 404,
                'error' => "Опс!",
             ];
            return new JsonResponse($data);
        }
        if($project->getOwner()->getId() != $this->getUser()->getId())
        {
            $data = [
                'status' => 401,
                'error' => "Нет прав для выполнения действия!",
            ];
            return new JsonResponse($data);
        }
        foreach($project->getMonitoringSkus() as $sku)
        {
            foreach($sku->getMSkuWords() as $mword)
            {
                $this->entityManager->remove($mword);
            }
            $this->entityManager->remove($sku);            
        }
        $this->entityManager->remove($project);        
        $this->entityManager->flush();
        $data = [
            'status' => 201,
         ];
        $data['result'] = 'OK';
        return new Response($this->serializeObjectToJson($data));
      }

      #[Route(path: '/api/position-tracking/renameProject', name: 'api-renameproject', methods: ['POST'])]
      public function renameProject(Request $request): Response
      {
        $check = $this->checkStatusUserApi();
        if($check) return new JsonResponse($check);
        $params = json_decode($request->getContent(), true);
        $project = $this->entityManager->getRepository(MonitoringProject::Class)->find($params['id']);
        if(!$project)
        {
            $data = [
                'status' => 404,
                'error' => "Опс!",
             ];
            return new JsonResponse($data);
        }
        if($project->getOwner()->getId() != $this->getUser()->getId())
        {
            $data = [
                'status' => 401,
                'error' => "Нет прав для выполнения действия!",
            ];
            return new JsonResponse($data);
        }
        $project->setName($params['newname']);
        $this->entityManager->flush();
        $data = [
            'status' => 201,
         ];
        $data['result'] = 'OK';
        return new Response($this->serializeObjectToJson($data));
      }

      #[Route(path: '/api/position-tracking/removeskuwords', name: 'api-removeskuwords', methods: ['POST'])]
      public function removeSkuWords(Request $request): Response
      {
        $check = $this->checkStatusUserApi();
        if($check) return new JsonResponse($check);
        $params = json_decode($request->getContent(), true);
        $sku = $this->entityManager->getRepository(MonitoringSku::Class)->find($params['id']);
        if(!$sku)
        {
            $data = [
                'status' => 404,
                'error' => "Опс!",
             ];
            return new JsonResponse($data);
        }
        
        if($sku->getProject()->getOwner()->getId() != $this->getUser()->getId())
        {
            $data = [
                'status' => 401,
                'error' => "Нет прав для выполнения действия!",
            ];
            return new JsonResponse($data);
        }

        $skuwords = $sku->getMSkuWords();
        $rmwords = array_map('strtolower', $params['words']);
        $removedwords = [];
        foreach($skuwords as $word)
        {
            if(in_array($word->getWord()->getWord(), $rmwords))
            {
                $removedwords[] = $word->getWord()->getWord();
                $this->entityManager->remove($word);

            }
        }
        $this->entityManager->flush();
        $data = [
            'status' => 201,
         ];
        $data['result'] = $removedwords;
        return new Response($this->serializeObjectToJson($data));
      }
    
    
    
    
    
    #[Route(path: '/tools/wb-card-checker', name: 'wb_card_checker')]
    public function toolsCardChecker(): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/wb-card-checker.html.twig');
    }
    #[Route(path: '/tools/wb-card-checker/{sku}', name: 'sku_checker', methods: ['GET'])]
    public function skuChecker($sku): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        $sale = $this->service->getSku($sku);
        if(!$sale){
            return $this->redirectToRoute('wb_card_checker');
        }
        return $this->render('seo/skuChecker.html.twig', $sale);
    }
    #[Route(path: '/tools/wb-card-checker/{sku}', name: 'sku_checker_post', methods: ['POST'])]
    public function skuCheckerPost($sku, Request $request): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        $sale = $this->service->getSkuPost($sku, $request->request->all());
        return $this->render('seo/skuChecker.html.twig', $sale);
    }
    #[Route(path: '/tools/wb-sku-compare', name: 'wb_sku_compare', methods: ['GET'])]
    public function toolsSkuCompare(): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        return $this->render('seo/wb-sku-compare.html.twig');
    }
    #[Route(path: '/tools/wb-sku-compare', name: 'wb_sku_compare_post', methods: ['POST'])]
    public function toolsSkuComparePost(Request $request): Response
    {
        $check = $this->checkStatusUser();
        if($check) return $check;
        $groupA = $request->request->all()['groupA']??null;
        $groupB = $request->request->all()['groupB']??null;
        if($groupA && $groupB){
            if(strlen($groupB) > 0 &&  strlen($groupA) > 0){
                $compare = $this->service->compareResult($groupA, $groupB);
                if($compare){
                    return $this->render('seo/wb-sku-compare-result.html.twig', $compare);
                }
            }
        }
        return $this->redirectToRoute('wb_sku_compare');
    }
}