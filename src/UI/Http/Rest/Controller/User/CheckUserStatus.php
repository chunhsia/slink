<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller\User;

use Slink\Shared\Application\Query\QueryTrait;
use Slink\User\Application\Query\User\FindUserById\FindUserByIdQuery;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use UI\Http\Rest\Response\ApiResponse;

#[AsController]
#[Route(path: '/user/{id}/status', name: 'check_user_status', methods: ['GET'])]
final class CheckUserStatus {
  use QueryTrait;
  
  public function __invoke(string $id): ApiResponse {
    $user = $this->ask(new FindUserByIdQuery($id, groups: ['status_check']));
    
    return ApiResponse::one($user);
  }
}