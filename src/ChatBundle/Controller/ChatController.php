<?php

namespace ChatBundle\Controller;




use ChatBundle\ChatBundle;
use ChatBundle\Entity\Message;
use ChatBundle\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChatController extends Controller
{

    public function chatAction()
    {
        return $this->render('@Chat/Chat.html.twig');
    }


//    public function addMessageAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $messages = $em->getRepository(Message::class)->findAll();
//
//        $message = new Message();
//        $form = $this->createForm(MessageType::class, $message);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()){
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($message);
//            $em->flush();
//            $message->setDateCreation(new \DateTime());
//
//            return $this->redirectToRoute('chat_message_add');
//
//        }
//
//        return $this->render('@Chat/Chat.html.twig', array (
//            'message' => $message,
//            'form' => $form,
//            'messages' => $message,
//        ));
//
//
//
//
//    }
}