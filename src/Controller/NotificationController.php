<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Notification as Notification;
use App\Form\NotificationType;
use App\Repository\NotificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\Notification as FCMNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/notification")
 */
class NotificationController extends AbstractController
{
    private $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * @Route("/", name="notification_index", methods={"GET"})
     * @param NotificationRepository $notificationRepository
     * @return Response
     */
    public function index(NotificationRepository $notificationRepository): Response
    {
        return $this->render('notification/index.html.twig', [
            'notifications' => $notificationRepository->findAll(),
            'current_menu' => 'notification'
        ]);
    }

    /**
     * @Route("/new", name="notification_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $notification = new Notification();
        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $title = $data->getTitle();
            $body = $data->getBody();
            $image = $data->getImage();
            $customers = $data->getCustomers();
            $token_ids  = [];

            /**
             * @var  $key
             * @var Customer $customer
             */
            foreach ($customers as $key => $customer){
                $token_ids[$key] = $customer->getUUID();
            }

            $deviceToken = null;
            $message_multi = Messaging\CloudMessage::new();

            try {
                $this->messaging->sendMulticast($message_multi, $token_ids);
            } catch (MessagingException $e) {
                echo $e->getMessage();
            } catch (FirebaseException $e) {
                echo $e->getMessage();
            }


          /*  $message = Messaging\CloudMessage::withTarget('token' , '')
                ->withNotification(FCMNotification::create($title , $body)->withImageUrl($image))
                ->withData(['key' => 'value']);*/

          /*  try {
                $this->messaging->send($message);
            } catch (MessagingException $e) {
                echo $e->getMessage();
            } catch (FirebaseException $e) {
                echo $e->getMessage();
            }*/

           /* $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($notification);
            $entityManager->flush();

            return $this->redirectToRoute('notification_index');*/
        }

        return $this->render('notification/new.html.twig', [
            'notification' => $notification,
            'form' => $form->createView(),
            'current_menu' => 'notification'
        ]);
    }

    /**
     * @Route("/{id}", name="notification_show", methods={"GET"})
     */
    public function show(Notification $notification): Response
    {
        return $this->render('notification/show.html.twig', [
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="notification_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Notification $notification): Response
    {
        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('notification_index');
        }

        return $this->render('notification/edit.html.twig', [
            'notification' => $notification,
            'form' => $form->createView(),
            'current_menu' => 'notification'
        ]);
    }

    /**
     * @Route("/{id}", name="notification_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Notification $notification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($notification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('notification_index');
    }
}
