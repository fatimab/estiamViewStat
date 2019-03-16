<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\FOSRestBundle;
use GatherBundle\Entity\Agent;
use GatherBundle\Repository\CommercantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use GatherBundle\Entity\Commercant;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;

class AgentController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/agent/list")
     */
    public function getAgentsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('GatherBundle:Agent')->findAll();

        $formatted = [];
        /** @var Agent $agent */
        foreach ($list as $agent) {
            $formatted[] = [
                'id'                 => $agent->getId(),
                'nom'                => $agent->getNom(),
                'prenom'             => $agent->getPrenom(),
                'date_naissance'     => $agent->getDateNaissance(),
                'lieu'               => $agent->getLieuNaissance(),
                'numero'             => $agent->getNumero(),
                'photo'              => $agent->getPhoto(),
                'adresse'            => $agent->getAdresse(),
                'last_connection'    => $agent->getLastConnection(),
                'location_connection'=> $agent->getLocationConnection()
            ];
        }

        return new JsonResponse($formatted);
    }

    /**
     * @Rest\Get("/api/agents/{id}")
     */
    public function getOneAgentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $agent = $em->getRepository('GatherBundle:Agent')->find($request->get('id'));

        $formatted[] = [
            'id'                 => $agent->getId(),
            'nom'                => $agent->getNom(),
            'prenom'             => $agent->getPrenom(),
            'date_naissance'     => $agent->getDateNaissance(),
            'lieu_naissance'     => $agent->getLieuNaissance(),
            'numero'             => $agent->getNumero(),
            'photo'              => $agent->getPhoto(),
            'adresse'            => $agent->getAdresse(),
            'last_connection'    => $agent->getLastConnection(),
            'location_connection'=> $agent->getLocationConnection()
        ];

        return new JsonResponse($formatted);
    }

    /**
     * @param Request $request
     * @Rest\Post("/api/agents/create")
     * @return string
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->getContent();
        $agent = $this->get('serializer')->deserialize($data, Agent::class, 'json');
        $em->persist($agent);
        $em->flush();
        return new JsonResponse(['code' => '200']);
    }

    /**
     * @param Request $request
     * @Rest\Post("api/agents/update/{id}")
     * @return string
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Commercant $leCommercant */
        $agent = $em->getRepository(Agent::class)->find($id);

        $data = $request->getContent();

        /** @var Agent $agentJson */
        $agentJson = $this->get('serializer')->deserialize($data, Agent::class, 'json');

        $agent->setNom($agentJson->getNom());
        $agent->setPrenom($agentJson->getPrenom());
        $agent->setDateNaissance($agentJson->getDateNaissance());
        $agent->setLieuNaissance($agentJson->getLieuNaissance());
        $agent->setNumero($agentJson->getNumero());
        $agent->setPhoto($agentJson->getPrenom());
        $agent->setAdresse($agentJson->getAdresse());
        $agent->setLastConnection($agentJson->getLastConnection());
        $agent->setLocationConnection($agentJson->getLocationConnection());

        $em->persist($agent);
        $em->flush();
        return new JsonResponse(['code' => '200']);
    }

    /**
     * @param Request $request
     * @param $id
     * @Rest\Get("/api/agents/delete/{id}")
     * @return string
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Agent $agent */
        $agent = $em->getRepository(Agent::class)->find($id);

        $em->remove($agent);
        $em->flush();

        return new JsonResponse(['code' => '200']);
    }
}