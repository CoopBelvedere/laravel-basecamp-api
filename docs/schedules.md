# Schedules

## Show a schedule

```
// The schedule is returned with a project dock with enough
// information for most use cases.
$schedule = Basecamp::projects()->show($projectId)->schedule();
```

```
// If you need to call the endpoint for more details:
$schedule->show();

// Or
$schedule = Basecamp::schedules($projectId)->show($id);
```
