<?php

namespace Tests\Unit\Modules\Approval\Application;

use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Approval\Api\Events\EntityApproved;
use App\Modules\Approval\Api\Events\EntityRejected;
use App\Modules\Approval\Application\ApprovalFacade;
use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Domain\Invoice;
use Illuminate\Contracts\Events\Dispatcher;
use LogicException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ApprovalFacadeTest extends TestCase
{
    private ApprovalFacade $approvalFacade;
    private Dispatcher $dispatcher;

    protected function setUp(): void
    {
        $this->dispatcher = $this->createMock(Dispatcher::class);
        $this->approvalFacade = new ApprovalFacade($this->dispatcher);
    }

    public function testApproveDispatchesEntityApprovedEvent(): void
    {
        $dto = new ApprovalDto(Uuid::uuid4(),StatusEnum::DRAFT, Invoice::class);

        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf(EntityApproved::class));

        $this->approvalFacade->approve($dto);
    }

    public function testRejectDispatchesEntityRejectedEvent(): void
    {
        $dto = new ApprovalDto(Uuid::uuid4(),StatusEnum::DRAFT, Invoice::class);

        $this->dispatcher->expects($this->once())
            ->method('dispatch')
            ->with($this->isInstanceOf(EntityRejected::class));

        $this->approvalFacade->reject($dto);
    }

    public function testApproveThrowsExceptionWhenStatusIsNotDraft(): void
    {
        $dto = new ApprovalDto(Uuid::uuid4(),StatusEnum::APPROVED, Invoice::class);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('approval status is already assigned');

        $this->approvalFacade->approve($dto);
    }

    public function testRejectThrowsExceptionWhenStatusIsNotDraft(): void
    {
        $dto = new ApprovalDto(Uuid::uuid4(),StatusEnum::REJECTED, Invoice::class);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('approval status is already assigned');

        $this->approvalFacade->reject($dto);
    }
}
