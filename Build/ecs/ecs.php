<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Basic\SingleLineEmptyBodyFixer;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\Operator\OperatorLinebreakFixer;
use PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . '/../../Build',
        __DIR__ . '/../../Classes',
        __DIR__ . '/../../Configuration',
        __DIR__ . '/../../ext_emconf.php',
        __DIR__ . '/../../ext_localconf.php',
    ]);

    $ecsConfig->sets([
        SetList::PSR_12,
        SetList::CLEAN_CODE,
        SetList::SYMPLIFY,
        SetList::ARRAY,
        SetList::COMMON,
        SetList::COMMENTS,
        SetList::CONTROL_STRUCTURES,
        SetList::DOCBLOCK,
        SetList::NAMESPACES,
        SetList::PHPUNIT,
        SetList::SPACES,
        SetList::STRICT,
    ]);

    $ecsConfig->ruleWithConfiguration(GeneralPhpdocAnnotationRemoveFixer::class, [
        'annotations' => ['author', 'package', 'group'],
    ]);

    $ecsConfig->ruleWithConfiguration(NoSuperfluousPhpdocTagsFixer::class, [
        'allow_mixed' => true,
    ]);

    $ecsConfig->ruleWithConfiguration(CastSpacesFixer::class, [
        'space' => 'none',
    ]);

    $ecsConfig->ruleWithConfiguration(HeaderCommentFixer::class, [
        'header' => <<<EOF
This file is part of the TYPO3 CMS project.

(c) Simon Schaufelberger

It is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License, either version 2
of the License, or any later version.

For the full copyright and license information, please read the
LICENSE.txt file that was distributed with this source code.

The TYPO3 project - inspiring people to share!
EOF
    ]);

    // Rules that are not in a set
    $ecsConfig->rule(OperatorLinebreakFixer::class);
    $ecsConfig->rule(SingleLineEmptyBodyFixer::class);

    $ecsConfig->skip([
        LineLengthFixer::class,
        DeclareStrictTypesFixer::class => [
            __DIR__ . '/../../ext_emconf.php',
            __DIR__ . '/../../ext_localconf.php',
        ],
        HeaderCommentFixer::class => [
            __DIR__ . '/../ecs/ecs.php',
            __DIR__ . '/../fractor/fractor.php',
            __DIR__ . '/../rector/rector.php',
            __DIR__ . '/../../ext_emconf.php',
            __DIR__ . '/../../ext_localconf.php',
        ],
    ]);
};
