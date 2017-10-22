<?php

namespace Belvedere\Basecamp\Models;

use Basecamp;

class Vault extends AbstractModel
{
    /**
     * Get the vault.
     *
     * @return \Illuminate\Http\Collection
     */
    public function show()
    {
        return Basecamp::vaults($this->bucket->id)->show($this->id);
    }

    /**
     * List the documents.
     *
     * @return \Illuminate\Http\Collection
     */
    public function documents()
    {
        return Basecamp::documents($this->bucket->id, $this->id);
    }

    /**
     * List the uploads.
     *
     * @return \Illuminate\Http\Collection
     */
    public function uploads()
    {
        return Basecamp::uploads($this->bucket->id, $this->id);
    }
}
