<?php

namespace App\Controller;

use App\Entity\House;
use App\Form\HouseType;
use App\Repository\HouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/house")
 */
class HouseController extends AbstractController
{
    /**
     * @Route("/", name="house_index", methods={"GET"})
     * @param HouseRepository $houseRepository
     * @return Response
     */
    public function index(HouseRepository $houseRepository): Response
    {
        return $this->render('house/index.html.twig', [
            'houses' => $houseRepository->findAll(),
            'current_menu' => 'house'
        ]);
    }

    /**
     * @Route("/new", name="house_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request): Response
    {
        $house = new House();
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attachments = $house->getAttachments();
            foreach ($attachments as $key => $attachment){
                $attachment->setHouse($house);
                $attachments->set($key , $attachment);
            }

            $data = $form->getData();
            $value = $data->getHouseType()->getName();


            switch ($value){
                case 'Appartements':
                    $random = random_int(4, 8);
                    $house->setReference("APP".$random);
                    break;
                case 'Chambres' :
                    $random = random_int( 4,8);
                    $house->setReference("CHA".$random);
                    break;
                case 'Studio':
                    $random = random_int(4, 8);
                    $house->setReference("STU".$random);
                    break;
                case 'Maisons':
                    $random = random_int(4, 8);
                    $house->setReference("MAI".$random);
                    break;
                case 'Villa':
                    $random = random_int(4, 8);
                    $house->setReference("VILLA".$random);
                    break;
                default:
                    $random = random_int(4, 8);
                    $house->setReference($random);
                    break;
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($house);
            $entityManager->flush();

            return $this->redirectToRoute('house_index');
        }

        return $this->render('house/new.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
            'current_menu' => 'house'
        ]);
    }

    /**
     * @Route("/{id}", name="house_show", methods={"GET"})
     * @param House $house
     * @return Response
     */
    public function show(House $house): Response
    {
        return $this->render('house/show.html.twig', [
            'house' => $house,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="house_edit", methods={"GET","POST"})
     * @param Request $request
     * @param House $house
     * @return Response
     */
    public function edit(Request $request, House $house): Response
    {
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attachments = $house->getAttachments();
            foreach ($attachments as $key => $attachment){
                $attachment->setHouse($house);
                $attachments->set($key , $attachment);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($house);
            $entityManager->flush();

            return $this->redirectToRoute('house_index' , [
                'id' =>$house->getId(),
            ]);
        }

        return $this->render('house/edit.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="house_delete", methods={"DELETE"})
     */
    public function delete(Request $request, House $house): Response
    {
        if ($this->isCsrfTokenValid('delete'.$house->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($house);
            $entityManager->flush();
        }

        return $this->redirectToRoute('house_index');
    }
}
