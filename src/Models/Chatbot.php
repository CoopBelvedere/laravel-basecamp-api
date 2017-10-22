<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Chatbot extends AbstractModel
{
    /**
     * Add a campfire line with the chatbot account.
     *
     * @param  string  $content
     * @return \Illuminate\Http\Collection
     */
    public function storeLine($content)
    {
        return Basecamp::chatbots()->storeLine($this->lines_url, $content);
    }

    /**
     * Update the chatbot.
     *
     * @param  array  $data
     * @return string
     */
    public function update(array $data)
    {
        $chatbot = Basecamp::chatbots($this->bucket->id, $this->campfire->id)
                           ->update($this->id, $data);

        $this->setAttributes($chatbot);

        return $chatbot;
    }

    /**
     * Delete the chatbot.
     *
     * @return string
     */
    public function destroy()
    {
        return Basecamp::chatbots($this->bucket->id, $this->campfire->id)
                       ->destroy($this->id);
    }
}
