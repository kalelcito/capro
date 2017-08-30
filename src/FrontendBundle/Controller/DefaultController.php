<?php

namespace FrontendBundle\Controller;

use FrontendBundle\Form\ContactoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function menuAction(){
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('CoreBundle:Imagenes')->findOneBy(array('activo'=>1,'tipo'=>3));
        return $this->render('FrontendBundle:partials:menu.html.twig',array('menu'=>$menu));
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $home = $em->getRepository('CoreBundle:Imagenes')->findBy(array('activo'=>1,'tipo'=>1),array('id'=>'ASC'));
        return $this->render('FrontendBundle:Default:index.html.twig',array('home'=>$home));
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        $em = $this->getDoctrine()->getManager();
        $about = $em->getRepository('CoreBundle:Imagenes')->findBy(array('activo'=>1,'tipo'=>2),array('id'=>'ASC'));
        return $this->render('FrontendBundle:Default:about.html.twig',array('about'=>$about));
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(ContactoType::class,null,array(
            'method' => 'POST','attr'=>array('id'=>'contact-form'))
        );
        $enviado=0;
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $data = $form->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Capro Carpintería WebPage - Contacto')
                    ->setFrom($data['email'])
                    //->setTo(array('contacto@caprocarpinteria.com','arturo@caprocarpinteria.com'))
                    ->setTo(array('cesar@innology.mx'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/contact.html.twig',array('contacto'=>$data)),
                        'text/html'
                    )
                ;
                $this->get('mailer')->send($message);
                $enviado=1;
            }else{
                $enviado=0;
            }
        }else{
            $enviado=0;
        }

        return $this->render('@Frontend/Default/contact.html.twig', array(
            'form' => $form->createView(),
            'enviado' => $enviado,
        ));
    }

    /**
     * @Route("/customers", name="customers")
     */
    public function customersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('CoreBundle:Clientes')->findBy(array('activo'=>1),array('id'=>'ASC'));
        return $this->render('FrontendBundle:Default:customers.html.twig',array('clientes'=>$clientes));
    }

    /**
     * @Route("/projects", name="projects")
     */
    public function projectsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $proyectos = $em->getRepository('CoreBundle:Proyectos')->findBy(array('activo'=>1),array('id'=>'ASC'));
        $imagenes = $em->getRepository('CoreBundle:PImagenes')->findBy(array('activo'=>1,'principal'=>1),array('id'=>'ASC'));
        return $this->render('FrontendBundle:Default:projects.html.twig',array('proyectos'=>$proyectos,'imagenes'=>$imagenes));
    }

    /**
     * @Route("/project/{slug}", name="project")
     */
    public function projectAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $proyect = $em->getRepository('CoreBundle:Proyectos')->findOneBy(array('activo'=>1,'slug'=>$slug));
        $proyectos = $em->getRepository('CoreBundle:Proyectos')->findBy(array('activo'=>1),array('id'=>'ASC'));
        $imagenes = $em->getRepository('CoreBundle:PImagenes')->findBy(array('activo'=>1,'proyectos'=>$proyect->getId()));
        $ban=0;
        $i=0;
        $sig='';
        $first='';
        foreach ($proyectos as $item):
            if($i==0){
            $first=$item->getSlug();
            }
            if($ban==1){
                $sig=$item->getSlug();
                $ban=0;
            }
            if($item->getSlug()==$proyect->getSlug()){
                $ban=1;
            }
            $i++;
        endforeach;
        if($sig==''){
            $sig=$first;
        }
        return $this->render('FrontendBundle:Default:project.html.twig',array('proyecto'=>$proyect,'sig'=>$sig,'imagenes'=>$imagenes));
    }

    /**
     * @Route("/Error404", name="error404")
     */
    public function error404Action(){
        return $this->render('@Twig/Exception/error404.html.twig');
    }
}
