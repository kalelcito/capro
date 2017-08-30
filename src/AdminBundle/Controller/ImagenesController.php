<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\Imagenes;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

/**
 * Imagenes controller.
 *
 * @Route("/imagenes")
 */
class ImagenesController extends Controller
{
    /** index test
     * Lists all Imagenes entities.
     *
     * @Route("/", name="imagenes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imagenes = $em->getRepository('CoreBundle:Imagenes')->findAll();

        return $this->render('imagenes/index.html.twig', array(
            'imagenes' => $imagenes,
        ));
    }

    /**
     * Creates a new Imagenes entity.
     *
     * @Route("/new", name="imagenes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imagene = new Imagenes();
        $form = $this->createForm('CoreBundle\Form\ImagenesType', $imagene);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($imagene->getImagen()){
                $file = $imagene->getImagen();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('img_directory'),
                    $fileName
                );

                //main color
                $palette = Palette::fromFilename($this->getParameter('img_directory').'/'.$fileName);
                $extractor = new ColorExtractor($palette);
                $colors = $extractor->extract(1);

                $imagene->setColorAvg(Color::fromIntToHex($colors[0]));
                $imagene->setImagen($fileName);
            }

            $em->persist($imagene);
            $em->flush();

            return $this->redirectToRoute('imagenes_show', array('id' => $imagene->getId()));
        }

        return $this->render('imagenes/new.html.twig', array(
            'imagene' => $imagene,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Imagenes entity.
     *
     * @Route("/{id}", name="imagenes_show")
     * @Method("GET")
     */
    public function showAction(Imagenes $imagene)
    {
        $deleteForm = $this->createDeleteForm($imagene);

        return $this->render('imagenes/show.html.twig', array(
            'imagene' => $imagene,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Imagenes entity.
     *
     * @Route("/{id}/edit", name="imagenes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Imagenes $imagene)
    {
        $deleteForm = $this->createDeleteForm($imagene);
        $editForm = $this->createForm('CoreBundle\Form\ImagenesType', $imagene);
        $tmp = $imagene->getImagen();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($imagene->getImagen()){
                $file = $imagene->getImagen();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('img_directory'),
                    $fileName
                );

                //main color
                $palette = Palette::fromFilename($this->getParameter('img_directory').'/'.$fileName);
                $extractor = new ColorExtractor($palette);
                $colors = $extractor->extract(1);

                $imagene->setColorAvg(Color::fromIntToHex($colors[0]));
                $imagene->setImagen($fileName);
            }else{
                $imagene->setImagen($tmp);
            }

            $em->persist($imagene);
            $em->flush();

            //return $this->redirectToRoute('imagenes_edit', array('id' => $imagene->getId()));
            return $this->redirectToRoute('imagenes_index');

        }

        return $this->render('imagenes/edit.html.twig', array(
            'imagene' => $imagene,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Imagenes entity.
     *
     * @Route("/{id}", name="imagenes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Imagenes $imagene)
    {
        $form = $this->createDeleteForm($imagene);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            unlink($this->getParameter('img_directory').'/'.$imagene->getImagen());
            $em->remove($imagene);
            $em->flush();
        }

        return $this->redirectToRoute('imagenes_index');
    }

    /**
     * Creates a form to delete a Imagenes entity.
     *
     * @param Imagenes $imagene The Imagenes entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Imagenes $imagene)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('imagenes_delete', array('id' => $imagene->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
