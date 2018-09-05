<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Services\FileService;
use App\Services\EmailTemplateService;

class EmailTemplateController extends Controller
{
    /** @var EmailTemplateService */
    private $emailTemplateService;

    public function __construct(EmailTemplateService $emailTemplateService)
    {
        $this->emailTemplateService = $emailTemplateService;
    }

    public function getAllTemplates()
    {
        try {
            $templates = $this->emailTemplateService->getAll();
            return response($templates, 200);
        } catch (\Exception $exception) {
            return response(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    public function updateTemplate(Request $request)
    {
        try {
            $template = json_decode($request->template);
            $logo = $request->file('file');
            $this->emailTemplateService->update($template, $logo);
            return response(['success' => true, 'message' => 'Template ' . $template->name. ' update successfully.' ], 200);
        } catch (\Exception $exception) {
            return response(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }
}
