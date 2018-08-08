<?php

namespace Myapp\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Myapp\ParcBundle\Form\VoitureType;
use Myapp\ParcBundle\Entity\Voiture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VoitureController extends Controller {
  
    
   public function ajoutVoitureAction(Request $request)
    {
        $message='Ajouter une voiture';// pour afficher le message "insertion valide"
        $voiture=new Voiture();
        $form=$this->createForm(VoitureType::class,$voiture);// syncrhonisation form avec objet
        $form->handleRequest($request);//Methode de recuperation
        if($form->isSubmitted())
        {  
         $em=$this->getDoctrine()->getManager();
         $voiture->uploadProfilePicture();
         $em->persist($voiture);//insertion des donneés
         $em->flush();//execution des requetes
         $message="insertion valide";// pour afficher le message "insertion valide"
         return $this->redirectToRoute('parc_afficher_voiture');// redirection pour la route afficher voiture
        }
        
       
       
        return $this->render('ParcBundle:Voiture:ajoutVoiture.html.twig',array('form'=>$form->createView(),'message'=>$message));
    } 
    
        public function AfficheAction()
    {
        $em=$this->getDoctrine()->getManager();
        $voitures=$em->getRepository("ParcBundle:Voiture")->findAll();// afficher tous les voitures
        return $this->render('ParcBundle:Voiture:afficheVoiture.html.twig',array('voitures'=>$voitures));
    }
  
}
