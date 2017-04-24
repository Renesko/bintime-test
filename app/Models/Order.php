<?php

namespace App\Models;

use Carbon\Carbon;
use MongoModel;
use Sleimanx2\Plastic\Searchable;

/**
 * Class Order
 *
 * @mixin \Eloquent
 */

class Order extends MongoModel
{
    use Searchable;

    protected $guarded = ['id'];

    public function buildDocument()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'surname' => $this->surname,
            'email' => $this->email,
            'created_at' => $this->getElasticCreatedAt(),
            'total' => $this->getTotal(),
        ];
    }

    private function getElasticCreatedAt()
    {
        if (isset($this->created_at)) {
            return $this->created_at->format('Y-m-d');
        } else {
            return null;
        }
    }

    private function getTotal()
    {
        $total = 0;
        foreach ($this['line'] as $row) {
            $total = $total + $row['price'] * $row['count'];
        }

        return $total;
    }
}
