<?php

namespace App\Services;

use App\Repositories\EmailTemplateRepository;
use Doctrine\ORM\EntityManager;
use App\Entities\EmailTemplate;

class EmailTemplateService
{
    /** @var EmailTemplateRepository */
    private $emailTemplateRepository;

    /** @var FileService */
    private $fileService;

    private $path;

    public function __construct(EntityManager $em, FileService $fileService)
    {
        $this->emailTemplateRepository = $em->getRepository(EmailTemplate::class);
        $this->fileService = $fileService;
        $this->path = config('mail.images_folder');
    }

    public function getAll()
    {
        return $this->emailTemplateRepository->getAll();
    }

    public function update($data, $logo = null)
    {
        $template = $this->emailTemplateRepository->findById($data->id);

        $template->setHeaderImage($this->uploadLogo($logo, $data->headerImage));
        $template->setHeaderTitle($data->headerTitle);
        $template->setContent($data->content);
        $template->setFooter($data->footer);

        $this->emailTemplateRepository->save($template);
    }

    private function uploadLogo($logo, $oldLogo)
    {
        if (!$logo) {
            return $oldLogo;
        }

        $newLogo = $this->fileService->upload($logo, $this->path, true);

        if ($oldLogo && $newLogo) {
            $this->fileService->delete($this->path . '/' . $oldLogo);
        }
        return $newLogo;
    }
}
