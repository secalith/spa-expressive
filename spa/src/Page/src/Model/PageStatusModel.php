<?php

declare(strict_types=1);

namespace Page\Model;

use Common\Model\CommonModelInterface;

class PageStatusModel implements CommonModelInterface
{

    const STATUS_DEFAULT = 'default';
    const STATUS_NEW = 0;
    const STATUS_REMOVED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_ENABLED = 3;
    const STATUS_ARCHIVED = 4;

    const STATUS_NEW_NOT_SPECIFIED_LABEL = "Unspecified";
    const STATUS_NEW_LABEL = "New";
    const STATUS_REMOVED_LABEL = "Removed";
    const STATUS_DISABLED_LABEL = "Disabled";
    const STATUS_ENABLED_LABEL = "Enabled";
    const STATUS_ARCHIVED_LABEL = "Archived";

    const STATUS_PATHS = [
        self::STATUS_DEFAULT => self::STATUS_NEW,
        self::STATUS_NEW => [
            self::STATUS_DISABLED,
            self::STATUS_ENABLED,
        ],
        self::STATUS_DISABLED => [
            self::STATUS_REMOVED,
            self::STATUS_ARCHIVED,
            self::STATUS_ENABLED,
        ],
        self::STATUS_ENABLED => [
            self::STATUS_REMOVED,
            self::STATUS_ARCHIVED,
            self::STATUS_DISABLED,
        ],
        self::STATUS_REMOVED => [
            self::STATUS_DISABLED,
            self::STATUS_ARCHIVED,
        ],
        self::STATUS_ARCHIVED => [
            self::STATUS_DISABLED,
            self::STATUS_REMOVED,
        ],
    ];

    public static function getStatusAll($include_default = false)
    {
        // Inlcude default option if permitted:
        $statuses=($include_default!==false&&$include_default!==null)?['default'=>self::STATUS_NEW_NOT_SPECIFIED_LABEL]:[];

        $statuses[self::STATUS_NEW] = self::STATUS_NEW_LABEL;
        $statuses[self::STATUS_REMOVED] = self::STATUS_REMOVED_LABEL;
        $statuses[self::STATUS_DISABLED] = self::STATUS_DISABLED_LABEL;
        $statuses[self::STATUS_ENABLED] = self::STATUS_ENABLED_LABEL;
        $statuses[self::STATUS_ARCHIVED] = self::STATUS_ARCHIVED_LABEL;

        return $statuses;
    }

    /**
     * Returns (bool)false if status is invalid.
     *
     * @param $status
     * @return bool
     */
    public function getStatusAvailable($status=self::STATUS_DEFAULT)
    {
        $status = is_numeric($status)?(int)$status:$status;
        if( ! array_key_exists($status,self::STATUS_PATHS)) {
            return false;
        } else {
            $statusAll = $this->getStatusAll(false);
            $status = ($status===self::STATUS_DEFAULT)?self::STATUS_PATHS[self::STATUS_DEFAULT]:$status;
            $statusAvailable = self::STATUS_PATHS[$status];

            return $statusAvailable;
        }
    }

    public function getStatusAvailableWithLabels($status=self::STATUS_DEFAULT,$preserveDefault=false)
    {
        $output = [];
        if( ! $preserveDefault && ! is_numeric($status)) {

        } else {
            $status = (int) $status;
        }
        $statusAvailable = $this->getStatusAvailable($status);
        $statusAllWithLabels = self::getStatusAll();
        foreach($statusAvailable as $statusCode) {
            $output[(int)$statusCode] = $statusAllWithLabels[$statusCode];
        }

        return $output;
    }

    public static function getStatusCurrentWithLabel($status=self::STATUS_DEFAULT)
    {
        $stockPaths = (is_string(self::STATUS_PATHS[$status]))
            ? self::STATUS_PATHS[self::STATUS_PATHS[$status]]
            : self::STATUS_PATHS[$status]
        ;


        $statusAll = self::getStatusAll(true);

        return [$status=>$statusAll[$status]];

        $status = ( ! is_numeric($status)&&in_array($status,$stockPaths))
            ?(int) key($stockPaths)
            :(int) $status;
//        if( ! in_array($status,$stockPaths)) {
//            return false;
//        }

        $statusAll = self::getStatusAll(false);

        $status = ($status===self::STOCK_STATUS_DEFAULT)?$stockPaths[self::STOCK_STATUS_DEFAULT]:$status;

        return [$status=>$statusAll[$status]];
    }

    public $product_uid;
    public $stock_uid;
    public $status_code;
    public $updated;
    public $created;

    /**
     * CartModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (! empty($data)) {
            $this->exchangeArray($data);
        }
    }

    /**
     * Populates the Object with data from the provided Array
     *
     * @param array $data
     * @return CartModel
     */
    public function exchangeArray(array $data = [])
    {
        $this->product_uid = (!empty($data['product_uid'])) ? $data['product_uid'] : null;
        $this->stock_uid = (!empty($data['stock_uid'])) ? $data['stock_uid'] : null;
        $this->status_code = ( ! empty($data['status_code']) || is_numeric($data['status_code'])) ? $data['status_code'] : null;
        $this->updated = (!empty($data['updated'])) ? $data['updated'] : null;
        $this->created = (!empty($data['created'])) ? $data['created'] : null;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if ($this->product_uid !== null) {
            $data['product_uid'] = $this->product_uid;
        }
        if ($this->stock_uid !== null) {
            $data['stock_uid'] = $this->stock_uid;
        }
        if ($this->status_code !== null) {
            $data['status_code'] = $this->status_code;
        }
        if ($this->updated !== null) {
            $data['updated'] = $this->updated;
        }
        if ($this->created !== null) {
            $data['created'] = $this->created;
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getProductUid()
    {
        return $this->product_uid;
    }

    /**
     * @param mixed $product_uid
     * @return StockBarcodeModel
     */
    public function setProductUid($product_uid)
    {
        $this->product_uid = $product_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStockUid()
    {
        return $this->stock_uid;
    }

    /**
     * @param mixed $stock_uid
     * @return StockStatusModel
     */
    public function setStockUid($stock_uid)
    {
        $this->stock_uid = $stock_uid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param mixed $status_code
     * @return StockStatusModel
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     * @return StockBarcodeModel
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return StockBarcodeModel
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

}
