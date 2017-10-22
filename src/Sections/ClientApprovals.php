<?php

namespace Belvedere\Basecamp\Sections;

use Belvedere\Basecamp\Models\ClientApproval;

class ClientApprovals extends AbstractSection
{
    /**
     * Index all approvals.
     *
     * @param  string  $nextPage
     * @return \Illuminate\Support\Collection
     */
    public function index($nextPage = null)
    {
        $url = $nextPage ?: sprintf('buckets/%d/client/approvals.json', $this->bucket);

        $approvals = $this->client->get($url);

        return $this->indexResponse($approvals, ClientApproval::class);
    }

    /**
     * Get a client approval.
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function show($id)
    {
        $approval = $this->client->get(
            sprintf('buckets/%d/client/approvals/%d.json', $this->bucket, $id)
        );

        return new ClientApproval($this->response($approval));
    }
}
