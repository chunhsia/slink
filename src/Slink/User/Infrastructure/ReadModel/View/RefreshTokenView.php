<?php

declare(strict_types=1);

namespace Slink\User\Infrastructure\ReadModel\View;

use Slink\Shared\Infrastructure\Persistence\ReadModel\AbstractView;
use Doctrine\ORM\Mapping as ORM;
use Slink\User\Infrastructure\ReadModel\Repository\RefreshTokenRepository;

#[ORM\Table(name: 'refresh_token')]
#[ORM\Entity(repositoryClass: RefreshTokenRepository::class)]
final class RefreshTokenView extends AbstractView {
  
  /**
   * @param string $userUuid
   * @param string $token
   * @param \DateTimeImmutable $expiresAt
   */
  public function __construct(
    #[ORM\Column(type: 'uuid')]
    private string $userUuid,
    
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $token,
    
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $expiresAt,
  ) {
  }
  
  /**
   * @throws \Exception
   */
  #[\Override]
  public static function deserialize(array $payload): static {
    return new self(
      $payload['userId'],
      $payload['hashedRefreshToken'],
      new \DateTimeImmutable($payload['expiresAt']),
    );
  }
  
  /**
   * @return string
   */
  public function getUserUuid(): string {
    return $this->userUuid;
  }
  
  /**
   * @return string
   */
  public function getToken(): string {
    return $this->token;
  }
  
  /**
   * @return \DateTimeImmutable
   */
  public function getExpiresAt(): \DateTimeImmutable {
    return $this->expiresAt;
  }
}