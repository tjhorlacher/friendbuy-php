<?php

namespace jamesvweston\FriendBuy\Models\Responses;


use jamesvweston\FriendBuy\Models\SimpleSerialize;
use jamesvweston\Utilities\ArrayUtil AS AU;

class Conversion implements \JsonSerializable
{

    use SimpleSerialize;


    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @var string
     */
    protected $detail_uri;

    /**
     * @var bool
     */
    protected $possible_self_referral;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var Campaign
     */
    protected $campaign;

    /**
     * @var Fraud
     */
    protected $fraud;

    /**
     * @var Purchase
     */
    protected $purchase;

    /**
     * @var Reward[]
     */
    protected $rewards;

    /**
     * @var Referrer
     */
    protected $referrer;

    /**
     * @var Share
     */
    protected $share;


    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->id                       = AU::get($data['id']);
        $this->created_at               = AU::get($data['created_at']);
        $this->detail_uri               = AU::get($data['detail_uri']);
        $this->possible_self_referral   = AU::get($data['possible_self_referral']);
        $this->status                   = AU::get($data['status']);
        $this->campaign                 = new Campaign(AU::get($data['campaign']));
        $this->fraud                    = new Fraud(AU::get($data['fraud']));
        $this->purchase                 = new Purchase(AU::get($data['purchase']));

        $this->rewards                  = [];
        if (is_array(AU::isArrays($data['rewards'])))
        {
            $rewardsResponse            = AU::get($data['status']);
            foreach ($rewardsResponse AS $reward)
                $this->rewards[]        = new Reward($reward);
        }

        $this->referrer                 = new Referrer(AU::get($data['referrer']));
        $this->share                    = new Share(AU::get($data['share']));
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $object                         = $this->simpleSerialize();
        $object['campaign']             = $this->campaign->jsonSerialize();
        $object['fraud']                = $this->fraud->jsonSerialize();
        $object['purchase']             = $this->purchase->jsonSerialize();

        $object['rewards']              = [];
        foreach ($this->rewards AS $reward)
            $object['rewards'][]        = $reward->jsonSerialize();

        $object['referrer']             = $this->referrer->jsonSerialize();
        $object['share']                = $this->share->jsonSerialize();

        return $object;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getDetailUri()
    {
        return $this->detail_uri;
    }

    /**
     * @return bool
     */
    public function isPossibleSelfReferral()
    {
        return $this->possible_self_referral;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @return Fraud
     */
    public function getFraud()
    {
        return $this->fraud;
    }

    /**
     * @return Purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * @return Reward[]
     */
    public function getRewards()
    {
        return $this->rewards;
    }

    /**
     * @return Referrer
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * @return Share
     */
    public function getShare()
    {
        return $this->share;
    }
}