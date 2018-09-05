<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Entities\EmailAction;
use App\Repositories\EmailActionRepository;
use Doctrine\ORM\EntityManager;

class EmailActionController extends Controller
{
    /** @var EmailActionRepository */
    private $emailActionRepository;

    public function __construct(EntityManager $em)
    {
        $this->emailActionRepository = $em->getRepository(EmailAction::class);
    }
    
    public function getAllActions()
    {
        try {
            $actions = $this->emailActionRepository->getAll();
            return $actions;
        } catch (\Exception $exception) {
            return response(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    public function updateActions(Request $request)
    {
        $actions = $request->actions;

        try {
            $this->emailActionRepository->updateAll($actions);
            return response(['success' => true, 'message' => 'Events saved successfully'], 200);
        } catch (\Exception $exception) {
            return response(['success' => false, 'message' => $exception->getMessage()], 500);
        }

    }
}
