<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EmailSettingRepository;
use Doctrine\ORM\EntityManager;
use App\Entities\EmailSetting;

class EmailSettingController extends Controller
{
    /** @var EmailSettingRepository */
    private $emailSettingRepository;

    public function __construct(EntityManager $em)
    {
        $this->emailSettingRepository = $em->getRepository(EmailSetting::class);
    }

    public function getAllSettings()
    {
        try {
            $settings = $this->emailSettingRepository->getAll();
            return $settings;
        } catch (\Exception $exception) {
            return response(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    public function updateSettings(Request $request)
    {
        $settings = $request->settings;

        try {
            $this->emailSettingRepository->updateAll($settings);
            return response(['success' => true, 'message' => 'Service saved successfully'], 200);
        } catch (\Exception $exception) {
            return response(['success' => false, 'message' => $exception->getMessage()], 500);
        }

    }
}
