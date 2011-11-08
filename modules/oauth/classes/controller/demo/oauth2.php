<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base demo class for OAuth provider modules.
 *
 * Depends on the [demo module](https://github.com/shadowhand/demo).
 *
 * @package    Kohana/OAuth2
 * @category   Demo
 * @author     Kohana Team
 * @copyright  (c) 2011 Kohana Team
 * @license    http://kohanaframework.org/license
 * @since      3.1.3
 */
abstract class Controller_Demo_OAuth2 extends Controller_Demo {

	/**
	 * @var  object  OAuth2_Provider
	 */
	protected $provider;

	/**
	 * @var  object  OAuth2_Client
	 */
	protected $client;

	/**
	 * @var  object  OAuth2_Token
	 */
	protected $token;

	public function before()
	{
		parent::before();

		// Load the cookie session
		$this->session = Session::instance('cookie');

		// Get the name of the demo from the class name
		$provider = strtolower($this->api);

		// Load the provider
		$this->provider = OAuth2_Provider::factory($provider);

		// Load the client
		$this->client = OAuth2_Client::factory(Kohana::config("oauth.{$provider}"));

		if ($token = $this->session->get($this->key('access')))
		{
			// Make the access token available
			$this->token = $token;
		}
	}

	public function key($name)
	{
		return "demo_{$this->provider->name}_{$name}";
	}

	public function demo_login()
	{
		// Attempt to complete signin
		if ($code = Arr::get($_REQUEST, 'code'))
		{
			// Exchange the authorization code for an access token
			$token = $this->provider->access_token($this->client, $code);

			// Store the access token
			$this->session->set($this->key('access'), $token);

			// Refresh the page to prevent errors
			$this->request->redirect($this->request->uri);
		}

		if ($this->token)
		{
			// Login succesful
			$this->content = Kohana::debug('Access token granted:', $this->token);
		}
		else
		{
			// We will need a callback URL for the user to return to
			$callback = $this->request->url(NULL, TRUE);

			// Add the callback URL to the consumer
			$this->client->callback($callback);

			// Get the login URL from the provider
			$url = $this->provider->authorize_url($this->client);

			// Redirect to the twitter login page
			$this->content = HTML::anchor($url, "Login to {$this->api}");
		}
	}

	public function demo_logout()
	{
		if (Arr::get($_GET, 'confirm'))
		{
			// Delete the access token
			$this->session->delete($this->key('access'));

			// Redirect to the demo list
			$this->request->redirect($this->request->uri(array('action' => FALSE, 'id' => FALSE)));
		}

		$this->content = HTML::anchor("{$this->request->uri}?confirm=yes", "Logout of {$this->api}");
	}

} // End Demo
