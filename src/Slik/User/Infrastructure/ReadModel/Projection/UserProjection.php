<?php

declare(strict_types=1);

namespace Slik\User\Infrastructure\ReadModel\Projection;

use Slik\Shared\Infrastructure\Persistence\ReadModel\AbstractProjection;
use Slik\User\Domain\Event\UserWasCreated;
use Slik\User\Domain\Repository\UserRepositoryInterface;
use Slik\User\Infrastructure\ReadModel\View\UserView;

final class UserProjection extends AbstractProjection {
  public function __construct(private readonly UserRepositoryInterface $repository) {
  }

  public function handleUserWasCreated(UserWasCreated $event): void {
    $user = UserView::fromEvent($event);

    $this->repository->add($user);
  }
}