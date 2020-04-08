<?php


namespace App\Controller;

use App\Form\DossierType;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Dossier;
class DossierController extends AbstractController
{


    /**
     * @Route("/dossier/create", name="dossierCreate")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $dossier = new Dossier();
        $form = $this->createForm(DossierType::class, $dossier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dossier = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($dossier);
            $em->flush();

            return $this->redirectToRoute('dossierList');

        }

        return $this->render(
            'dossier/form.html.twig',
            [
                'page_title' => 'Create Dossier',
                'form' => $form->createView()
            ]
        );

    }

    /**
     * @Route("dossier/list", name="dossierList", methods={"GET"})
     */
    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $dossiers = $em->getRepository(Dossier::class)->findAllActive();

        return $this->render('dossier/list.html.twig',[
            'page_title' => 'Dossier List',
            'dossiers' => $dossiers
        ]);
    }

    /**
     * @Route("dossier/delete/{id}", name="dossierDelete")
     * @param int $id
     * @return Response
     * @throws NonUniqueResultException
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $dossier = $em->getRepository(Dossier::class)->findOneActive($id);

        if (!$dossier) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }
        $dossier->setDeleted(true);
        $em->flush();
        return $this->redirectToRoute('dossierList');
    }

    /**
     * @Route("dossier/edit/{id}", name="dossierUpdate")
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws NonUniqueResultException
     */
    public function update(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $dossier = $em->getRepository(Dossier::class)->findOneActive($id);

        if (!$dossier) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        $form = $this->createForm(DossierType::class, $dossier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute("dossierList");
        }

        return $this->render(
            'dossier/form.html.twig',
            [
                'page_title' => 'Edit Dossier',
                'form' => $form->createView()
            ]
        );
    }

}