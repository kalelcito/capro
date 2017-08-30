<?php

namespace AdminBundle\Controller;

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\PImagenes;

/**
 * PImagenes controller.
 *
 * @Route("/pimagenes")
 */
class PImagenesController extends Controller
{
    /** index test
     * Lists all PImagenes entities.
     *
     * @Route("/", name="pimagenes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pImagenes = $em->getRepository('CoreBundle:PImagenes')->findAll();

        return $this->render('pimagenes/index.html.twig', array(
            'pImagenes' => $pImagenes,
        ));
    }

    /**
     * Creates a new PImagenes entity.
     *
     * @Route("/new", name="pimagenes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pImagene = new PImagenes();
        $form = $this->createForm('CoreBundle\Form\PImagenesType', $pImagene);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($pImagene->getImagen()){
                $file = $pImagene->getImagen();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('img_directory'),
                    $fileName
                );

                //main color
                $palette = Palette::fromFilename($this->getParameter('img_directory').'/'.$fileName);
                $extractor = new ColorExtractor($palette);
                $colors = $extractor->extract(1);

                $pImagene->setColorAvg(Color::fromIntToHex($colors[0]));
                $pImagene->setImagen($fileName);
            }
            
            $em->persist($pImagene);
            $em->flush();

            return $this->redirectToRoute('pimagenes_show', array('id' => $pImagene->getId()));
        }

        return $this->render('pimagenes/new.html.twig', array(
            'pImagene' => $pImagene,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PImagenes entity.
     *
     * @Route("/{id}", name="pimagenes_show")
     * @Method("GET")
     */
    public function showAction(PImagenes $pImagene)
    {
        $deleteForm = $this->createDeleteForm($pImagene);

        return $this->render('pimagenes/show.html.twig', array(
            'pImagene' => $pImagene,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PImagenes entity.
     *
     * @Route("/{id}/edit", name="pimagenes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PImagenes $pImagene)
    {
        $deleteForm = $this->createDeleteForm($pImagene);
        $editForm = $this->createForm('CoreBundle\Form\PImagenesType', $pImagene);
        $tmp = $pImagene->getImagen();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($pImagene->getImagen()){
                $file = $pImagene->getImagen();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('img_directory'),
                    $fileName
                );

                //main color
                $palette = Palette::fromFilename($this->getParameter('img_directory').'/'.$fileName);
                $extractor = new ColorExtractor($palette);
                $colors = $extractor->extract(1);

                $pImagene->setColorAvg(Color::fromIntToHex($colors[0]));
                $pImagene->setImagen($fileName);
            }else{
                $pImagene->setImagen($tmp);
            }
            
            $em->persist($pImagene);
            $em->flush();

            //return $this->redirectToRoute('pimagenes_edit', array('id' => $pImagene->getId()));
            return $this->redirectToRoute('pimagenes_index');

        }

        return $this->render('pimagenes/edit.html.twig', array(
            'pImagene' => $pImagene,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PImagenes entity.
     *
     * @Route("/{id}", name="pimagenes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PImagenes $pImagene)
    {
        $form = $this->createDeleteForm($pImagene);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            unlink($this->getParameter('img_directory').'/'.$pImagene->getImagen());
            $em->remove($pImagene);
            $em->flush();
        }

        return $this->redirectToRoute('pimagenes_index');
    }

    /**
     * Creates a form to delete a PImagenes entity.
     *
     * @param PImagenes $pImagene The PImagenes entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PImagenes $pImagene)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pimagenes_delete', array('id' => $pImagene->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
