<?php

namespace ChatBundle\Controller;



use ChatBundle\Entity\Contact;
use ChatBundle\Entity\Message;
use ChatBundle\Entity\User;
use ChatBundle\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
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

    public function addContactAction(User $user)
    {
        $userconnected = $this->getUser();
        $contact = $user;

        $em = $this->getDoctrine()->getManager();
        $existOb = $em ->getRepository('ChatBundle:Contact')->myfindContact($contact, $userconnected);
$exist = $existOb[0]->getId();
        if (empty($exist))
        {
            $tab = new Contact();
            $tab ->addUser($contact);
            $tab ->addUser($userconnected);
            $em->persist($tab);
            $em->flush();

            return $this->redirectToRoute('chat_add_message_chat', array(
                'contact' => $contact,
                'exist' => $exist
            ));
        }

        return $this->redirectToRoute('chat_add_message_chat', array(
            'contact' => $contact,
            'exist' => $exist
        ));


    }


    public function chatAddMessageAction(Request $request, $contact, $exist)
    {


        $message = new Message();
        $userconnected = $this->getUser();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        //Trouver la table contact
        $messages = $em ->getRepository('ChatBundle:Message')->myfindmessages($exist);
        dump($messages);die();


        if ($form->isSubmitted() && $form->isValid())
        {

            $exist= $em ->getRepository('ChatBundle:Contact')->findOneById($exist);
            $message->setDateTime(new \DateTime());
            $message->setContact($exist);//ajouter la table contact à l'id
            $message->setUser($userconnected);
            $em->persist($message);
            $em->flush();
            $exist = $exist->getId();
            return $this->redirectToRoute('chat_add_message_chat', array(
                'contact' => $contact,
                'exist' => $exist
            ));
        }

        return $this->render('@Chat/chatchat.html.twig', array(
            'contact' => $userconnected,
            'user' => $user,
            'message' => $message,
            'messages' => $messages,
            'form' => $form->createView(),
        ));
    }

}