<?php
/**
 * Orchestra.io interacts with many services. This is the MongoHQ
 * library to interact with the MongoHQ APIs
 *
 * @copyright     Copyright 2011 — Orchestra Platform Ltd. <info@orchestra.io>
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
namespace orchestra\services;

/**
 * This requires http://pecl.php.net/pecl_http
 *
 * @link http://pecl.php.net/pecl_http
 * @link http://php.net/http
 */
use \HttpRequest;

/**
 * Interact with the MongoHQ API to
 * create, and delete MongoDB instances.
 *
 * This package uses the PECL http extension and connects
 * to the mongohq.com API. To pass your authentication information
 * simply instantiate the object with 2 parameters. The username
 * then the password:
 *
 * <code>
 *  $obj = new orchestra\services\Mongohq('user', 'pass');
 *  $obj->getAll();
 * </code>
 *
 */
class Mongohq
{
    /**
     * The MongoHQ API endpoint.
     *
     * @var string $endpoint The API endpoint.
     */
    protected $endpoint = 'https://mongohq.com';

    /**
     * A formatted string containing the authentication
     * information to authenticate to mongohq's API.
     *
     * @var string $auth The authentication string.
     */
    protected $auth;

    /**
     * The constructor
     *
     * This is the constructor of the object that accepets the
     * authentication information.
     *
     * @param string $user  The username to login with.
     * @param string $pass  The password to login with.
     */
    public function __construct($user, $pass)
    {
        $this->auth = sprintf("%s:%s", $user, $pass);
    }

    /**
     * Get all instances for the account.
     *
     * This method is used to retrieve all the instances
     * for the authenticated account.
     *
     * @throws \BadMethoCallException
     *
     * @param  double $method  The HTTP method to invoke. Default GET
     * @return object A json-decoded object of the instances.
     */
    public function getAll($method = HTTP_METH_GET)
    {
        throw new \BadMethodCallException('This method isn\'t implemented yet.');
    }

    /**
     * Get a single instance for the account.
     *
     * This method is used to retrieve a single instance
     * associated with the authenticated account.
     *
     * @throws \BadMethodCallException
     *
     * @param string $id  The identifier for the instance to retrieve.
     * @param  double $method  The HTTP method to invoke. Default GET
     *
     * @return object A json-decoded object of the instance.
     */
    public function get($id, $method = HTTP_METH_GET)
    {
        throw new \BadMethodCallException('This method isn\'t implemented yet.');
    }

    /**
     * Add an instance to your account.
     *
     * This is used to add new instances to your account. By default
     * we select the "free" instance which is the "nano" instance.
     *
     * @param  string $plan    The plan of the instance to add to your account.
     * @param  double $method  The HTTP method to invoke. Default POST
     *
     * @return object A json-decoded object of the instances.
     */
    public function add($data = array(), $method = HTTP_METH_POST)
    {
        $url = '/provider/resources';
        return $this->send($url, $method, $data);
    }

    /**
     * Update an instance with information.
     *
     * This method is used to update an instance with
     * the specified parameters.
     *
     * @throws \BadMethodCallException
     *
     * @param  string $id      The identifier for the instance to update.
     * @param  array  $data    A data container containing the field to update
     *                         on the authenticated instance.
     * @param  double $method  The HTTP method to invoke. Default PUT
     *
     * @return object A json-decoded object of the instances.
     */
    public function update($id, array $data = array(), $method = HTTP_METH_PUT)
    {
        throw new \BadMethodCallException('This method isn\'t implemented yet.');
    }

    /**
     * Delete an instance.
     *
     * This method is used to delete a certain instance
     * using its unique identifier.
     *
     * @param  string $id      The instance identifier to delete.
     * @param  double $method  The HTTP method to invoke. Default DELETE
     * @return object A json-decoded object of the instances.
     */
    public function delete($id, $method = HTTP_METH_DELETE)
    {
        $url = '/provider/resources/' . $id;
        return $this->send($url, $method);
    }

    /**
     * Send the request to the webservice.
     *
     * This method is used internally to make the requests
     * to the webservice.
     *
     * @throws \RuntimeException
     *
     * @param  string $url    The URL to request.
     * @param  string $method The method of the HTTP request.
     * @param  array  $data   The data to pass to the webservice.
     * @return object json-decoded object
     */
    protected function send($url, $method, array $data = array())
    {
        $http = new HttpRequest($this->endpoint . $url, $method);

        $http->setOptions(array(
            'httpauth'     => $this->auth,
            'httpauthtype' => HTTP_AUTH_BASIC
        ));

        if ($method == HTTP_METH_POST && !empty($data)) {
            $http->addPostFields($data);
        }

        $http->send();

        if ($http->getResponseCode() == 200) {
            $body = $http->getResponseBody();

            // On success the MongoHQ API returns invalid
            // JSON and the text only OK
            if ($body == 'OK') {
                return json_decode('"OK"');
            }

            return json_decode($http->getResponseBody());
        }

        throw new \RuntimeException(
            sprintf(
                "The request failed with HTTP response code %s",
                (string)$http->getResponseCode()
            )
        );
    }
}
