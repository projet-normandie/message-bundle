<?php

namespace ProjetNormandie\MessageBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use ProjetNormandie\MessageBundle\Repository\MessageRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Index(name: "idx_inbox", columns: ["recipient_id", 'is_deleted_recipient'])]
#[ORM\Index(name: "idx_outbox", columns: ["sender_id", 'is_deleted_sender'])]
#[ORM\Index(name: "idx_newMessage", columns: ["recipient_id", 'is_opened'])]
#[ORM\Index(name: "idx_type", columns: ["recipient_id", "type"])]
#[ORM\Index(name: "idx_object", columns: ["recipient_id", "object"])]
#[ORM\Table(name:'pnm_message')]
#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ORM\EntityListeners(["ProjetNormandie\MessageBundle\EventListener\Entity\MessageListener"])]
#[ApiResource(
    order: ['id' => 'DESC'],
    operations: [
        new GetCollection(
            security: 'is_granted("ROLE_USER")',
            paginationItemsPerPage: 10
        ),
        new Get(
            security: 'is_granted("ROLE_USER") and (object.getSender() == user or object.getRecipient() == user)'
        ),
        new Post(
            denormalizationContext: ['groups' => ['message:insert']],
            security: 'is_granted("ROLE_USER")'
        ),
        new Put(
            denormalizationContext: ['groups' => ['message:update']],
            security: 'is_granted("ROLE_USER") and (object.getSender() == user or object.getRecipient() == user)'
        )
    ],
    normalizationContext: ['groups' => ['message:read', 'user:read','message:recipient', 'message:sender']]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'sender' => 'exact',
        'recipient' => 'exact',
        'type' => 'exact',
        'object' => 'partial'
    ]
)]
#[ApiFilter(BooleanFilter::class, properties: ['isDeletedSender', 'isDeletedRecipient', 'isOpened'])]
class Message
{
    use TimestampableEntity;

    #[Groups(['message:read', 'message:update'])]
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[Groups(['message:read', 'message:insert'])]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255, nullable: false)]
    private ?string $object;

    #[Groups(['message:read', 'message:insert'])]
    #[ORM\Column(type:'text', nullable: true)]
    private ?string $message;

    #[Groups(['message:read'])]
    #[Assert\Length(max: 50)]
    #[ORM\Column(length: 50, nullable: false, options: ['default' => 'DEFAULT'])]
    private ?string $type = 'DEFAULT';

    #[Groups(['message:read'])]
    #[ORM\ManyToOne(targetEntity: UserInterface::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name:'sender_id', referencedColumnName:'id', nullable:false)]
    private $sender;

    #[Groups(['message:read', 'message:insert'])]
    #[ORM\ManyToOne(targetEntity: UserInterface::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name:'recipient_id', referencedColumnName:'id', nullable:false)]
    private $recipient;

    #[Groups(['message:read', 'message:update'])]
    #[ORM\Column(nullable: false, options: ['default' => false])]
    private bool $isOpened = false;

    #[Groups(['message:read', 'message:update'])]
    #[ORM\Column(nullable: false, options: ['default' => false])]
    private bool $isDeletedSender = false;

    #[Groups(['message:read', 'message:update'])]
    #[ORM\Column(nullable: false, options: ['default' => false])]
    private bool $isDeletedRecipient = false;


    public function __toString()
    {
        return sprintf('Message [%s]', $this->id);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setObject(string $object): void
    {
        $this->object = $object;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function setSender($sender): void
    {
        $this->sender = $sender;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function setRecipient($recipient): void
    {
        $this->recipient = $recipient;
    }

    public function setIsOpened(bool $isOpened): void
    {
        $this->isOpened = $isOpened;
    }

    public function getIsOpened(): bool
    {
        return $this->isOpened;
    }

    public function setIsDeletedSender(bool $isDeletedSender): void
    {
        $this->isDeletedSender = $isDeletedSender;
    }

    public function getIsDeletedSender(): bool
    {
        return $this->isDeletedSender;
    }

    public function setIsDeletedRecipient(bool $isDeletedRecipient): void
    {
        $this->isDeletedRecipient = $isDeletedRecipient;
    }

    public function getIsDeletedRecipient(): bool
    {
        return $this->isDeletedRecipient;
    }
}
