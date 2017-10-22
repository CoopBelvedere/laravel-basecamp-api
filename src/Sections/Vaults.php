<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\Vault;

class Vaults extends AbstractSection
{
    /**
     * Get a vault.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $vault = $this->client->get(
            sprintf('buckets/%d/vaults/%d.json', $this->bucket, $id)
        );

        return new Vault($this->response($vault));
    }
}
