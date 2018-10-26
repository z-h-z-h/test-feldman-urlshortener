<?php

namespace App\Http\Services;


use App\Link;
use Carbon\Carbon;

class LinkService
{
    /**
     * @var Link
     */
    private $link;

    /**
     * LinkService constructor.
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->link = $link;
    }


    /**
     * @param array $data
     * @return int
     */
    public function handle(array $data)
    {
        if (empty($data['minutes'])) {
            $data['expired_at'] = Carbon::now()->addMinutes($data['minutes'])->toDateTimeString();
        }

        $data['short'] = !empty($data['short']) ? $data['short'] : $this->generateShortLink();

        $link = $this->link->create($data);

        return $link->short;

    }

    public function checkAvailability($short)
    {
        return !$this->link->whereShort($short)->exists();
    }

    public function generateShortLink()
    {
        $short = str_random(5);

        if ($this->checkAvailability($short)) {
            return $short;
        } else {
            return $this->generateShortLink();
        }
    }
}
