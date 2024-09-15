<?php

declare(strict_types=1);

namespace App\Modules\Approval\Api;

use App\Modules\Approval\Api\Dto\ApprovalDto;
use LogicException;

interface ApprovalFacadeInterface
{
    /**
     * @throws LogicException
     */
    public function approve(ApprovalDto $dto): true;

    /**
     * @throws LogicException
     */
    public function reject(ApprovalDto $dto): true;
}
