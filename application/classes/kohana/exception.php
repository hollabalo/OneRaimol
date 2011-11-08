<?php defined('SYSPATH') or die('No direct script access.');
// Friendly Error Pages : Kohana Docs
class Kohana_Exception extends Kohana_Kohana_Exception {

	public static function handler(Exception $e) {
            if (Kohana::$environment === Kohana::DEVELOPMENT) {
                // If we are in development, show us the stack trace/etc
                parent::handler($e);
            }
            else {
                try {
                        // Log the error
                        Kohana::$log->add(Log::ERROR, parent::text($e));

                        // If error code isn't specified, default to 500
                        $error_code = ($e instanceof HTTP_Exception) ? $e->getCode() : 500;

                        // Output the subrequest to the error page
                        echo Request::factory("error/{$error_code}")
                                ->execute()
                                ->send_headers()
                                ->body();
                }
                catch (Exception $e) {
                        // Clean the output buffer if one exists
                        ob_get_level() and ob_clean();

                        // Display the exception text
                        echo Kohana_Exception::text($e), "\n";

                        // Exit with an error status
                        exit(1);
                }
            }
	}
}
