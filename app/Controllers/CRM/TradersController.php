<?php
namespace App\Http\Controllers\CRM;

use App\Entities\Trader;
use App\Repositories\TraderRepository;
use Doctrine\ORM\EntityManager;

class TradersController extends Controller
{

    /** @var TraderRepository */
    protected $traderRepository;

    public function __construct(EntityManager $em)
    {
        $this->traderRepository = $em->getRepository(Trader::class);
    }

    public function getTraders()
    {
        try {
            return $this->traderRepository->all();
        } catch (\Exception $exception) {
            return response(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    public function getTrader($id)
    {
        try {
            $trader = $this->traderRepository->getTrader(null, $id);
            return view('crm.pages.trader', compact('trader'));
        } catch (\Exception $exception) {
            return response(['success' => false, 'message' => $exception->getMessage()], $exception->getCode());
        }
    }
}