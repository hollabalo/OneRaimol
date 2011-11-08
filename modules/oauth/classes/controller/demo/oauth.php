<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base demo class for OAuth provider modules.
 *
 * Depends on the [demo module](https://github.com/shadowhand/demo).
 *
 * @package    Kohana/OAuth
 * @category   Demo
 * @author     Kohana Team
 * @copyright  (c) 2011 Kohana Team
 * @license    http://kohanaframework.org/license
 * @since      3.1.3
 */
abstract class Controller_Demo_OAuth extends Controller_Demo {

	/**
	 * @var  object  OAuth_Provider
	 */
	protected $provider;

	/**
	 * @var  object  OAuth_Consumer
	 */
	protected $consumer;

	/**
	 * @var  object  OAuth_Token
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
		$this->provider = OAuth_Provider::factory($provider);

		// Load the consumer
		$this->consumer = OAuth_Consumer::factory(Kohana::config("oauth.{$provider}"));

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
		if ($verifier = Arr::get($_REQUEST, 'oauth_verifier'))
		{
			if ( ! $token = $this->session->get($this->key('request')) OR $token->token !== Arr::get($_REQUEST, 'oauth_token'))
			{
				// Token is invalid
				$this->session->delete($this->key('request'));

				// Restart the login process
				$this->request->redirect($this->request->uri);
			}

			// Store the verifier in the token
			$token->verifier($verifier);

			// Exchange the request token for an access token
			$token = $this->provider->access_token($this->consumer, $token);

			// Store the access token
			$this->session->set($this->key('access'), $token);

			// Request token is no longer needed
			$this->session->delete($this->key('request'));

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
			$this->consumer->callback($callback);

			// Get a request token for the consumer
			$token = $this->provider->request_token($this->consumer);

			// Get the login URL from the provider
			$url = $this->provider->authorize_url($token);

			// Store the token
			$this->session->set($this->key('request'), $token);

			// Redirect to the twitter login page
			$this->content = HTML::anchor($url, "Login to {$this->api}");
		}
	}

	public function demo_logout()
	{
		if (Arr::get($_GET, 'confirm'))
		{
			// Delete the access token
			$this->session->delete($this->key('request'), $this->key('access'));

			// Redirect to the demo list
			$this->request->redirect($this->request->uri(array('action' => FALSE, 'id' => FALSE)));
		}

		$this->content = HTML::anchor("{$this->request->uri}?confirm=yes", "Logout of {$this->api}");
	}

} // End Demo
