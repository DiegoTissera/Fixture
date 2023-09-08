<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\MatchSoccer;
use AppBundle\Form\MatchSoccerType;

class MatchSoccerController extends Controller
{
    public function newAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(MatchSoccer::class);
        $match = $repository->findAll();
        $match = new MatchSoccer();

        $form = $this->createForm(MatchSoccerType::class, $match);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->isDuplicateMatch($match)) {
                $this->addFlash('error', 'Los datos del partido ya existen.');
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($match);
                $em->flush();
                return $this->redirectToRoute('match');
            }
        }

        return $this->render(
            'form/newMatch.html.twig',
            (['form' => $form->createView()])
        );
    }
    private function isDuplicateMatch(MatchSoccer $match)
    {
        $existingMatch = $this->getDoctrine()->getRepository(MatchSoccer::class)->findOneBy([
            'datetime' => $match->getDatetime(),
            'home' => $match->getHome(),
            'visitor' => $match->getVisitor(),
        ]);

        return $existingMatch !== null;
    }



    public function matchAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(MatchSoccer::class);
        $match = $repository->findAll();
        return $this->render(
            'form/match.html.twig',
            (['match'=>$match])
        );
    }

    public function editAction(Request $request, $id)
    {
        if($id)
        {
        $repository = $this->getDoctrine()->getRepository(MatchSoccer::class);
        $match = $repository->find($id);
        // $match = new MatchSoccer();
        // $home =getHome();
        // $visitor=getVisitor();
        $form = $this->createForm(MatchSoccerType::class, $match);
        $form->handleRequest($request);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $match = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($match);
            $em->flush();
            return $this->redirectToRoute('match');
        }
        return $this->render(
            'form/editMatch.html.twig',
            (['form' => $form->createView()])
        );
    }

    public function deleteMatchAction(Request $request, $id=null)
    {
        if($id)
        {
            $repository = $this->getDoctrine()->getRepository(MatchSoccer::class);
            $match = $repository->find($id);

            $em = $this->getDoctrine()->getManager();
            $em->remove($match);
            $em->flush();
        }

        return $this->redirectToRoute('match');
    }

    public function fixtureAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('form/fixture.html.twig', ['fixtures' => $fixtures]);
    }
}