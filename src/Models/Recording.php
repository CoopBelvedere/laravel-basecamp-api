<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Recording extends AbstractModel
{
    /**
     * Get the recording events.
     *
     * @return \Illuminate\Http\Collection
     */
    public function events()
    {
        return Basecamp::events($this->bucket->id, $this->id);
    }

    /**
     * Get the subscription info.
     *
     * @return \Belvedere\Basecamp\Models\Subscription
     */
    public function subscriptions()
    {
        return Basecamp::subscriptions($this->bucket->id, $this->id);
    }

    /**
     * Trash the recording.
     *
     * @return \Illuminate\Http\Collection
     */
    public function destroy()
    {
        return Basecamp::recordings($this->bucket->id)->destroy($this->id);
    }
}
