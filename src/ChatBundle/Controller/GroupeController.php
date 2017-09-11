<?php

namespace ChatBundle\Controller;



use ChatBundle\Entity\Groupe;
use ChatBundle\Form\GroupeType;
use  Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class GroupeController extends Controller
    {

        public function IndexAction()
        {
            return $this->render('@Chat/NewGroupe.html.twig');
        }

    /**
     * Create à new groupe entity
     */

    public function GroupeAddAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $groupes = $em ->getRepository(Groupe::class)->findAll();

        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();

            return $this->redirectToRoute('chat_groupe');
        }

        return $this->render('@Chat/NewGroupe.html.twig', array(

            'groupe' => $groupe,
            'groupes' => $groupes,
            'form' => $form->createView(),

        ));

    }
    }
