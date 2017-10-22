# To-do sets

## Show a to-do set

```php
// The to-do set is returned with a project dock with enough
// information for most use cases.
$todoset = Basecamp::projects()->show($projectId)->todoSet();
```

```php
// If you need to call the endpoint for more details:
$todoset->show();

// Or
$todoset = Basecamp::todoSets($projectId)->show($id);
```
