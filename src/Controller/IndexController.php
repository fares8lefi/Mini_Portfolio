<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\News;
use App\Form\ContactType;
use App\Form\NewsType;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('home/me.html.twig');
    }
    /**
     * @Route("/Admin", name="homeadmin")
     */
    public function homeAdmin(): Response
    {
        return $this->render('home/homeAdmin.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        // Votre logique pour la page "About"
    }

    /**
     * @Route("/services", name="services")
     */
    public function services(): Response
    {
        // Votre logique pour la page "Services"
    }

    /**
     * @Route("/index2", name="index2")
     */
    public function index2(): Response
    {
        // Votre logique pour la page "index2.html"
    }

    /**
     * @Route("/loginAdmin", name="login_admin")
     */
    public function loginAdmin(): Response
    {
        // Votre logique pour la page "loginAdmin.html"
    }
    /**
     * @Route("/call",name="new_message")
     * @Method({"GET","POST"})
     */
    public function new(Request $request)
    {
        $contact = new contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('home/call.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/affichage",name="Affichage_Contact")
     */
    public function affichage()
    {

        $messages = $this->getDoctrine()->getRepository(Contact::class)->findAll();
        return $this->render('home/affichageAdmin.html.twig', ['messages' => $messages]);
    }
    /**
     * @Route("/newsletter_Affichage")
     */
    public function afficheNews()
    {

        $messages = $this->getDoctrine()->getRepository(News::class)->findAll();
        return $this->render('home/affichaeNews.html.twig', ['messages' => $messages]);
    }
    /**
     * @Route("/newsletter_Affichage_Admin",name="news_letterAdmin")
     */
    public function afficheNewsAdmin()
    {

        $messages = $this->getDoctrine()->getRepository(News::class)->findAll();
        return $this->render('home/newsletterAdmin.html.twig', ['messages' => $messages]);
    }
    /**
     * @Route("/newsLetter",name="new_letter")
     * @Method({"GET","POST"})
     */
    public function newLetter(Request $request)
    {
        $letter = new News();
        $form = $this->createForm(NewsType::class, $letter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $letter = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($letter);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/news.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/newComment",name="new_Comment")
     * @Method({"GET","POST"})
     */
    public function comment(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment  = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('new_Comment');
        }

        return $this->render('home/comment.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/CommentAffichage" ,name="CommentAffichage")
     */
    public function afficheComment()
    {

        $messages = $this->getDoctrine()->getRepository(Comment::class)->findAll();
        return $this->render('home/AffichageComment.html.twig', ['messages' => $messages]);
    }
    /**
     * @Route("/CommentAffichageAdmin" ,name="CommentAffichageAdmin")
     */
    public function afficheCommentAdmin()
    {

        $messages = $this->getDoctrine()->getRepository(Comment::class)->findAll();
        return $this->render('home/CommentAdmin.html.twig', ['messages' => $messages]);
    }
}
