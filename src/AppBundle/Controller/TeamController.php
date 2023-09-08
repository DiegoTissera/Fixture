<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Team;
use AppBundle\Form\TeamType;

class TeamController extends Controller
{
    public function newAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Team::class);
        $team = $repository->findAll();
        $team = new Team();

        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             if ($this->isDuplicateTeam($team)) {
                $this->addFlash('error', 'El equipo ya existen.');
            } else {

            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            return $this->redirectToRoute('team');
            }
        }

        return $this->render(
            'form/newTeam.html.twig',
            (['form' => $form->createView()])
        );
    }
    private function isDuplicateTeam(Team $team)
    {
        $existingTeam = $this->getDoctrine()->getRepository(Team::class)->findOneBy([
            'name' => $team->getName(),
            ]);

        return $existingTeam !== null;
    }



    public function teamAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Team::class);
        $team = $repository->findAll();
        return $this->render(
            'form/team.html.twig',
            (['team'=>$team])
        );
    }

    public function editAction(Request $request, $id)
    {
        if($id)
        {
        $repository = $this->getDoctrine()->getRepository(Team::class);
        $team = $repository->find($id);
        // $team = new Team();

        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            return $this->redirectToRoute('team');
        }
        return $this->render(
            'form/team.html.twig',
            (['form' => $form->createView()])
        );
    }

    public function deleteTeamAction(Request $request, $id=null)
    {
        if($id)
        {
            $repository = $this->getDoctrine()->getRepository(Team::class);
            $team = $repository->find($id);

            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush();
        }

        return $this->redirectToRoute('team');
    }
}