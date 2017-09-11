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

    /**
     * Create new objet contact (2 utilisateur)
     */

    public function addContactAction(User $user)
    {
        $userconnected = $this->getUser();
        //<Utilisteur connecte
        $invite = $user;
        //utilisateur que l'on veut inviter

        $em = $this->getDoctrine()->getManager();
        $existOb = $em ->getRepository('ChatBundle:Contact')->myfindContact($invite, $userconnected);
        //on verifi que lobjet contact existe avec les deux utilisateurs

        if (empty($existOb))
        //Si lobjet est vide alors on creer notre table contact
        {
            $tab = new Contact();
            $tab ->addUser($invite);
            $tab ->addUser($userconnected);
            $em->persist($tab);
            $em->flush();
            $tabId = $tab->getId();
            //on recupere l'iD de notre objet
            return $this->redirectToRoute('chat_add_message_chat', array(
                'invite' => $invite,
                'exist' => $tabId
            ));
        }
        $exist = $existOb[0]->getId();
        return $this->redirectToRoute('chat_add_message_chat', array(
            'invite' => $invite,
            'exist' => $exist
        ));


    }

    /**
     *
     */

    public function chatAddMessageAction(Request $request, $invite, $exist)
    {


        $message = new Message();
        $userconnected = $this->getUser();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        //Trouver la table contact
        $messages = $em ->getRepository('ChatBundle:Message')->myfindmessages($exist);

        if ($form->isSubmitted() && $form->isValid())
        {
            $contact= $em ->getRepository('ChatBundle:Contact')->findOneById($exist);
            $message->setDateTime(new \DateTime());
            $message->setContact($contact);//ajouter la table contact à l'id
            $message->setUser($userconnected);
            $em->persist($message);
            $em->flush();
            $exist = $contact->getId();
            return $this->redirectToRoute('chat_add_message_chat', array(
                'invite' => $invite,
                'exist' => $exist
            ));
        }

        return $this->render('@Chat/chatchat.html.twig', array(
            'contact' => $userconnected,
            'message' => $message,
            'messages' => $messages,
            'form' => $form->createView(),
        ));
    }

}