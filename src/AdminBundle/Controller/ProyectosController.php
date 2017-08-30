<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\Proyectos;

/**
 * Proyectos controller.
 *
 * @Route("/proyectos")
 */
class ProyectosController extends Controller
{
    /** index test
     * Lists all Proyectos entities.
     *
     * @Route("/", name="proyectos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $proyectos = $em->getRepository('CoreBundle:Proyectos')->findAll();

        return $this->render('proyectos/index.html.twig', array(
            'proyectos' => $proyectos,
        ));
    }

    /**
     * Creates a new Proyectos entity.
     *
     * @Route("/new", name="proyectos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $proyecto = new Proyectos();
        $form = $this->createForm('CoreBundle\Form\ProyectosType', $proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proyecto);
            $em->flush();

            return $this->redirectToRoute('proyectos_show', array('id' => $proyecto->getId()));
        }

        return $this->render('proyectos/new.html.twig', array(
            'proyecto' => $proyecto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proyectos entity.
     *
     * @Route("/{id}", name="proyectos_show")
     * @Method("GET")
     */
    public function showAction(Proyectos $proyecto)
    {
        $deleteForm = $this->createDeleteForm($proyecto);

        return $this->render('proyectos/show.html.twig', array(
            'proyecto' => $proyecto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Proyectos entity.
     *
     * @Route("/{id}/edit", name="proyectos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Proyectos $proyecto)
    {
        $deleteForm = $this->createDeleteForm($proyecto);
        $editForm = $this->createForm('CoreBundle\Form\ProyectosType', $proyecto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proyecto);
            $em->flush();

            //return $this->redirectToRoute('proyectos_edit', array('id' => $proyecto->getId()));
            return $this->redirectToRoute('proyectos_index');

        }

        return $this->render('proyectos/edit.html.twig', array(
            'proyecto' => $proyecto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Proyectos entity.
     *
     * @Route("/{id}", name="proyectos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Proyectos $proyecto)
    {
        $form = $this->createDeleteForm($proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proyecto);
            $em->flush();
        }

        return $this->redirectToRoute('proyectos_index');
    }

    /**
     * Creates a form to delete a Proyectos entity.
     *
     * @param Proyectos $proyecto The Proyectos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Proyectos $proyecto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proyectos_delete', array('id' => $proyecto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
