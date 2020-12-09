/**
 * Module: TYPO3/CMS/LockElement/FormEngine/Element/ChristmasCampaignElement
 *
 * JavaScript to handle Christmas campaign
 * @exports TYPO3/CMS/LockElement/FormEngine/Element/ChristmasCampaignElement
 */
define(['jquery'], function($) {
    'use strict';

    /**
     * @exports TYPO3/CMS/LockElement/FormEngine/Element/ChristmasCampaignElement
     */
    var ChristmasCampaignElement = {};

    ChristmasCampaignElement.hide = function() {
        var $containerElement = $('#christmasCampaignWrapper');
        $.ajax({
            url: TYPO3.settings.ajaxUrls['hide-christmas-campaign'],
            dataType: 'json'
        }).done(function (response) {
            if (response.success) {
                top.TYPO3.Notification.info('Lock element', response.message);
                $containerElement.parent().parent().hide();
            } else {
                top.TYPO3.Notification.error('Lock element', response.message);
            }
        }).fail(function (response) {
            top.TYPO3.Notification.error('Lock element', response.message);
        });
    };

    ChristmasCampaignElement.init = function () {
        $('#hideChristmasCampaignElement').on('click', function (evt) {
            evt.preventDefault();
            ChristmasCampaignElement.hide();
        });
    };

    $(ChristmasCampaignElement.init);

    return ChristmasCampaignElement;
});
