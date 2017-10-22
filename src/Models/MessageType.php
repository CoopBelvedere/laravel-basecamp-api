<?php

namespace Belvedere\Basecamp\Models;

class MessageType extends AbstractModel
{
    /**
     * Update the message type.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Collection
     */
    public function update(array $data)
    {
        $messageType = Basecamp::messageTypes($this->bucket->id)
                               ->update($this->id, $data);

        $this->setAttributes($messageType);

        return $messageType;
    }

    /**
     * Delete the message type.
     *
     * @return string
     */
    public function destroy()
    {
        return Basecamp::messageTypes($this->bucket->id)->destroy($this->id);
    }
}
