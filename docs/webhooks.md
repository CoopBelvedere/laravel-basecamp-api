# Webhooks

## List webhooks

```
$webhooks = $project->webhooks()->index();
```

## Show a webhook

```
$webhook = $project->webhooks()->show($id);
```

## Create a webhook

```
$webhook = $project->webhooks()->store([
    'payload_url' => 'https://example.com/endpoint',
    'types' => ['Todo', 'Todolist'],
]);
```
