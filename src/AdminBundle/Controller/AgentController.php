<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Agent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Agent controller.
 *
 * @Route("admin/agent")
 */
class AgentController extends Controller
{
    /**
     * Lists all agent entities.
     *
     * @Route("/", name="admin_agent_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agents = $em->getRepository('AdminBundle:Agent')->findAll();

        return $this->render('agent/index.html.twig', array(
            'agents' => $agents,
        ));
    }

    /**
     * Creates a new agent entity.
     *
     * @Route("/new", name="admin_agent_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $agent = new Agent();
        $form = $this->createForm('AdminBundle\Form\AgentType', $agent , [ "validation_groups" => [ "new" ] ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file = $agent->getImage();
            $fileName = md5(uniqid()).".". $file->guessExtension();
            $file->move($this->getParameter('uploads_agents_directory'),$fileName);
            $agent->setImage($fileName);
            


            $em->persist($agent);
            $em->flush();

            $this->addFlash('success',"créé avec succès  " . $agent->getNom() . "  :)");
            return $this->redirectToRoute('admin_agent_index');
        }

        return $this->render('agent/new.html.twig', array(
            'agent' => $agent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agent entity.
     *
     * @Route("/{id}", name="admin_agent_show")
     * @Method("GET")
     */
    public function showAction(Agent $agent)
    {
        $deleteForm = $this->createDeleteForm($agent);

        return $this->render('agent/show.html.twig', array(
            'agent' => $agent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agent entity.
     *
     * @Route("/{id}/edit", name="admin_agent_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Agent $agent)
    {
        $oldPost = $agent->getImage();
        $deleteForm = $this->createDeleteForm($agent);
        $editForm = $this->createForm('AdminBundle\Form\AgentType', $agent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if($agent->getImage() == null){
                $agent->setImage($oldPost);
            }
            else{
                $file = $agent->getImage();
                $fileName = md5(uniqid()).".". $file->guessExtension();
                $file->move($this->getParameter('uploads_agents_directory'),$fileName);
                $agent->setImage($fileName);
            }


            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success',"Mis à jour avec succés   " . $agent->getNom() . "  :)");
            return $this->redirectToRoute('admin_agent_index');
        }

        return $this->render('agent/edit.html.twig', array(
            'agent' => $agent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agent entity.
     *
     * @Route("/{id}", name="admin_agent_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Agent $agent)
    {
        $form = $this->createDeleteForm($agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agent);
            $em->flush();
        }

        return $this->redirectToRoute('admin_agent_index');
    }

    /**
     * Creates a form to delete a agent entity.
     *
     * @param Agent $agent The agent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agent $agent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_agent_delete', array('id' => $agent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
