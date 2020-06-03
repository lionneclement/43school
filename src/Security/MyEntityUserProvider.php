<?php

namespace App\Security;

use App\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\EntityUserProvider;

class MyEntityUserProvider extends EntityUserProvider {

    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {   
        $resourceOwnerName = $response->getResourceOwner()->getName();

        if (!isset($this->properties[$resourceOwnerName])) {
            throw new \RuntimeException(sprintf("No property defined for entity for resource owner '%s'.", $resourceOwnerName));
        }

        $serviceName = $response->getResourceOwner()->getName();
        $setterId = 'set'. ucfirst($serviceName) . 'ID';
        $setterAccessToken = 'set'. ucfirst($serviceName) . 'AccessToken';

        // unique integer
        $username = $response->getUsername();

        $user = $this->findUser(['email' => $response->getEmail()]);
        
        if (null === $this->findUser([$this->properties[$resourceOwnerName] => $username])) {
            if (null === $user) {
                $user = new User();
            }
            $user->setLastName($response->getLastname());
            $user->setFirstName($response->getFirstname());
            $user->setEmail($response->getEmail());

            $user->$setterId($username);
            $user->$setterAccessToken($response->getAccessToken());
        }
        
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}