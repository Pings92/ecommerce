<?php

namespace App\Tests\Controller;

use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginPageLoaderForAnonymousUser(): void
    {
        // 1. Crée un client HTTP simulé qui agit comme un navigateur pour faire des requêtes
        $client = static::createClient();
        // 2. Effectue une requête GET vers l'URL '/login'
        // Le Crawler ($crawler) est retourné pour permettre l'inspection du contenu HTML.
        $crawler = $client->request('GET', '/login');

        // 3. Assertion : Vérifie que la réponse du serveur a réussi (code HTTP 2xx).
        // C'est une vérification générique (ex: 200, 201, 204...).
        $this->assertResponseIsSuccessful(); // Juste vérifier que /login répond 200
        // // 4. Assertion : Vérifie spécifiquement que le code de statut HTTP est exactement 200 (OK).
        // // Note: La ligne ci-dessus (assertResponseIsSuccessful) et celle-ci sont souvent redondantes 
        // // si l'on s'attend strictement à 200, mais elles sont toutes deux valides.
        // $this->assertResponseStatusCodeSame(200);

        //on verif que le form de co existe
        $this->assertSelectorExists('form.loginform');
        // on verifieque le champ email  et password existe
        $this->assertSelectorExists('input[name="email"]');
        // on verifieque le champ email  et password existe
        $this->assertSelectorExists('input[name="password"]');
        //on verifie que le h1 de connexion est présent
        $this->assertSelectorTextContains('h1', 'Connexion');

        }
        public function testLoginRedirectsIfAlreadyAuthenticated(): void
        {
            //1: crée un client http simulé
            $client = static::createClient();
            //simule un user connecté
            $container = static::getContainer();
            $userProvider = $container->get('security.user.provider.concrete.app_user_provider_test');
            $user = $userProvider->loadUserByIdentifier('test@test.com');
            $client->loginUser($user);
            //on effecture une requete get vers l'url '/login'
            $client->request('GET', '/login');
            //on verifie le code 302 de la rediction
            $this->assertResponseRedirects();
        }
        public function testLogoutWorks() : void {

        $client = static::createClient();
        $container = static::getContainer();

        $userProvider = $container->get('security.user.provider.concrete.app_user_provider_test');

        $user = $userProvider->loadUserByIdentifier('test@test.com');

        $client->loginUser($user);

        $client->request('GET', '/logout');

        $this->assertResponseRedirects();

        }
}
