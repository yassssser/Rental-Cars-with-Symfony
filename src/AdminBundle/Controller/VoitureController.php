<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Voiture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Voiture controller.
 *
 * @Route("admin/voiture")
 */
class VoitureController extends Controller
{
    /**
     * Lists all voiture entities.
     *
     * @Route("/", name="admin_voiture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $voitures = $em->getRepository('AdminBundle:Voiture')->findAll();

        return $this->render('voiture/index.html.twig', array(
            'voitures' => $voitures,
        ));
    }

    /**
     * Creates a new voiture entity.
     *
     * @Route("/new", name="admin_voiture_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $voiture = new Voiture();
        $form = $this->createForm('AdminBundle\Form\VoitureType', $voiture , [ "validation_groups" => [ "new" ] ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file = $voiture->getImage();
            $fileName = md5(uniqid()).".". $file->guessExtension();
            $file->move($this->getParameter('uploads_voitures_directory'),$fileName);
            $voiture->setImage($fileName);


            $em->persist($voiture);
            $em->flush();

            $this->addFlash('success',"créé avec succès " . $voiture->getLibelle() . "  :)");
            return $this->redirectToRoute('admin_voiture_index');
        }

        return $this->render('voiture/new.html.twig', array(
            'voiture' => $voiture,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a voiture entity.
     *
     * @Route("/{id}", name="admin_voiture_show")
     * @Method("GET")
     */
    public function showAction(Voiture $voiture)
    {
        $deleteForm = $this->createDeleteForm($voiture);

        return $this->render('voiture/show.html.twig', array(
            'voiture' => $voiture,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing voiture entity.
     *
     * @Route("/{id}/edit", name="admin_voiture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Voiture $voiture)
    {
        $oldPost = $voiture->getImage();
        $deleteForm = $this->createDeleteForm($voiture);
        $editForm = $this->createForm('AdminBundle\Form\VoitureType', $voiture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if($voiture->getImage() == null){
                $voiture->setImage($oldPost);
            }
            else{
                $file = $voiture->getImage();
                $fileName = md5(uniqid()).".". $file->guessExtension();
                $file->move($this->getParameter('uploads_voitures_directory'),$fileName);
                $voiture->setImage($fileName);

            }


            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success',"Mis à jour avec succés   " . $voiture->getLibelle() . "  :)");
            return $this->redirectToRoute('admin_voiture_index');
        }

        return $this->render('voiture/edit.html.twig', array(
            'voiture' => $voiture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a voiture entity.
     *
     * @Route("/{id}", name="admin_voiture_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Voiture $voiture)
    {
        $form = $this->createDeleteForm($voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($voiture);
            $em->flush();
        }

        return $this->redirectToRoute('admin_voiture_index');
    }

    /**
     * Creates a form to delete a voiture entity.
     *
     * @param Voiture $voiture The voiture entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Voiture $voiture)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_voiture_delete', array('id' => $voiture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
