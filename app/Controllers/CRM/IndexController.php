<?php
namespace App\Http\Controllers\CRM;

use App\Entities\Country;
use App\Entities\Trader;
use App\Repositories\CountryRepository;
use App\Repositories\TraderRepository;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IndexController extends Controller
{

    /** @var TraderRepository */
    protected $traderRepository;
    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(EntityManager $em)
    {
        $this->traderRepository = $em->getRepository(Trader::class);
        $this->countryRepository = $em->getRepository(Country::class);
    }

    public function dashboard()
    {
        return view('crm.pages.dashboard');
    }

    public function traders()
    {
        $countries = $this->countryRepository->getForSelect();
        return view('crm.pages.traders', compact('countries'));
    }

    public function emails()
    {
        return view('crm.pages.emails');
    }
}