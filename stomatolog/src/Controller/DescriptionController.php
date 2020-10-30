<?php

namespace App\Controller;

use App\Entity\Description;
use App\Form\DescriptionForm;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DescriptionController extends AbstractController
{
    /**
     * @Route("/description", name="app_description")
     */
    public function show(Request $request)
    {
        $posts = $this->getDoctrine()->getRepository('App:Description')->findAll();
        $content = new Description();
        $form = $this->createForm(DescriptionForm::class, $content);
        $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                     $em = $this->getDoctrine()->getManager();
                     $em->persist($content);
                     $em->flush();
                }

        return $this->render('description/description.html.twig', [
            'content_form' => $form->createView(),
            'posts' => $posts
        ]);

     }
}
