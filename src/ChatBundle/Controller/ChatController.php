<?php

namespace ChatBundle\Controller;



use ChatBundle\Entity\Message;
use ChatBundle\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ChatController extends Controller
{

    public function chatAction()
    {
        return $this->render('@Chat/Chat.html.twig');
    }

    /**
     * Create à new message entity
     */

    public function ChataddAction(Request $request)
    {
        $em =$this->getDoctrine()->getManager();
        $messages = $em ->getRepository(Message::class)->findAll();
        $users = $em->getRepository('ChatBundle:User')->findAll();


        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $message->setDateTime(new \DateTime());
            $message->setUser($user);
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('chat_message_add');
        }

        return $this->render('@Chat/Chat.html.twig', array(
            'users' => $users,
            'message' => $message,
            'messages' => $messages,
            'form' => $form->createView(),

        ));

    }

}