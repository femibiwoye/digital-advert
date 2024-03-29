<?php

namespace api\paystack\Paystack\Routes;

use api\paystack\Paystack\Contracts\RouteInterface;

/**
 * Customer
 * Insert description here
 *
 * @category
 * @package
 * @author
 * @copyright
 * @license
 * @version
 * @link
 * @see
 * @since
 */
class Customer implements RouteInterface
{

    /**
      Root
     *
      @param=> first_name, last_name, email, phone
     */
    public static function root()
    {
        return '/customer';
    }

    /**
      Create customer
     *
      @param=> first_name, last_name, email, phone
     */
    public static function create()
    {
        return [
            RouteInterface::METHOD_KEY   => RouteInterface::POST_METHOD,
            RouteInterface::ENDPOINT_KEY => Customer::root(),
            RouteInterface::PARAMS_KEY   => ['first_name',
                'last_name',
                'email',
                'metadata',
                'phone' ],
            RouteInterface::REQUIRED_KEY => [
                RouteInterface::PARAMS_KEY => ['first_name',
                    'last_name',
                    'email' ]
            ]
        ];
    }

    /**
      Get customer by ID or code
     */
    public static function fetch()
    {
        return [
            RouteInterface::METHOD_KEY   => RouteInterface::GET_METHOD,
            RouteInterface::ENDPOINT_KEY => Customer::root() . '/{id}',
            RouteInterface::ARGS_KEY     => ['id' ],
            RouteInterface::REQUIRED_KEY => [RouteInterface::ARGS_KEY => ['id' ] ]
        ];
    }

    /**
      List customers
     */
    public static function getList()
    {
        return [
            RouteInterface::METHOD_KEY   => RouteInterface::GET_METHOD,
            RouteInterface::ENDPOINT_KEY => Customer::root(),
            RouteInterface::PARAMS_KEY   => ['perPage',
                'page' ]
        ];
    }

    /**
      Update customer
     *
      @param=> first_name, last_name, email, phone
     */
    public static function update()
    {
        return [
            RouteInterface::METHOD_KEY   => RouteInterface::PUT_METHOD,
            RouteInterface::ENDPOINT_KEY => Customer::root() . '/{id}',
            RouteInterface::PARAMS_KEY   => ['first_name',
                'last_name',
                'email',
                'metadata',
                'phone' ],
            RouteInterface::ARGS_KEY     => ['id' ]
        ];
    }
}
