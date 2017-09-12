<?php

namespace ChatBundle\Controller;

use ChatBundle\Entity\Channel;
use ChatBundle\Form\ChannelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ChannelController extends Controller
{
    public function indexAction()
    {

        return $this->render('ChatBundle:Channel:index.html.twig', array(
            // ...
        ));
    }

    public function AddChannelAction(Request $request)
    {
        $em =$this->getDoctrine()->getManager();

        $Channel = new Channel();
        $form = $this->createForm(ChannelType::class, $Channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em->persist($Channel);
            $em->flush();

            return $this->redirectToRoute('channel_add_members', array(

                )
            );
        }

        return $this->render('ChatBundle:Channel:add_channel.html.twig', array(
            'form' => $form->createView(),

        ));

    }
    public function AddMembersAction(Request $request)
    {
        $em =$this->getDoctrine()->getManager();

        $form = $this->createForm(Channel::class, $Channel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em->persist($Channel);
            $em->flush();

            return $this->redirectToRoute('channel');
        }

        return $this->render('ChatBundle:Channel:add_channel.html.twig', array(
            'form' => $form->createView()
        ));

    }
    public function channelAction(Request $request)
    {
//        $em =$this->getDoctrine()->getManager();
//
//        $form = $this->createForm(Channel::class, $Channel);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()){
//
//            $em->persist($Channel);
//            $em->flush();
//
//            return $this->redirectToRoute('channel');
//        }
//
//        return $this->render('ChatBundle:Channel:add_channel.html.twig', array(
//            'form' => $form->createView()
//        ));

    }

}
