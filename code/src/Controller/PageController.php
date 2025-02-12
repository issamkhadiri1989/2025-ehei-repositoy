<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\User;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/page', name: 'app_page')]
    public function index(EntityManagerInterface $manager): Response
    {
        /** @var BlogRepository $repository */
        $repository = $manager->getRepository(Blog::class);
        /** @var Blog[] $blogs */
        $blogs = $repository->getPublishedBlogs();
        /*$blogs = $repository->getBlogsPublishedOnly(new \DateTime('2024-12-28'), new \DateTime('2024-12-31'), $user);*/

        dump($blogs);

        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/contact-us', name: 'app_contact_us')]
    public function contactUs(Request $request): Response
    {
        // data: this option is used to set initial data for the form being built
        $builder = $this->createFormBuilder()
            ->add(
                'email_address',
                EmailType::class,
                /*[
                    'attr' => [
                        'class' => 'custom-class',
                        'placeholder' => 'Your@email.com',
                    ],
                ],*/
            )
            ->add('full_name', TextType::class)
            ->add('message', TextareaType::class)
//            ->add('send', SubmitType::class)
        ;

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // add a flashing message, a "notification", for the user.
            $this->addFlash(
                'success',
                "Nous vous remercions d'avoir pris le temps de nous contacter. Nous allons vous répondre dans les plus brefs délais.",
            );

            // redirect to an internal route (home page)
            return $this->redirectToRoute('app_default');
        }

        return $this->render('page/contact_us.html.twig', ['contact_form' => $form]);
    }

    #[Route(path: "/search", name: "app_search")]
    public function search(Request $request): Response
    {
        $term = $request->query->get('term', 'default value');

        dump($term);

        $all = $request->query->all();

        dump($all);

        return $this->render('page/search.html.twig');
    }

    #[Route(name: "app_download_terms_file", path: "/download-terms-and-conditions")]
    public function downloadTermsAndConditions(): Response
    {
        // check first if the file exists
        // if not, then a 404 response
        if (!\file_exists('terms/Terms_And_Conditions2024.pdf')) {
//            return new JsonResponse(['error' => 'file not found'], status: Response::HTTP_NOT_FOUND);
            return $this->json(['error' => 'file not found'], status: Response::HTTP_NOT_FOUND);
        }

        // you can use the shortcut
        return $this->file(
            file: 'terms/Terms_And_Conditions2024.pdf',
            disposition: ResponseHeaderBag::DISPOSITION_ATTACHMENT, // (OR ResponseHeaderBag::DISPOSITION_INLINE)
        );

       /* return new BinaryFileResponse(
            file: 'terms/Terms_And_Conditions2024.pdf',
            contentDisposition: ResponseHeaderBag::DISPOSITION_ATTACHMENT, (OR ResponseHeaderBag::DISPOSITION_INLINE)
        );*/
    }
}
