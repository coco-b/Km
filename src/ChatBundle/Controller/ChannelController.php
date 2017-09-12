<?php

namespace ChatBundle\Controller;

use ChatBundle\Entity\Channel;
use ChatBundle\Entity\Message;
use ChatBundle\Entity\User;
use ChatBundle\Form\ChannelType;
use ChatBundle\Form\ChannelUserType;
use ChatBundle\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ChannelController extends Controller
{
    public function indexAction()
    {
        $em =$this->getDoctrine()->getManager();
        $user = $this->getUser();

        $channels = $em->getRepository(Channel::class)->myfindChannels($user);

        return $this->render('ChatBundle:Channel:index.html.twig', array(
            'channels' => $channels,

        ));
    }

    public function AddChannelAction(Request $request)
    {
        $em =$this->getDoctrine()->getManager();

        $channel = new Channel();
        $form = $this->createForm(ChannelType::class, $channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em->persist($channel);
            $em->flush();
            $channelId = $channel->getId();
            return $this->redirectToRoute('channel_add_members', array(
                    'channelId' => $channelId,

                )
            );
        }

        return $this->render('ChatBundle:Channel:add_channel.html.twig', array(
            'form' => $form->createView(),

        ));

    }
    public function AddMembersAction(Request $request, $channelId)
    {
        $em =$this->getDoctrine()->getManager();

        $form = $this->createForm(ChannelUserType::class );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $channel = $em->getRepository('ChatBundle:Channel')->findOneById($channelId);

            if(!empty($form->getData()->getName()))
            {
                foreach ($form->getData()->getName() as $user)
                {
                    $channel->addUser($user);
                    $user->addChannel($channel);
                    $em->flush();
                }
            }
            return $this->redirectToRoute('channel', array(
                'channelId' => $channelId
            ));
        }

        return $this->render('ChatBundle:Channel:add_members.html.twig', array(
            'form' => $form->createView()
        ));


    }
    public function channelAction(Request $request, $channelId)
    {
        $em =$this->getDoctrine()->getManager();
        $channel = $em->getRepository('ChatBundle:Channel')->findOneById($channelId);
//        dump($channelId);die();
//        $channelUsers = $em->getRepository(User::class)->myfindChannels($channel);
//        dump($channelUsers);die();

        $messages =$em->getRepository(Message::class)->findByChannel($channel);

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $user = $this->getUser();
            $message->setDateTime(new \DateTime());
            $message->setUser($user);
            $message->setChannel($channel);
            $em->persist($message);
            $em->flush();

            return $this->render('ChatBundle:Channel:channel.html.twig', array(
                'form' => $form->createView(),
                'channelId' => $channelId,
                'channel' => $channel,
                'messages' => $messages
            ));
        }

        return $this->render('ChatBundle:Channel:channel.html.twig', array(
            'form' => $form->createView(),
            'channelId' => $channelId,
            'channel' => $channel,
            'messages' => $messages
        ));

    }

}
