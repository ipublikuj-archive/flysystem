<?php
/**
 * InvalidResourceException.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 * @package        iPublikuj:Flysystem!
 * @subpackage     Exceptions
 * @since          1.0.0
 *
 * @date           12.04.16
 */

declare(strict_types = 1);

namespace IPub\Flysystem\Exceptions;

class InvalidResourceException extends \InvalidArgumentException implements IException
{
}
