<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\Provider\GithubClient;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class GithubController extends AbstractController
{


    #[Route("/connect/github", name: "github_connect")]
    public function connect(ClientRegistry $clientRegistry)
    {
        /** @var GithubClient $client */
        $client = $clientRegistry->getClient('github');

        return $client->redirect(['read:user', 'user:email']);
    }

    /**
     * After going to Github, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     *
     */
    #[Route("/connect/github/check", name: "connect_github_check")]
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {

        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
        // (read below)

        /** @var GithubClient $client */
        $client = $clientRegistry->getClient('github');

        try {
            // The exact class depends on which provider you're using
            // This class may not be correct one
            /** @var GithubClient $user */
            $user = $client->fetchUser();

            // do something with all this new power!
            // e.g. $name = $user->getFirstName();
            var_dump($user);
            die;
            // ...
        } catch (IdentityProviderException $e) {
            // something went wrong!
            // probably you should return the reason to the user
            var_dump($e->getMessage());
            die;
        }
    }


}