<?php

declare(strict_types=1);

namespace Event\View\Helper;

use Zend\View\Helper\AbstractHelper;

class BlockListHelper extends AbstractHelper
{
    protected $language;
    /**
     * maybe 'country' or 'all'
     *
     */
    protected $mode;

    protected $dataServices;

    protected $i18nService;

    public function __construct($dataServices, $i18nService)
    {
        $this->dataServices = $dataServices;
        $this->language = $i18nService->getCurrentLanguage();
        $this->i18nService = $i18nService;
    }

    public function __invoke($item,$mode = 'all')
    {

        $output = '';

        $events = $this->getEventsByCountry();

        foreach($events->getItems() as $event) {
            if(array_key_exists('details',$event) && is_object($event['details'])) {
                $partial = $this->getView()->plugin('partial')('event::event-list-item',$event);
                $output .= $partial;
            }
        }

        return $output;
    }

    public function getEventsByCountry($country='all')
    {
        $events=[];
        $where = ['status'=>1];
        $whereDetails = ['status'=>1];

        if( $country !== 'all' ) {
            $where['language'] = $country;
        }

        $eventsList = $this->dataServices->getItem('Event\TableService')->fetchAllBy($where);

        if( ! empty($eventsList)) {
            foreach($eventsList as $event) {

                $events[$event->getUid()]['event'] = $event;

                $whereEventDetails = array_merge($whereDetails,['event_uid'=>$event->getUid()]);
                $events[$event->getUid()]['details'] = $this->dataServices->getItem('Event\Details\TableService')->fetchAllBy($whereEventDetails);;
//                $eventsDetails[$event->getUid()] = $this->dataServices->getItem('Event\Details\TableService')->fetchAllBy($where);
//                $eventsDetails[$event->getUid()] = $this->dataServices->getItem('Event\Details\TableService')->fetchAllBy($where);
            }
        }

        $events = new \Common\Model\CommonCollection($events);

        return $events;
    }
}
