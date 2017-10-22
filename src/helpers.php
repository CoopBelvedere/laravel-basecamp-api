<?php

if (! function_exists('basecamp_attachment')) {
    /**
     * Returns a formatted tag for a basecamp attachment or mention.
     *
     * @param  string  $sgid
     * @param  string  $caption
     * @return string
     */
    function basecamp_attachment($sgid, $caption = null)
    {
        $output = '<bc-attachment sgid="'.$sgid.'"';

        if ($caption)
            $output .= ' caption="'.$caption.'"';

        $output .= '></bc-attachment>';

        return $output;
    }
}
