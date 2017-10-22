# Schedules

## Show a schedule

```php
// The schedule is returned with a project dock with enough
// information for most use cases.
$schedule = Basecamp::projects()->show($projectId)->schedule();
```

```php
// If you need to call the endpoint for more details:
$schedule->show();

// Or
$schedule = Basecamp::schedules($projectId)->show($id);
```
