<?php

declare(strict_types=1);

namespace Petition\Service;

use Area\Model\AreaModel;
use Block\Model\BlockModel;
use Content\Model\ContentModel;
use Petition\Model\PetitionEmailQueueModel;

class EmailQueueService
{
    protected $tableEmailQueue;
    protected $tablePetitionTranslation;
    protected $current_language;

    public function __construct($emailQueue, $petitionTranslation, $petitionRecipientsGroup, $currentLanguage)
    {
        $this->tableEmailQueue = $emailQueue;
        $this->tablePetitionTranslation = $petitionTranslation;
        $this->petitionRecipientsGroup = $petitionRecipientsGroup;
        $this->current_language = $currentLanguage;
    }

    public function saveGroupQueue($data)
    {
        $petitionUid = "petition-002";

//        $translation = $this->tablePetitionTranslation->fetchBy(['petition_uid'=>$petitionUid,'language'=>$this->current_language]);
        $translation = $this->tablePetitionTranslation->fetchBy(['petition_uid'=>$petitionUid,'language'=>'fr_fr']);

        $recipientsGroup = $this->petitionRecipientsGroup->fetchBy(['petition_translation_uid'=>$translation->getUid()]);

        $petitionEmailQueueModel = new PetitionEmailQueueModel();

        $petitionEmailQueueModel->setPetitionUid($translation->getPetitionUid())
            ->setPetitionTranslationUid($translation->getUid())
            ->setPetitionLanguage($this->current_language)
            ->setRecipientsGroupUid($recipientsGroup->getRecipientGroupUid())
            ->setStatus(0)
        ;

        return $this->tableEmailQueue->saveItem($petitionEmailQueueModel);

    }


}