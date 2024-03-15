<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'prenom' => 'Nicolas',
        ]);
    }

    #[Route('/lang/{locale}', name: 'app_language')]
    public function changeLocale(string $locale, Request $request): RedirectResponse
    {
        if(!in_array($locale, ['en', 'fr'])) {
            throw $this->createNotFoundException('This language does not exist');
        }

        $request->getSession()->set('_locale', $locale);

        return $this->redirectToRoute('app_home');
    }
}
