<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class ProcessEmailQueueHandler implements RequestHandlerInterface
{
    private $containerName;

    private $router;

    private $template;

    private $tableEmailQueue;
    private $tablePetitionRecipientsGroup;
    private $tableRecipientsGroups;
    private $tableRecipients;
    private $tableRecipientsGroupAssign;
    private $tablePetitionTranslate;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        $emailQueue,
        $petitionRecipientsGroup,
        $recipientsGroups,
        $recipients,
        $recipientsGroupAssign,
        $petitionTranslate
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->tableEmailQueue = $emailQueue;
        $this->tablePetitionRecipientsGroup = $petitionRecipientsGroup;
        $this->tableRecipientsGroups = $recipientsGroups;
        $this->tableRecipients = $recipients;
        $this->tableRecipientsGroupAssign = $recipientsGroupAssign;
        $this->tablePetitionTranslate = $petitionTranslate;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        if (! $this->template) {
            return new JsonResponse([
                'welcome' => 'Congratulations! You have installed the zend-expressive skeleton application.',
                'docsUrl' => 'https://docs.zendframework.com/zend-expressive/',
            ]);
        }

        $emailGroupQueue = $this->tableEmailQueue->fetchAllBy(['status'=>0]);

//        $emailGroupQueue = $this->tablePetitionRecipientsGroup->fetchAll(['status'=>0]);

        $emailsSent = 0;

        if($emailGroupQueue->count()>0) {
            // get emails from group
            foreach($emailGroupQueue as $emailQueueRequest) {
                // get recipients by group
                $assignedRecipients = $this->tableRecipientsGroupAssign->fetchAllBy(['group_uid'=>$emailQueueRequest->getRecipientsGroupUid()]);

                // get petition translation text
                $translation = $this->tablePetitionTranslate->fetchBy(['uid'=>$emailQueueRequest->getPetitionTranslationUid()]);

                $petitionText = $translation->getText();
var_dump($assignedRecipients->count());
                if($assignedRecipients->count()>0) {
                    foreach($assignedRecipients as $assignedRecipient) {
                        $r = $this->tableRecipients->fetchBy(['uid'=>$assignedRecipient->getRecipientUid()]);
                        $headers = 'From: info@art13.eu' . "\r\n" .
                            'Reply-To: info@art13.eu' . "\r\n"
                            ;

                        mail($r->getEmail(),"Petition",$petitionText,$headers);
                    }

                    mail('jan@secalith.co.uk',sprintf("Peticio: Sent %d emails.",$assignedRecipients->count()),$petitionText,$headers);

                    // update queue entry
                    $re = $this->tableEmailQueue->updateStatus(1,['uid'=>$emailQueueRequest->getUid()]);

                    var_dump($re);

                }

            }
        }

        if($emailsSent>0) {
            mail('art13.krakow@gmail.com',sprintf("Peticio: Sent %d emails.",$assignedRecipients->count()),sprintf("Sent %d emails.",$assignedRecipients->count()),$headers);
            mail('jan@secalith.co.uk',sprintf("Peticio: Sent %d emails.",$assignedRecipients->count()),sprintf("Sent %d emails.",$assignedRecipients->count()),$headers);
            mail('info+spam@art13.eu',sprintf("Peticio: Sent %d emails.",$assignedRecipients->count()),sprintf("Sent %d emails.",$assignedRecipients->count()),$headers);

        }

        echo $emailGroupQueue->count();
        die();

        $data = [];



        return new HtmlResponse($this->template->render('app::email-process', $data));
    }
}
