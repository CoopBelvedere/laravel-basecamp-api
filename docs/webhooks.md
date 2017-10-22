# Webhooks

## List webhooks

```php
$webhooks = $project->webhooks()->index();
```

## Show a webhook

```php
$webhook = $project->webhooks()->show($id);
```

## Create a webhook

```php
$webhook = $project->webhooks()->store([
    'payload_url' => 'https://example.com/endpoint',
    'types' => ['Todo', 'Todolist'],
]);
```
