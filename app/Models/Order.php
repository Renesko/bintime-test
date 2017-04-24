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
            'created_at' => $this->getElasticDate($this->created_at),
            'total' => $this->getTotal(),
        ];
    }

    private function getElasticDate($date)
    {
        if (isset($date)) {
            $d = Carbon::createFromFormat('Y-m-d', $date);
            return $d->format('Y-m-d');
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
