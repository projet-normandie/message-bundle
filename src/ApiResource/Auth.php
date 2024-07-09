<?php

declare(strict_types=1);

namespace ProjetNormandie\MessageBundle\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ProjetNormandie\MessageBundle\Controller\User\GetNbNewMessage;
use ProjetNormandie\MessageBundle\Controller\User\GetRecipients;
use ProjetNormandie\MessageBundle\Controller\User\GetSenders;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/messages/get-nb-new-message',
            controller: GetNbNewMessage::class,
            read: false,
            security: 'is_granted("ROLE_USER")'
        ),
        new Get(
            uriTemplate: '/messages/get-recipients',
            controller: GetRecipients::class,
            read: false,
            security: 'is_granted("ROLE_USER")'
        ),
        new Get(
            uriTemplate: '/messages/get-senders',
            controller: GetSenders::class,
            read: false,
            security: 'is_granted("ROLE_USER")'
        ),
    ],
)]

class Auth
{
}
