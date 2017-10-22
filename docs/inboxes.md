# Inboxes

## Show an inbox

```php
// The inbox is returned with a project dock with enough
// information for most use cases.
$inbox = Basecamp::projects()->show($projectId)->inbox();
```

```php
// If you need to call the endpoint for more details:
$inbox = $inbox->show();

// Or
$inbox = Basecamp::inboxes($projectId)->show($id);
```

