<?php

namespace ChatBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ChatBundle\Entity\Contact;
use ChatBundle\Entity\Message;
use ChatBundle\Entity\User;
use ChatBundle\Form\MessageType;


class ChatchatController extends Controller
{
    public function chatAddMessageAction(Request $request, $contact, $userconnected)
    {

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        $em = $this ->getDoctrine()->getManager();
        $messages = $em ->getRepository('ChatBundle:Message')->myfindmessages($contact, $userconnected);
        //dump($message);die();

        if ($form->isSubmitted() && $form->isValid())
        {
            //dump($message);die();
            $message->setDateTime(new \DateTime());
            $em->persist($message);
            $em->flush();

            return $this->render('@Chat/chatchat.html.twig', array(
                'userconnected' => $userconnected,
                'contact' => $contact,
                'message' => $message,
                'messages' => $messages,
                'form' => $form->createView(),

            ));

        }

        return $this->render('@Chat/chatchat.html.twig', array(
            'userconnected' => $userconnected,
            'contact' => $contact,
            'message' => $message,
            'messages' => $messages,
            'form' => $form->createView(),
        ));
    }
}