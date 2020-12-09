<?php

declare(strict_types=1);

namespace SimonSchaufi\LockElement\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class ChristmasCampaignController
{
    /**
     * Default flags for json_encode; value of:
     *
     * <code>
     * JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES
     * </code>
     *
     * @var int
     */
    const DEFAULT_JSON_FLAGS = JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES;

    /**
     * AJAX endpoint for hiding the christmas campaign for the current year
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function hideChristmasCampaignAction(ServerRequestInterface $request): ResponseInterface
    {
        $registry = GeneralUtility::makeInstance(Registry::class);
        $registry->set('lock_element', 'hideChristmasCampaign-' . date('Y'), true);

        $message = LocalizationUtility::translate(
            'tx_lockelement_donate.christmas_campaign_hidden',
            'lock_element'
        );

        $content = [
            'success' => true,
            'message' => $message
        ];

        if (version_compare(TYPO3_version, '9.0.0', '>=')) {
            return new JsonResponse($content);
        }

        return $this->createJsonResponse($content);
    }

    /**
     * @param array|null $configuration
     * @param int $statusCode
     * @return Response
     */
    protected function createJsonResponse(array $data = [], $encodingOptions = self::DEFAULT_JSON_FLAGS): Response
    {
        $response = (new Response())
            ->withHeader('Content-Type', 'application/json; charset=utf-8');

        $response->getBody()->write($this->jsonEncode($data, $encodingOptions));
        $response->getBody()->rewind();

        return $response;
    }

    /**
     * Encode the provided data to JSON.
     *
     * @param mixed $data
     * @param int $encodingOptions
     * @return string
     * @throws \InvalidArgumentException if unable to encode the $data to JSON.
     */
    private function jsonEncode($data, $encodingOptions)
    {
        if (is_resource($data)) {
            throw new \InvalidArgumentException('Cannot JSON encode resources', 1504972433);
        }
        // Clear json_last_error()
        json_encode(null);
        $json = json_encode($data, $encodingOptions);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException(sprintf(
                'Unable to encode data to JSON in %s: %s',
                __CLASS__,
                json_last_error_msg()
            ), 1504972434);
        }
        return $json;
    }
}
