<?php

namespace jamesvweston\FriendBuy\Api;


use jamesvweston\FriendBuy\Models\Requests\GetConversions;
use jamesvweston\FriendBuy\Models\Responses\Conversion;
use jamesvweston\FriendBuy\Models\Responses\PaginatedResponses\PaginatedConversions;

class ConversionApi extends BaseApi
{


    protected $path = 'conversions';


    /**
     * @param   GetConversions|array       $request
     * @return  PaginatedConversions|array
     */
    public function index ($request = [])
    {
        $request                        = ($request instanceof GetConversions) ? $request->jsonSerialize() : $request;
        $response                       = parent::makeHttpRequest('get', $this->path, $request);
        return $this->config->isJsonOnly() ? $response : new PaginatedConversions($response);
    }

    /**
     * @param   int         $id
     * @return  Conversion|array
     */
    public function show ($id)
    {
        $response                       = parent::makeHttpRequest('get', $this->path . '/' . $id);
        return $this->config->isJsonOnly() ? $response : new Conversion($response);
    }

}