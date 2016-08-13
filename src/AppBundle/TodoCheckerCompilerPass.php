<?php

namespace AppBundle;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use \RuntimeException;

class TodoCheckerCompilerPass implements CompilerPassInterface
{
	/**
	 * Array of parameters that TodoCheckerCompilerPass will check for valid (i.e. non-null) values.
	 * Any of the following parameters that has no value will trigger a InvalidConfigurationException.
	 * You can remove any of the below to bypass the check for that parameter. Additionally, once you are sure
	 * that all variables are set properly, you can comment out the command
	 * "$container->addCompilerPass(new TodoCheckerCompilerPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION);"
	 * from the build() method in AppBundle.php.
	 */
	const PARAMETERS = array(
		"database_host_prod",
		"database_port_prod",
		"database_name_prod",
		"database_user_prod",
		"database_password_prod",
		"database_host_dev",
		"database_port_dev",
		"database_name_dev",
		"database_user_dev",
		"database_password_dev",
		"mailer_transport_prod",
		"mailer_host_prod",
		"mailer_port_prod",
		"mailer_encryption_prod",
		"mailer_auth_mode_prod",
		"mailer_user_prod",
		"mailer_password_prod",
		"mailer_transport_dev",
		"mailer_host_dev",
		"mailer_port_dev",
		"mailer_encryption_dev",
		"mailer_auth_mode_dev",
		"mailer_user_dev",
		"mailer_password_dev",
		"fos_user_from_email_address_prod",
		"fos_user_from_email_sender_name_prod",
		"fos_user_from_email_address_dev",
		"fos_user_from_email_sender_name_dev",
	);
	const SECRET = "secret";

	const DEFAULT_SECRET = 'ThisTokenIsNotSoSecretChangeIt';
	const SECRET_INVALID = '"secret" must be changed to something other than "%s"';
	const CONFIG_VALUE_NULL = 'The parameter "%s" cannot contain an empty value, but got null';

	public function process(ContainerBuilder $container)
	{
		foreach (TodoCheckerCompilerPass::PARAMETERS as $parameter) {
			$parameter_value = $container->getParameter($parameter);
			if ($parameter_value === null) {
				throw new InvalidConfigurationException(
					sprintf(TodoCheckerCompilerPass::CONFIG_VALUE_NULL, $parameter));
			}
		}

		$secret = $container->getParameter("secret");
		if ($secret === TodoCheckerCompilerPass::DEFAULT_SECRET) {
			throw new InvalidConfigurationException(sprintf(TodoCheckerCompilerPass::SECRET_INVALID, $secret));
		}
	}
}