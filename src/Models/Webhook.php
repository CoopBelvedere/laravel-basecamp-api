<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Webhook extends AbstractModel
{
    /**
     * Update the webhook.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function update(array $data)
    {
        $webhook = Basecamp::webhooks($this->bucket->id)
                           ->update($this->id, $data);

        $this->setAttributes($webhook);

        return $webhook;
    }

    /**
     * Delete the webhook.
     *
     * @return string
     */
    public function destroy()
    {
        return Basecamp::webhooks($this->bucket->id)->destroy($this->id);
    }
}
