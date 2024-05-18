<?php

/**
 * Checks if PIXELART is active for the current user.
 *
 * @return boolean
 */
function pixelart_is_plugin_active()
{
    /**
     * Checks if PIXELART is active for the current user. Do not use this filter
     * yourself, instead use pixelart_is_plugin_active() function!
     *
     * @param {boolean} True for activated and false for deactivated
     * @return {boolean}
     * @hook PIXELART/Active
     */
    $result = \apply_filters('PIXELART/Active', \current_user_can('manage_categories'));
    return $result;
}
