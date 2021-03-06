<?php

namespace jamesvweston\FriendBuy\Models\Responses;


use jamesvweston\FriendBuy\Models\SimpleSerialize;
use jamesvweston\Utilities\ArrayUtil AS AU;

class Referrer implements \JsonSerializable
{


    use SimpleSerialize;


    /**
     * @var string
     */
    protected $email;

    /**
     * @var int
     */
    protected $facebook_friends_count;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $twitter_followers_count;

    /**
     * @var Customer|null
     */
    protected $customer;


    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->email                    = AU::get($data['email']);
        $this->facebook_friends_count   = AU::get($data['facebook_friends_count']);
        $this->name                     = AU::get($data['name']);
        $this->twitter_followers_count  = AU::get($data['twitter_followers_count']);

        $this->customer                 = AU::get($data['customer']);
        if (!is_null($this->customer))
            $this->customer             = new Customer($this->customer);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $object                         = $this->simpleSerialize();
        $object['customer']             = is_null($this->customer) ? null : $this->customer->jsonSerialize();

        return $object;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getFacebookFriendsCount()
    {
        return $this->facebook_friends_count;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getTwitterFollowersCount()
    {
        return $this->twitter_followers_count;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

}