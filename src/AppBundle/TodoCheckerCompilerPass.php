<?php

namespace AppBundle;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use \RuntimeException;

class TodoCheckerCompilerPass implements CompilerPassInterface
{
	const DEFAULT_SECRET = 'ThisTokenIsNotSoSecretChangeIt';
	const SECRET_INVALID = '"secret" must be changed to something other than "%s"';

	public function process(ContainerBuilder $container)
	{
		$secret = $container->getParameter("secret");
		if ($secret === TodoCheckerCompilerPass::DEFAULT_SECRET) {
			throw new RuntimeException(sprintf(TodoCheckerCompilerPass::SECRET_INVALID, $secret));
		}
	}
}