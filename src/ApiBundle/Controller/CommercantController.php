<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\FOSRestBundle;
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

class CommercantController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/commercants/list")
     */
    public function getCommercantsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('GatherBundle:Commercant')->findAll();

        $formatted = [];
        /** @var Commercant $commercant */
        foreach ($list as $commercant) {
            $formatted[] = [
                'id'=> $commercant->getId(),
                'nom' => $commercant->getNom(),
                'prenom' => $commercant->getPrenom(),
                'revenus' => $commercant->getRevenus(),
                'marche' => $commercant->getMarche(),
                'numero' => $commercant->getNumero(),
                'email' => $commercant->getEmail()
            ];
        }

        return new JsonResponse($formatted);
    }

    /**
     * @Rest\Get("/api/commercants/{id}")
     */
    public function getOneCommercantAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commercant = $em->getRepository('GatherBundle:Commercant')->find($request->get('id'));

        $formatted  = [
                'id'=> $commercant->getId(),
                'nom' => $commercant->getNom(),
                'prenom' => $commercant->getPrenom(),
                'revenus' => $commercant->getRevenus(),
                'marche' => $commercant->getMarche(),
                'numero' => $commercant->getNumero(),
                'email' => $commercant->getEmail()
        ];

        return new JsonResponse($formatted);
    }

    /**
     * @param Request $request
     * @Rest\Post("/api/commercants/create")
     * @return string
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->getContent();
        $commercant = $this->get('serializer')->deserialize($data, Commercant::class, 'json');
        $em->persist($commercant);
        $em->flush();
        return new JsonResponse(['code' => '200']);
    }

    /**
     * @param Request $request
     * @Rest\Post("api/commercants/update/{id}")
     * @return string
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Commercant $leCommercant */
        $leCommercant = $em->getRepository(Commercant::class)->find($id);

        $data = $request->getContent();
        /** @var Commercant $commercantJson */
        $commercantJson = $this->get('serializer')->deserialize($data, Commercant::class, 'json');

        $leCommercant->setNom($commercantJson->getNom());
        $leCommercant->setDescription($commercantJson->getDescription());
        $leCommercant->setEmail($commercantJson->getEmail());
        $leCommercant->setMarche($commercantJson->getMarche());
        $leCommercant->setNumero($commercantJson->getNumero());
        $leCommercant->setPrenom($commercantJson->getPrenom());
        $leCommercant->setRevenus($commercantJson->getRevenus());

        $em->persist($leCommercant);
        $em->flush();
        return new JsonResponse(['code' => '200']);
    }

    /**
     * @param Request $request
     * @param $id
     * @Rest\Get("/api/commercants/delete/{id}")
     * @return string
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Commercant $leCommercant */
        $leCommercant = $em->getRepository(Commercant::class)->find($id);
        $em->remove($leCommercant);
        $em->flush();

        return new JsonResponse(['code' => '200']);

    }
}
