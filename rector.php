<?php
/**
 * Rector config.
 * 
 * @package Automattic/MaintenanceMode
 */

declare(strict_types=1);

use Rector\CodeQuality\Rector\ClassMethod\OptionalParametersAfterRequiredRector;
use Rector\CodingStyle\Rector\FuncCall\ConsistentImplodeRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector;
use Rector\Php54\Rector\Array_\LongArrayToShortArrayRector;
use Rector\Php80\Rector\Identical\StrEndsWithRector;
use Rector\Php80\Rector\Identical\StrStartsWithRector;
use Rector\Php80\Rector\NotIdentical\StrContainsRector;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Php82\Rector\Encapsed\VariableInStringInterpolationFixerRector;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return RectorConfig::configure()
	->withIndent( "\t", 1 )
	->withPaths(
		array(
			__DIR__ . '/tests',
			__DIR__ . '/maintenance-mode.php',
			__DIR__ . '/template-maintenance-mode.php',
			__DIR__ . '/vipgo-helper.php',
		)
	)
	->withSkip(
		array(
			// WordPress prefers long array syntax.
			LongArrayToShortArrayRector::class,
		)
	)
	->withSets(
		array(
			LevelSetList::UP_TO_PHP_74,
			SetList::DEAD_CODE,
			SetList::CODE_QUALITY,
			SetList::INSTANCEOF,
			SetList::CODING_STYLE,
			SetList::EARLY_RETURN,
			SetList::NAMING,
			SetList::STRICT_BOOLEANS,
		)
	)
	// Changes from later PHP Sets that are backwards compatible.
	->withRules(
		array(
			// 8.0
			ConsistentImplodeRector::class,
			OptionalParametersAfterRequiredRector::class,
			RemoveParentCallWithoutParentRector::class,
			// Backfilled from PHP 8.0 into WP 5.9, so these can be used.
			StrContainsRector::class,
			StrEndsWithRector::class,
			StrStartsWithRector::class,

			// 8.1
			NullToStrictStringFuncCallArgRector::class,

			// 8.2
			VariableInStringInterpolationFixerRector::class,

			// 8.3
			AddOverrideAttributeToOverriddenMethodsRector::class,

			// 8.4
			ExplicitNullableParamTypeRector::class,
		)
	)
	->withTypeCoverageLevel( 1 );
