<?php

namespace App\Controller;

use App\Entity\HouseType;
use App\Form\HouseTypeType;
use App\Repository\HouseTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/house-type")
 */
class HouseTypeController extends AbstractController
{
    /**
     * @Route("/", name="house_type_index", methods={"GET"})
     * @param HouseTypeRepository $houseTypeRepository
     * @return Response
     */
    public function index(HouseTypeRepository $houseTypeRepository): Response
    {
        return $this->render('house_type/index.html.twig', [
            'house_types' => $houseTypeRepository->findAll(),
            'current_menu' => 'house_type'
        ]);
    }

    /**
     * @Route("/new", name="house_type_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $houseType = new HouseType();
        $form = $this->createForm(HouseTypeType::class, $houseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($houseType);
            $entityManager->flush();

            return $this->redirectToRoute('house_type_index');
        }

        return $this->render('house_type/new.html.twig', [
            'house_type' => $houseType,
            'form' => $form->createView(),
            'current_menu' => 'house_type'
        ]);
    }

    /**
     * @Route("/{id}", name="house_type_show", methods={"GET"})
     * @param HouseType $houseType
     * @return Response
     */
    public function show(HouseType $houseType): Response
    {
        return $this->render('house_type/show.html.twig', [
            'house_type' => $houseType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="house_type_edit", methods={"GET","POST"})
     * @param Request $request
     * @param HouseType $houseType
     * @return Response
     */
    public function edit(Request $request, HouseType $houseType): Response
    {
        $form = $this->createForm(HouseTypeType::class, $houseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('house_type_index');
        }

        return $this->render('house_type/edit.html.twig', [
            'house_type' => $houseType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="house_type_delete", methods={"DELETE"})
     * @param Request $request
     * @param HouseType $houseType
     * @return Response
     */
    public function delete(Request $request, HouseType $houseType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$houseType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($houseType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('house_type_index');
    }
}
