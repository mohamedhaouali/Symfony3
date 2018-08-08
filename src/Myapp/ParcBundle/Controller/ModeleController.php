<?php

namespace Myapp\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Myapp\ParcBundle\Form\ModeleType;
use Myapp\ParcBundle\Entity\Modele;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ModeleController extends Controller
{
    public function ajoutAction(Request $request)
    {
        $message='Ajouter un modele';// pour afficher le message "insertion valide"
        $modele=new Modele;
        $form=$this->createForm(ModeleType::class,$modele);// syncrhonisation form avec objet
        $form->handleRequest($request);//Methode de recuperation
        if($form->isSubmitted())
        {  
         $em=  $this->getDoctrine()->getManager();
         $em->persist($modele);//insertion des donneés
          $em->flush();//execution des requetes
          $message="insertion valide";// pour afficher le message "insertion valide"
          return $this->redirectToRoute('parc_afficher');// redirection pour la route afficher modele
        }
        
        
        
        return $this->render('ParcBundle:Modele:ajoutModele.html.twig',array('form'=>$form->createView(),'message'=>$message));
    }
    
    public function AfficheAction()
    {
        $em=$this->getDoctrine()->getManager();
        $modeles=$em->getRepository("ParcBundle:Modele")->findAll();// afficher tous les modeles
        return $this->render('ParcBundle:Modele:afficheModele.html.twig',array('modeles'=>$modeles));
    }
    
        public function SupprimerAction(Request $request,$id) {
            
       $modele=new Modele;
       $em=$this->getDoctrine()->getManager();
       $modele=$em->getRepository("ParcBundle:Modele")->find($id);// supprime par id
       $em->remove($modele); 
       $em->flush();// lorsque il supprime il reste au meme page
       return $this->redirectToRoute('parc_afficher');// redirection pour la route afficher modele
    } 
    
    public function ModifierAction(Request $request,$id){
             $message='Modifier un modele';
             $em=  $this->getDoctrine()->getManager();  
             $modele=$em->getRepository("ParcBundle:Modele")->find($id);// modifier par id
             $form=$this->createForm(ModeleType::class,$modele);// syncrhonisation form avec objet
              $form->handleRequest($request);//Methode de recuperation
               if($form->isSubmitted())
        {  
          
          $em->persist($modele);//insertion des donneés
          $em->flush();//execution des requetes
          $message="modification valide";// pour afficher le message "modification valide"
          return $this->redirectToRoute('parc_afficher');// redirection pour la route afficher modele
        }
        return $this->render('ParcBundle:Modele:modifierModele.html.twig',array('form'=>$form->createView(),'message'=>$message));
    }
    
     public function rechercheAction(Request $request)
            {
       $em = $this->getDoctrine()->getManager();
       $modeles=$em->getRepository("ParcBundle:Modele")->findAll();// afficher tous les modeles
       if($request->isMethod('POST'));{
         $pays=$request->get('pays');
         $modeles=$em->getRepository( "ParcBundle:Modele")->findBy(array("pays"=>$pays));// afficher par pays
           
       
       } 
       return $this->render('ParcBundle:Modele:rechercheModele.html.twig', array(
                    'modeles'=>$modeles,
        ));
       
       
}
}